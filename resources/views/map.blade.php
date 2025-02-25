<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map and Travel Dashboard</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <link rel="stylesheet" href="map.css">
</head>

<body>
    <header>
        <div class="nav-container">
            <div class="logo">
                <img src="/css/img/logo 1.png" alt="">
            </div>
            <nav>
                <ul>
                    <li><a href="#">Location</a></li>
                    <li><a href="#">Discover</a></li>
                    <li><a href="#">Bookings</a></li>
                    <li><a href="#">Activities</a></li>
                    <li><a href="#">About us</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>
            <div class="btnarea">
                <button class="nav-btn">MY PAGE</button>
                <button class="nav-btn">SETTINGS</button>
                <button class="signup-btn">Sign up</button>
            </div>
        </div>
    </header>
    <div class="container">
        <nav class="menu">
            <ul>
                <li><img src="https://via.placeholder.com/30" alt="map icon"></li>
                <li><img src="https://via.placeholder.com/30" alt="profile icon"></li>
                <li><img src="https://via.placeholder.com/30" alt="settings icon"></li>
                <li><img src="https://via.placeholder.com/30" alt="other icon"></li>
            </ul>
        </nav>
        <!-- Left Sidebar for Destinations -->
        <aside class="sidebar">
            <div class="travel-destinations">
                <div class="destination-card" data-lat="46.8182" data-lng="8.2275">
                    <img src="https://via.placeholder.com/80x100" alt="Switzerland">
                    <p>Switzerland <span class="rating">4.8</span></p>
                </div>
                <div class="destination-card" data-lat="-25.2744" data-lng="133.7751">
                    <img src="https://via.placeholder.com/80x100" alt="Australia">
                    <p>Australia <span class="rating">4.6</span></p>
                </div>
                <div class="destination-card" data-lat="53.4129" data-lng="-8.2439">
                    <img src="https://via.placeholder.com/80x100" alt="Ireland">
                    <p>Ireland <span class="rating">4.5</span></p>
                </div>
                <div class="destination-card" data-lat="56.1304" data-lng="-106.3468">
                    <img src="https://via.placeholder.com/80x100" alt="Canada">
                    <p>Canada <span class="rating">4.3</span></p>
                </div>
                <div class="destination-card" data-lat="51.5074" data-lng="-0.1278">
                    <img src="https://via.placeholder.com/80x100" alt="United Kingdom">
                    <p>United Kingdom <span class="rating">4.2</span></p>
                </div>
            </div>
        </aside>

        <!-- Main content area for Map -->
        <main class="map-area">
            <div class="search-bar">
                <input type="text" placeholder="Gates Avenue, Brooklyn, NY, USA" id="search">
            </div>
            <div id="map"></div>
        </main>

        <!-- Right Sidebar for Events and Messages -->
        <aside class="events-sidebar">
            <div class="events">
                <h2>Events</h2>
                <ul>
                    <li class="event">
                        <img src="https://via.placeholder.com/50" alt="User01">
                        <div class="event-content" style="background-color: #e8f5e9;">
                            <p><strong>2024 Arts Guide</strong></p>
                            <p>Oct 2024, xxxxxxx</p>
                        </div>
                    </li>
                    <li class="event">
                        <img src="https://via.placeholder.com/50" alt="User02">
                        <div class="event-content" style="background-color: #e1bee7;">
                            <p><strong>Fall Exhibition</strong></p>
                            <p>xxxxxxxxx</p>
                        </div>
                    </li>
                    <li class="event">
                        <img src="https://via.placeholder.com/50" alt="User03">
                        <div class="event-content" style="background-color: #fff9c4;">
                            <p><strong>Senior Meetups</strong></p>
                            <p>xxxxxxxx</p>
                        </div>
                    </li>
                    <li class="event">
                        <img src="https://via.placeholder.com/50" alt="User03">
                        <div class="event-content" style="background-color: #fff9c4;">
                            <p><strong>Senior Meetups</strong></p>
                            <p>xxxxxxxx</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="messages">
                <h2>Last Messages</h2>
                <ul>
                    <li class="message">
                        <img src="https://via.placeholder.com/50" alt="User01">
                        <div class="message-content" style="background-color: #e8f5e9;">
                            <p><strong>User01</strong></p>
                            <p>Hey you,</p>
                        </div>
                    </li>
                    <li class="message">
                        <img src="https://via.placeholder.com/50" alt="User02">
                        <div class="message-content" style="background-color: #e1bee7;">
                            <p><strong>User02</strong></p>
                            <p>Hey you,</p>
                        </div>
                    </li>
                </ul>
            </div>
        </aside>
    </div>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const map = L.map('map', {
                zoomControl: false
            }).setView([40.7128, -74.0060], 13);


            L.control.zoom({
                position: 'bottomright'
            }).addTo(map);


            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            const markers = [
                { lat: 40.7128, lng: -74.0060, info: "This is a spot in New York City" },
                { lat: 40.7143, lng: -74.0030, info: "Another spot near the first" }
            ];


            markers.forEach(marker => {
                L.marker([marker.lat, marker.lng]).addTo(map)
                    .bindPopup(marker.info);
            });


            const destinationCards = document.querySelectorAll('.destination-card');

            destinationCards.forEach(card => {
                card.addEventListener('click', function () {
                    const lat = this.getAttribute('data-lat');
                    const lng = this.getAttribute('data-lng');


                    map.setView([lat, lng], 13);


                    const marker = L.marker([lat, lng]).addTo(map)
                        .bindPopup(`You are now viewing: ${this.querySelector('p').textContent}`)
                        .openPopup();
                });
            });


            document.getElementById('search').addEventListener('keypress', function (event) {
                if (event.key === 'Enter') {
                    const query = event.target.value;
                    searchLocation(query, map);
                }
            });
        });


        function searchLocation(query, map) {
            const url = `https://nominatim.openstreetmap.org/search?format=json&q=${query}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        const location = data[0];
                        const lat = location.lat;
                        const lon = location.lon;

                        // Move and center the map to the searched location
                        map.setView([lat, lon], 13);

                        // Add a marker to the new searched location
                        L.marker([lat, lon]).addTo(map)
                            .bindPopup(`You searched for: ${query}`).openPopup();
                    } else {
                        alert("Location not found. Try a different search.");
                    }
                })
                .catch(error => {
                    console.error("Error fetching location:", error);
                });
        }
    </script>
</body>

</html>