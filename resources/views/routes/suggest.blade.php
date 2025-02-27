@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Eco-Route Suggestions</h2>
    
    <form action="{{ route('routes.suggest') }}" method="POST">
    @csrf
    <input type="hidden" name="origin" value="{{ $origin }}">
    <input type="hidden" name="destination" value="{{ $destination }}">
    <button type="submit" class="btn btn-success">Check Eco Route</button>
</form>


    @if(isset($suggestedRoutes))
    <h4 class="mt-4">Suggested Routes</h4>
    <div id="map" style="height: 500px; width: 100%;"></div>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Route</th>
                <th>Distance (km)</th>
                <th>Duration (min)</th>
                <th>Eco Score</th>
                <th>Save</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suggestedRoutes as $route)
            <tr>
                <td>{{ $route['route'] }}</td>
                <td>{{ $route['distance'] }}</td>
                <td>{{ $route['duration'] }}</td>
                <td>{{ $route['eco_score'] }}</td>
                <td>
                    <form method="POST" action="{{ route('routes.save') }}">
                        @csrf
                        <input type="hidden" name="origin" value="{{ $origin }}">
                        <input type="hidden" name="destination" value="{{ $destination }}">
                        <input type="hidden" name="suggested_route" value="{{ $route['route'] }}">
                        <input type="hidden" name="eco_score" value="{{ $route['eco_score'] }}">
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

<script>
    function initMap() {
        var start = "{{ $origin ?? '' }}";
        var destination = "{{ $destination ?? '' }}";
        var apiKey = "{{ config('services.google_maps.key') }}";

        if (start && destination) {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 7,
                center: { lat: 20.5937, lng: 78.9629 } // Default: India
            });

            var directionsService = new google.maps.DirectionsService();
            var directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map);

            var request = {
                origin: start,
                destination: destination,
                travelMode: google.maps.TravelMode.DRIVING,
                provideRouteAlternatives: true
            };

            directionsService.route(request, function(response, status) {
                if (status === google.maps.DirectionsStatus.OK) {
                    directionsRenderer.setDirections(response);
                } else {
                    alert("Could not get directions: " + status);
                }
            });
        }
    }
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&callback=initMap"></script>
@endsection
