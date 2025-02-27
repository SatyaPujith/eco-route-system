<!-- resources/views/routes/find.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Find Eco-Friendly Routes</h1>
    <form action="{{ route('routes.suggest') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="origin">Origin:</label>
            <input type="text" class="form-control" name="origin" required>
        </div>
        <div class="form-group">
            <label for="destination">Destination:</label>
            <input type="text" class="form-control" name="destination" required>
        </div>
        <button type="submit" class="btn btn-success">Find Routes</button>
    </form>
</div>
@endsection
