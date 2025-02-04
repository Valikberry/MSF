@extends('frontend.booking.__layout')

@section('main-content')

    <div class="error-section">
        <div class="container">
            <div class="error-content">
                <h1 class="error-title">404 Page</h1>
                <p>Oops! The page you’re looking for doesn’t exist.</p>
                <a href="{{ url('/') }}" class="btn btn-primary">Go to Homepage</a>
            </div>
        </div>
    </div>

@endsection
