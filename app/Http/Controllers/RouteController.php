<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Route;

class RouteController extends Controller
{
    // Dashboard Method
    public function dashboard() {
        return view('dashboard');
    }
    // app/Http/Controllers/RouteController.php

public function history() {
    // Fetch all saved routes for the authenticated user
    $routes = Route::where('user_id', Auth::id())->get();

    // Return the history view with the fetched routes
    return view('routes.history', compact('routes'));
}

    // app/Http/Controllers/RouteController.php
    // app/Http/Controllers/RouteController.php

public function delete($id) {
    $route = Route::find($id);

    // Check if route exists and belongs to the current user
    if ($route && $route->user_id === Auth::id()) {
        $route->delete();
        return redirect()->route('routes.saved')->with('success', 'Route deleted successfully!');
    }

    return redirect()->route('routes.saved')->with('error', 'Route not found or unauthorized.');
}

   public function saved() {
    // Fetch saved routes for the authenticated user
    $routes = Route::where('user_id', Auth::id())->get();

    // Return the saved routes view with the fetched routes
    return view('routes.saved', compact('routes'));
    }

    // Display Find Routes Form
    public function find() {
    return view('routes.find');
    }

    // app/Http/Controllers/RouteController.php

    public function suggest(Request $request)
{
    $origin = $request->input('origin');
    $destination = $request->input('destination');

    // Google Maps API Key
    $apiKey = config('services.google_maps.key');

    // Make request to Google Maps Directions API
    $response = Http::get('https://maps.googleapis.com/maps/api/directions/json', [
        'origin' => $origin,
        'destination' => $destination,
        'key' => $apiKey,
        'alternatives' => true, // Get multiple routes
        'avoid' => 'highways|tolls', // Avoid highways and toll roads
    ]);

    $routes = $response->json()['routes'] ?? [];

    if (empty($routes)) {
        return back()->with('error', 'Could not find eco-friendly routes.');
    }

    $suggestedRoutes = [];

    // Process each route to calculate an eco-score
    foreach ($routes as $route) {
        $distance = $route['legs'][0]['distance']['value'] / 1000; // KM
        $duration = $route['legs'][0]['duration']['value'] / 60;   // Minutes

        // Eco Score Calculation (Lower distance + time = Higher eco-score)
        $ecoScore = max(100 - ($distance + $duration), 0);

        $suggestedRoutes[] = [
            'route' => $route['summary'] ?? 'Alternative Route',
            'distance' => round($distance, 2),
            'duration' => round($duration, 2),
            'eco_score' => round($ecoScore, 2),
            'polyline' => $route['overview_polyline']['points'], // For map display
        ];
    }

    return view('routes.suggest', [
        'origin' => $origin,
        'destination' => $destination,
        'suggestedRoutes' => $suggestedRoutes
    ]);
}

    

    // Save Selected Route
    public function save(Request $request) {
        $route = new Route();
        $route->user_id = Auth::id();
        $route->origin = $request->input('origin');
        $route->destination = $request->input('destination');
        $route->suggested_route = $request->input('suggested_route');
        $route->eco_score = $request->input('eco_score');
        $route->save();
        
        return redirect()->route('routes.history')->with('success', 'Route saved successfully!');
    }

    // Fetch Route History
}
