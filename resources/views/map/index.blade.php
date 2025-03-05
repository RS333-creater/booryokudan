<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map and Travel Dashboard</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
    
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.min.js"></script>

    <link rel="stylesheet" href="/css/stylemap.css">
</head>

<body>
    <header>
        <div class="nav-container">
            <div class="logo">
                <a href="/"><img src="/css/img/logo 1.png" alt=""></a>
            </div>
            <nav>
                <ul>
                        <li><a href="{{ route('map') }}">Location</a></li>
                        <li><a href="{{ route('discover') }}">Discover</a></li>
                        <li><a href="{{ route('bookings') }}">Bookings</a></li>
                        <li><a href="{{ route('activities') }}">Activities</a></li>
                        <li><a href="{{ route('about') }}">About us</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
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
            <!-- サイドバーメニュー -->
        </nav>

        <aside class="sidebar">
            <div class="travel-destinations">
            <div class="scrollable-container">
                <!-- 元のカード内容を維持 -->
                <div class="destination-card" data-lat="46.8182" data-lng="8.2275">
                    <img src="/css/img/swis.jpg" alt="Switzerland">
                    <p>Switzerland <span class="rating">4.8</span></p>
                </div>
                <div class="destination-card" data-lat="-25.2744" data-lng="133.7751">
                    <img src="/css//img/australia01.jpg" alt="Australia">
                    <p>Australia <span class="rating">4.6</span></p>
                </div>
                <div class="destination-card" data-lat="53.4129" data-lng="-8.2439">
                    <img src="/css/img/Ireland.jpg" alt="Ireland">
                    <p>Ireland <span class="rating">4.5</span></p>
                </div>
                <div class="destination-card" data-lat="56.1304" data-lng="-106.3468">
                    <img src="/css/img/canada.jpeg" alt="Canada">
                    <p>Canada <span class="rating">4.3</span></p>
                </div>
                <div class="destination-card" data-lat="51.5074" data-lng="-0.1278">
                    <img src="/css/img/uk.jpg" alt="United Kingdom">
                    <p>United Kingdom <span class="rating">4.2</span></p>
                </div>
            </div>
            </div>
        </aside>

        <main class="map-area">
            <div class="search-bar">
                <input type="text" placeholder="Gates Avenue, Brooklyn, NY, USA" id="search" value="{{$Addres}}">
            </div>
            <div id="map" style="width: 100%; height: 100%;"></div>
        </main>

        <aside class="events-sidebar">
            <div class="selected-markers">
                <h2>Selected Locations</h2>
                <ul id="selected-markers-list">
                    <!-- 選択されたマップピン情報 -->
                </ul>
            </div>
            <div class="total-price-section">
                <h3>Total Price</h3>
                <p id="total-price">0 USD</p>
                <button id="confirm-booking" class="nav-btn">Confirm Booking</button>
            </div>
        </aside>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const map = L.map('map', { zoomControl: false }).setView([35.6813, 139.7660], 13);  // 初期表示位置は東京駅
            L.control.zoom({ position: 'bottomright' }).addTo(map);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            let selectedFacilities = [];  // 選択された施設を保持する配列
            const markers = [
                { lat: 40.7128, lng: -74.0060, info: "New York City", price: 500 },
                { lat: 40.7143, lng: -74.0030, info: "Another spot in NYC", price: 300 },
                { lat: 35.6813, lng: 139.7660, info: "東京駅", price: 700 }
            ];

            @foreach($facility as $facilitys)
                markers.push({
                    lat: {{ $facilitys->latitude }},
                    lng: {{ $facilitys->longitude }},
                    info: "{{ $facilitys->name }}",
                    price: {{ $facilitys->price ?? 0 }}
                });
            @endforeach

            let totalPrice = 0; // 合計金額

            markers.forEach(marker => {
                const mapMarker = L.marker([marker.lat, marker.lng]).addTo(map)
                    .bindPopup(marker.info);

                mapMarker.on('click', function () {
                    addMarkerInfoToSidebar(marker.info, marker.price);
                    selectedFacilities.push(marker);  // 施設を選択順に追加
                });
            });

            // サイドバーにマップピン情報を追加
            function addMarkerInfoToSidebar(info, price) {
                const list = document.getElementById('selected-markers-list');
                const listItem = document.createElement('li');
                listItem.classList.add('event');

                const icon = document.createElement('img');
                icon.src = "https://via.placeholder.com/50";
                icon.alt = "Marker Icon";

                const content = document.createElement('div');
                content.classList.add('event-content');
                content.innerHTML = `<p><strong>${info}</strong></p><p>${price} USD</p>`;

                listItem.appendChild(icon);
                listItem.appendChild(content);
                list.appendChild(listItem);

                // 合計金額を更新
                updateTotalPrice(price);
            }

            // 合計金額を更新
            function updateTotalPrice(price) {
                totalPrice += price;
                document.getElementById('total-price').textContent = `${totalPrice} USD`;
            }

            // 予約確認ボタンのクリックイベント
            document.getElementById('confirm-booking').addEventListener('click', function () {
                const queryParams = new URLSearchParams({ totalPrice });

                // 選択された施設を順番通りにクエリパラメータに追加
                selectedFacilities.forEach((facility, index) => {
                    queryParams.append(`facility[${index}][name]`, facility.info);
                    queryParams.append(`facility[${index}][price]`, facility.price);
                    queryParams.append(`facility[${index}][lat]`, facility.lat);
                    queryParams.append(`facility[${index}][lng]`, facility.lng);
                });

                // reserve ページにリダイレクト
                window.location.href = `map/reserve?${queryParams.toString()}`;
            });
        });
    </script>

</body>
