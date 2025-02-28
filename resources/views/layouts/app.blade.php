<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BonVoyage - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/styleindex.css') }}">
</head>
<body>
    <div class="container">
        <!-- Header and Navigation -->
        <header>
            <div class="nav-container">
                <div class="logo">
                    <a href="/"><img src="{{ asset('css/img/logo 1.png') }}" alt="BonVoyage Logo"></a>
                </div>
                <nav>
                    <ul>
                        <li><a href="{{ route('location') }}">Location</a></li>
                        <li><a href="{{ route('discover') }}">Discover</a></li>
                        <li><a href="{{ route('bookings') }}">Bookings</a></li>
                        <li><a href="{{ route('activities') }}">Activities</a></li>
                        <li><a href="{{ route('about') }}">About us</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </nav>
                <div class="btnarea">
                    <a href="{{ route('mypage') }}"><button class="nav-btn">MY PAGE</button></a>
                    <button class="nav-btn">SETTINGS</button>
                    <a href="{{ route('login') }}"><button class="signup-btn">Sign up</button></a>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
