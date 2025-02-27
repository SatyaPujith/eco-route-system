<!-- resources/views/routes/saved.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Saved Routes</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($routes->isEmpty())
        <p>No saved routes yet.</p>
    @else
        @foreach ($routes as $route)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>{{ $route->suggested_route }}</h5>
                    <p>Origin: {{ $route->origin }}</p>
                    <p>Destination: {{ $route->destination }}</p>
                    <p>Eco Score: {{ $route->eco_score }}</p>
                    <form action="{{ route('routes.delete', $route->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Route</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
</div>
<a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Back to Dashboard</a>

@endsection
