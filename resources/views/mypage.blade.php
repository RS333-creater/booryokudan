<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mypage - BonVoyage</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <link rel="stylesheet" href="mypage.css">
</head>

<body>
    <header>
        <div class="nav-container">
            <div class="logo">
            <a href="/"><img src="/css/img/logo 1.png" alt=""></a>
            </div>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Calendar</a></li>
                    <li><a href="#">Bookings</a></li>
                    <li><a href="#">Spending</a></li>
                    <li><a href="#">Messages</a></li>
                </ul>
            </nav>
            <div class="btnarea">
                <button class="nav-btn">
                    <img src="/css/img/flight-svgrepo-com.svg" alt="SAVED"></button>
                <button class="nav-btn">
                    <img src="/css/img/setting-1-svgrepo-com.svg" alt="SETTINGS"></button>
                <div class="user-profile">
                    <img src="/css/img/friend-svgrepo-com.svg" alt="User01">
                </div>
            </div>
        </div>
    </header>

    <section class="content">
    <div class="calendar">
        <h2>Calendar</h2>
        <div class="calendar-widget">
        @php
          // クエリパラメータから年月を取得。未指定の場合はデフォルト値として2025年9月を使用
            $year  = request()->query('year')  ?: 2025;
            $month = request()->query('month') ?: 9;
          // ハイライト日付（必要に応じて上書きしてください）
            $highlightedDates = $highlightedDates ?? [
            '2025-02-14', '2025-02-26', '2025-02-28',
            '2025-09-01', '2025-09-02', '2025-09-05',
            '2025-09-06', '2025-09-10', '2025-09-12',
            '2025-09-29', '2025-09-30'
            ];
          // 当月1日の曜日（0: 日曜 ～ 6: 土曜）と当月の日数を取得
            $startDay    = \Carbon\Carbon::createFromDate($year, $month, 1)->dayOfWeek;
            $daysInMonth = \Carbon\Carbon::createFromDate($year, $month, 1)->daysInMonth;
          // 前月・翌月の計算
            $prevYear  = ($month == 1)  ? $year - 1 : $year;
            $prevMonth = ($month == 1)  ? 12      : $month - 1;
            $nextYear  = ($month == 12) ? $year + 1 : $year;
            $nextMonth = ($month == 12) ? 1       : $month + 1;
        @endphp

        <!-- カレンダー上部：左右の矢印と現在の月名表示 -->
        <div class="calendar-header">
            <a href="?year={{ $prevYear }}&month={{ $prevMonth }}" class="month-nav">&lt;</a>
            <a href="?year={{ $nextYear }}&month={{ $nextMonth }}" class="month-nav">&gt;</a>
            <h3>{{ \Carbon\Carbon::createFromDate($year, $month, 1)->format('F') }}</h3>

        </div>

        <!-- カレンダー表 -->
        <table>
            <tr>
            <th>Su</th>
            <th>Mo</th>
            <th>Tu</th>
            <th>We</th>
            <th>Th</th>
            <th>Fr</th>
            <th>Sa</th>
            </tr>
            @php $currentCell = 0; @endphp
            <tr>
            <!-- 月初日の曜日まで空セルを挿入 -->@for ($i = 1; $i <= $daysInMonth; $i++)
    @php
        $date = \Carbon\Carbon::createFromDate($year, $month, $i)->format('Y-m-d');
        $colorClass = ''; // 初期化
        // $highlightedDates が単なる配列の場合のハイライトチェック
        $isHighlighted = in_array($date, $highlightedDates);
        // もし highlightedDates に範囲情報（start, end, color）があるなら、チェック
        foreach ($highlightedDates as $range) {
            if (isset($range['start'], $range['end'], $range['color']) &&
                $date >= $range['start'] && $date <= $range['end']) {
                $colorClass = $range['color'];
                break;
            }
        }
        // もし $colorClass がセットされていなければ、$isHighlighted をクラスに利用
        $cellClass = $colorClass ?: ($isHighlighted ? 'highlight' : '');
    @endphp
    <td class="{{ $cellClass }}" data-date="{{ $date }}">
        {{ $i }}
    </td>
    @php $currentCell++; @endphp
    @if ($currentCell % 7 === 0)
        </tr><tr>
    @endif
@endfor

            <!-- 最終行を7セルに揃える -->
            @while ($currentCell % 7 !== 0)
              <td></td>
              @php $currentCell++; @endphp
            @endwhile

          </tr>
        </table>
      </div>
    </div>

        <div class="spending">
            <h2>Spending</h2>
            <div class="spending-item">
                <div class="spending-icon">
                    <img src="/css/img/hotel.png" alt="Hotel Icon">
                </div>
                <label>Hotel</label>
                <div class="progress-bar">
                    <div class="progress" style="width: 60%;"></div>
                </div>
                <span class="percentage">60%</span>
            </div>
            <div class="spending-item">
                <div class="spending-icon">
                    <img src="/css/img/img_2.jpg.webp" alt="Food Icon">
                </div>
                <label>Food</label>
                <div class="progress-bar">
                    <div class="progress" style="width: 30%;"></div>
                </div>
                <span class="percentage">30%</span>
            </div>
            <div class="spending-item">
                <div class="spending-icon">
                    <img src="/css/img/IMG_1325.png" alt="Flight Tickets Icon">
                </div>
                <label>Tickets</label>
                <div class="progress-bar">
                    <div class="progress" style="width: 80%;"></div>
                </div>
                <span class="percentage">80%</span>
            </div>
            <div class="spending-item">
                <div class="spending-icon">
                    <img src="/css/img/henry-be-MdJq0zFUwrw-unsplash.png" alt="Activities Icon">
                </div>
                <label>Activities</label>
                <div class="progress-bar">
                    <div class="progress" style="width: 50%;"></div>
                </div>
                <span class="percentage">50%</span>
            </div>
            <div class="spending-item spending-total">
                <div class="spending-icon">
                    <img src="/css/img/0c17a417-6350-4b79-9084-5eddecb8b951.png" alt="Budget Icon">
                </div>
                <label>Budget</label>
                <div class="progress-bar">
                    <div class="progress" style="width: 80%;"></div>
                </div>
                <span class="percentage">80%</span>
            </div>
        </div>

        <div class="reviews">
            <h2>Reviews</h2>
            <ul>
                <li class="review">
                    <div class="review-header">
                        <p><strong>Michael</strong> - <span>2025-02-04 14:30</span></p>
                        <div class="rating">⭐⭐⭐⭐☆</div>
                    </div>
                    <div class="review-content" style="background-color: #e8f5e9;">
                        <p>Great experience, would recommend!</p>
                    </div>
                </li>
                <li class="review">
                    <div class="review-header">
                        <p><strong>Anderson</strong> - <span>2025-02-03 19:45</span></p>
                        <div class="rating">⭐⭐⭐☆☆</div>
                    </div>
                    <div class="review-content" style="background-color: #e1bee7;">
                        <p>Good but could be improved.</p>
                    </div>
                </li>
                <li class="review">
                    <div class="review-header">
                        <p><strong>Julia</strong> - <span>2025-02-02 10:15</span></p>
                        <div class="rating">⭐⭐⭐⭐⭐</div>
                    </div>
                    <div class="review-content" style="background-color: #6b9adb;">
                        <p>Amazing service! Will come again.</p>
                    </div>
                </li>
            </ul>
            <div class="review-form">
                <input type="text" placeholder="Your Name">
                <select>
                    <option value="5">★★★★★</option>
                    <option value="4">★★★★☆</option>
                    <option value="3">★★★☆☆</option>
                    <option value="2">★★☆☆☆</option>
                    <option value="1">★☆☆☆☆</option>
                </select>
                <textarea placeholder="Write your review..."></textarea>
                <button>Submit</button>
            </div>
        </div>

        <div class="favorites">
            <h2>Favorite Places</h2>
            <div class="favorite-list">
                <div class="favorite-item">
                    <div class="favorite-icon">
                        <img src="/css/img/luxembourg-investment-seminar-in-tokyo-2023-2.png" alt="Tokyo Icon">
                    </div>
                    <div class="favorite-details">
                        <p><strong>Tokyo</strong></p>
                        <p>Japan’s bustling capital city.</p>
                    </div>
                </div>
                <div class="favorite-item">
                    <div class="favorite-icon">
                        <img src="/css/img/753564-visuel-paris-tour-eiffel-rue.jpg" alt="Paris Icon">
                    </div>
                    <div class="favorite-details">
                        <p><strong>Paris</strong></p>
                        <p>Known for its art, fashion, and culture.</p>
                    </div>
                </div>
                <!-- <h4>Hot Destinations</h4> -->
                <div class="favorite-item">
                    <div class="favorite-icon">
                        <img src="/css/img/Unknown.jpeg" alt="Bangkok Icon">
                    </div>
                    <div class="favorite-details">
                        <p><strong>Bangkok</strong></p>
                        <p>A vibrant city with amazing street food. Visited before.</p>
                    </div>
                </div>
                <div class="favorite-item">
                    <div class="favorite-icon">
                        <img src="/css/img/img_1.jpg-3.webp" alt="Taipei Icon">
                    </div>
                    <div class="favorite-details">
                        <p><strong>Taipei</strong></p>
                        <p>Blend of modern and traditional culture.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="map">
            <h2>Map</h2>
            <div id="map"></div>
        </div>

        <div class="ticket">
            <h2>Reserved Ticket</h2>
            <div class="ticket-details">
                <div class="ticket-item">
                    <div class="date">
                        <strong>9月24日</strong>
                        <p> Tokyo (HND) to Paris (CDG)</p>
                    </div>
                    <div class="flight-info">
                        <div class="flight-icon">✈️</div>
                        <div class="airline-logo">
                            <img src="https://via.placeholder.com/50x30" alt="Airline Logo">
                        </div>
                        <p>Airline: ANA NH203</p>
                        <div class="time">
                            <p>09:35 <span class="to">→</span> 17:10</p>
                        </div>
                    </div>
                    <div class="additional-info">

                        <p>Weather at Destination: <img src="https://via.placeholder.com/20" alt="Weather Icon">
                            20°C, Sunny</p>
                    </div>

                </div>

                <div class="ticket-item">
                    <div class="date">
                        <strong>9月28日</strong>
                        <p>Paris (CDG) to Tokyo (HND)</p>
                    </div>
                    <div class="flight-info">
                        <div class="flight-icon">✈️</div>
                        <div class="airline-logo">
                            <img src="https://via.placeholder.com/50x30" alt="Airline Logo">
                        </div>
                        <p>Airline: ANA NH204</p>
                        <div class="time">
                            <p>19:20 <span class="to">→</span> 15:55</p>
                        </div>
                    </div>
                    <div class="additional-info">
                        <p>Weather at Destination: <img src="https://via.placeholder.com/20" alt="Weather Icon">
                            25°C, Clear</p>
                    </div>
                </div>
                <div class="additional-notes">
                    <p>Notes: Visa may needed</p>
                </div>
            </div>
        </div>
    </section>

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const map = L.map('map').setView([35.6895, 139.6917], 11); // Center on Tokyo

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            // Markers for visited locations
            const markers = [
                { lat: 35.6329, lng: 139.8804, info: "Tokyo Disneyland - Visited" }, // Tokyo Disneyland
                { lat: 35.6586, lng: 139.7454, info: "Tokyo Tower - Visited" }      // Tokyo Tower
            ];

            markers.forEach(marker => {
                L.marker([marker.lat, marker.lng]).addTo(map)
                    .bindPopup(marker.info)
                    .openPopup();
            });

            // Example of adding interactive search
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
                        map.setView([location.lat, location.lon], 13);
                        L.marker([location.lat, location.lon]).addTo(map)
                            .bindPopup(`You searched for: ${query}`)
                            .openPopup();
                    } else {
                        alert("Location not found. Try a different search.");
                    }
                })
                .catch(error => console.error("Error fetching location:", error));
        }
    </script>


</body>

</html>