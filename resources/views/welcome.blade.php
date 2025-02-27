<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smart Eco-Route Optimization System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background:rgb(255, 253, 253);
        }
        .hero-section {
            background: url('https://source.unsplash.com/1600x900/?road,nature') no-repeat center center;
            background-size: cover;
            color: black;
            text-align: center;
            padding: 150px 0;
        }
        .hero-section h1 {
            font-size: 3.5em;
            font-weight: bold;
        }
        .feature-icon {
            font-size: 3em;
            color: #28a745;
        }
        .cta-buttons a {
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <h1>Smart Eco-Route Optimization</h1>
        <p class="lead">Find the most eco-friendly routes and reduce your carbon footprint.</p>
        <div class="cta-buttons">
            @if (Route::has('login'))
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-success btn-lg">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </section>

    <!-- Features Section -->
    <section class="container mt-5">
        <div class="text-center mb-4">
            <h2>Why Choose Us?</h2>
            <p>Eco-Friendly Navigation with Real-Time Route Optimization</p>
        </div>
        <div class="row text-center">
            <div class="col-md-4">
                <i class="feature-icon bi bi-geo-alt-fill"></i>
                <h4>Eco-Friendly Routes</h4>
                <p>Find the most fuel-efficient and environmentally friendly routes.</p>
            </div>
            <div class="col-md-4">
                <i class="feature-icon bi bi-map"></i>
                <h4>Real-Time Navigation</h4>
                <p>Get real-time route updates and avoid traffic jams.</p>
            </div>
            <div class="col-md-4">
                <i class="feature-icon bi bi-people-fill"></i>
                <h4>Community Insights</h4>
                <p>Discover routes recommended by eco-conscious travelers.</p>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="text-center mt-5 mb-5">
        <a href="{{ route('routes.find') }}" class="btn btn-success btn-lg">Find Eco-Friendly Routes</a>
    </section>

    <!-- Footer -->
    <footer class="text-center py-3" style="background: #343a40; color: white;">
        <p>&copy; {{ date('Y') }} Smart Eco-Route Optimization System. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
