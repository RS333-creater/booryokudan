<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mypage - BonVoyage - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('https://unpkg.com/leaflet@1.9.3/dist/leaflet.css') }}" />
    <link rel="stylesheet" href="{{ asset('mypage.css') }}">
</head>

<body>
        <header>
            <div class="nav-container">
                <div class="logo">
                <a href="{{ route('mypage') }}"><img src="{{ asset('css/img/logo 1.png') }}" alt="BonVoyage Logo"></a>
                </div>
                <nav>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('calendar') }}">Calendar</a></li>
                        <li><a href="{{ route('booking') }}">Bookings</a></li>
                        <li><a href="{{ route('spending') }}">Spending</a></li>
                        <li><a href="{{ route('messages') }}">Messages</a></li>
                    </ul>
                </nav>
                <div class="btnarea">
                    <button class="nav-btn">
                        <img src="/css/img/flight-svgrepo-com.svg" alt="SAVED"></button>
                    <button class="nav-btn">
                        <img src="/css/img/setting-1-svgrepo-com.svg" alt="SETTINGS"></button>
                    <div class="user-profile">
                        <img src="/css/img/bobby.png" alt="User01">
                    </div>
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
