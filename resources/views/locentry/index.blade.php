<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/stylelocentry.css">
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
</head>

<body>
    <header>
        <div class="nav-container">
            <div class="logo">
                <h1>BonVoyage</h1>
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
                <button class="signup-btn">Sign out</button>
            </div>
        </div>
    </header>

    <div class="container">
        <!-- Main content area for Map -->
        <main class="map-area">
            <div id="map"></div>
        </main>

        <!-- Right Sidebar for Events and Messages -->
        <aside class="events-sidebar">

            <!-- 場所情報 -->
            <div id="info">
                <b>場所情報:</b> 下記に詳細情報を表示します。
            </div>

            <!-- 検索バー -->
            <h2>住所を入力するか地図で選択してください。</h2>
            <div class="search">
                <input type="text" id="search-input" placeholder="住所を入力してください (例: 東京都渋谷区渋谷1丁目2-3)">
                <button id="search-btn">検索</button>
            </div>

            <!-- 追加された Pin 情報 -->
            <div id="pin-list" style="margin-top: 20px; font-size: 16px; color: #333; padding: 10px; background-color: #f4f4f4; border-radius: 10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                <b>追加された Pin:</b>
                <ul id="pin-list-items" style="list-style: none; padding: 0;"></ul>
            </div>

            <!-- 保存確認用 -->
            <div id="confirm-info" style="margin-top: 20px; display: none; font-size: 16px; color: #333; padding: 10px; background-color: #f9f9f9; border-radius: 10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                <h3>保存内容を確認してください</h3>
                <p id="confirm-details"></p>
                <button id="confirm-btn" style="margin-right: 10px; padding: 10px 20px; background-color: #007BFF; color: white; border: none; border-radius: 5px; cursor: pointer;">
                    確認
                </button>
                <button id="edit-btn" style="padding: 10px 20px; background-color: #ffc107; color: white; border: none; border-radius: 5px; cursor: pointer;">
                    編集
                </button>
            </div>

        </aside>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script src="spot_registration.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let pins = []; // すべての Pin 情報を保存
            let currentPin = null; // 現在処理中の Pin 情報
            let temporaryMarker = null; // 一時的な Pin

            const map = L.map('map', { zoomControl: false }).setView([35.6895, 139.6917], 10);

            // 地図の初期化
            L.control.zoom({ position: 'bottomright' }).addTo(map);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            // DOM 要素の取得
            const infoBox = document.getElementById('info');
            const pinList = document.getElementById('pin-list-items');
            const searchInput = document.getElementById('search-input');
            const searchButton = document.getElementById('search-btn');

            // 「検索」ボタンをクリック
            searchButton.addEventListener('click', async function () {
                const query = searchInput.value.trim();
                if (!query) {
                    alert("住所を入力してください。");
                    return;
                }

                const location = await searchAddress(query);
                if (location) {
                    const { lat, lon, address } = location;
                    map.setView([lat, lon], 14);
                    placeTemporaryPin(lat, lon, address);
                    handlePinInput(lat, lon, address);
                } else {
                    alert("住所が見つかりませんでした。");
                }
            });

            // 地図クリックイベント
            map.on('click', async function (e) {
                const lat = e.latlng.lat;
                const lon = e.latlng.lng;
                const address = await fetchAddress(lat, lon);
                placeTemporaryPin(lat, lon, address);
                handlePinInput(lat, lon, address);
            });

            // 一時的な Pin を配置
            function placeTemporaryPin(lat, lon, address) {
                if (temporaryMarker) map.removeLayer(temporaryMarker); // 前の一時 Pin を削除
                temporaryMarker = L.marker([lat, lon]).addTo(map).bindPopup(address || "住所情報なし").openPopup();
            }

            // Pin 情報を処理
            function handlePinInput(lat, lon, address) {
                currentPin = { lat, lon, address };

                infoBox.innerHTML = `
                    <div>
                        <b>選択された位置:</b><br>
                        <b>緯度:</b> ${lat}<br>
                        <b>経度:</b> ${lon}<br>
                        <b>住所:</b> ${address || "住所情報なし"}<br>
                    </div>
                    <div style="margin-top: 15px;">
                        <label for="pin-name"><b>名前:</b></label><br>
                        <input type="text" id="pin-name" placeholder="例: 新しい場所" style="width: 100%; padding: 5px; margin-bottom: 10px;" /><br>

                        <label for="pin-price"><b>金額:</b></label><br>
                        <input type="number" id="pin-price" placeholder="例: 1000" style="width: 100%; padding: 5px; margin-bottom: 10px;" min="0" step="any" /><br>

                        <label for="pin-note"><b>備考:</b></label><br>
                        <textarea id="pin-note" placeholder="例: 詳細情報を入力してください" style="width: 100%; padding: 5px;"></textarea><br>

                        <button id="preview-pin-btn" style="padding: 5px 10px; background-color: #007BFF; color: white; border: none; border-radius: 5px; cursor: pointer; margin-top: 10px;">次へ</button>
                    </div>
                `;

                document.getElementById('preview-pin-btn').addEventListener('click', () => showConfirmation(false));
            }

            // 確認画面を表示（追加または編集）
            function showConfirmation(isEditing) {
                const name = document.getElementById('pin-name').value.trim() || `場所 ${pins.length + 1}`;
                const price = parseFloat(document.getElementById('pin-price').value.trim()) || 0;
                const note = document.getElementById('pin-note').value.trim() || "なし";

                currentPin = { ...currentPin, name, price, note, date: new Date().toLocaleDateString() };

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                infoBox.innerHTML = `
                    <form action="{{ route('store') }}" method="POST">
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <div>
                            <b>内容を確認してください:</b><br>
                            <b>名前:</b> ${currentPin.name}<br>
                            <b>金額:</b> ${currentPin.price} 円<br>
                            <b>備考:</b> ${currentPin.note}<br>
                            <b>住所:</b> ${currentPin.address || "住所情報なし"}<br>
                            <b>緯度:</b> ${currentPin.lat}<br>
                            <b>経度:</b> ${currentPin.lon}<br>
                            <b>追加日:</b> ${currentPin.date}<br>
                        </div>

                        <!-- 表示されないけど、データベースに送信 -->
                        <input type="hidden" name="Name" value="${currentPin.name}">
                        <input type="hidden" name="Location" value="${currentPin.address}">
                        <input type="hidden" name="Latitude" value="${currentPin.lat}">
                        <input type="hidden" name="Longitude" value="${currentPin.lon}">
                        <input type="hidden" name="Price" value="${currentPin.price}">

                        <div style="margin-top: 15px;">
                            <button type="submit" id="save-pin-btn" style="padding: 5px 10px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">保存</button>
                            <button type="button" id="cancel-pin-btn" style="padding: 5px 10px; background-color: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer;">キャンセル</button>
                        </div>
                    </form>
                `;

                document.getElementById('save-pin-btn').addEventListener('click', () => {
                    const form = document.querySelector('form');
                    form.submit();  // フォームを送信
                });

                document.getElementById('cancel-pin-btn').addEventListener('click', cancelPin);
            }

            // Pin をキャンセル
            function cancelPin() {
                if (temporaryMarker) {
                    map.removeLayer(temporaryMarker); // 一時 Pin を削除
                    temporaryMarker = null;
                }
                currentPin = null; // 現在の Pin 情報をクリア
                resetInfoBox(); // infoBox の内容をリセット
            }

            // infoBox をリセット
            function resetInfoBox() {
                infoBox.innerHTML = `<b>場所情報:</b> 地図をクリックするか、住所を検索してください。`;
            }

            // 住所を検索
            async function searchAddress(query) {
                const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`;
                try {
                    const response = await fetch(url);
                    const data = await response.json();
                    if (data.length > 0) {
                        const result = data[0];
                        return {
                            lat: parseFloat(result.lat),
                            lon: parseFloat(result.lon),
                            address: result.display_name
                        };
                    }
                    return null;
                } catch (error) {
                    console.error("住所の検索中にエラーが発生しました:", error);
                    return null;
                }
            }

            // 緯度と経度で住所を取得
            async function fetchAddress(lat, lon) {
                const url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}&addressdetails=1`;
                try {
                    const response = await fetch(url);
                    const data = await response.json();
                    return data.display_name || null;
                } catch (error) {
                    console.error("住所の取得に失敗しました:", error);
                    return null;
                }
            }
        });
    </script>

</body>

</html>
