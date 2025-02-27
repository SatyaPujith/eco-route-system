<?php
use App\Http\Controllers\RouteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Default Laravel Auth Routes
Auth::routes();

// Home Route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard (Main Hub)
Route::get('/dashboard', [RouteController::class, 'dashboard'])->name('dashboard')->middleware('auth');

// Find Routes Page (User enters origin & destination)
Route::get('/routes/find', [RouteController::class, 'find'])->name('routes.find')->middleware('auth');
Route::match(['get', 'post'], '/routes/suggest', [RouteController::class, 'suggest'])->name('routes.suggest');

Route::post('/routes/suggest', [RouteController::class, 'suggest'])->name('routes.suggest')->middleware('auth');
Route::post('/routes/suggest', [RouteController::class, 'suggest'])->name('routes.suggest');

// Save Route (POST)
Route::post('/routes/save', [RouteController::class, 'save'])->name('routes.save')->middleware('auth');
Route::post('/suggest', [RouteController::class, 'suggest'])->name('routes.suggest');

// View Saved Routes
Route::get('/routes/saved', [RouteController::class, 'saved'])->name('routes.saved')->middleware('auth');

// Route History and Analytics
Route::get('/routes/history', [RouteController::class, 'history'])->name('routes.history')->middleware('auth');

// Delete Saved Route
Route::delete('/routes/delete/{id}', [RouteController::class, 'delete'])->name('routes.delete')->middleware('auth');
