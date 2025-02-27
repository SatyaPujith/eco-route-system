<!-- resources/views/routes/history.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Route History</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($routes->isEmpty())
        <p>No route history available.</p>
    @else
        @foreach ($routes as $route)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>{{ $route->suggested_route }}</h5>
                    <p>Origin: {{ $route->origin }}</p>
                    <p>Destination: {{ $route->destination }}</p>
                    <p>Eco Score: {{ $route->eco_score }}</p>
                    <p>Date: {{ $route->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        @endforeach
    @endif
</div>
<a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Back to Dashboard</a>

@endsection
