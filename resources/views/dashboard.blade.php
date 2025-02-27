<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <p>Welcome, {{ Auth::user()->name }}! Plan your eco-friendly routes.</p>
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('routes.find') }}" class="btn btn-success btn-block">Find Routes</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('routes.saved') }}" class="btn btn-primary btn-block">Saved Routes</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('routes.history') }}" class="btn btn-info btn-block">Route History</a>
        </div>
    </div>
</div>
@endsection
