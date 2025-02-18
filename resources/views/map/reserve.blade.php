<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Confirmation</title>
    <link rel="stylesheet" href="/css/stylemapres.css">
</head>

<body>
    <header>
        <div class="nav-container">
            <div class="logo">
                <h1>BonVoyage</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Discover</a></li>
                    <li><a href="#">Bookings</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>
            <div class="btnarea">
                <button class="nav-btn">MY PAGE</button>
                <div class="cart-container">
                    <button class="signup-btn cart-button">Cart</button>
                    <div class="cart-content">
                        <div class="cart-header">
                            <h3>Your Cart</h3>
                            <button class="close-button" id="close-cart">×</button>
                        </div>
                        <div id="cart-items"></div>
                        <div class="cart-footer">
                            <button id="checkout-btn">Checkout</button>
                        </div>
                    </div>
                </div>
                <button class="signup-btn">Sign out</button>
            </div>
        </div>
    </header>

    <div class="container">
        <main class="reservation-confirmation">
            <h2 class="reservation-title">Reservation Confirmation</h2>
            <div class="spot-thumbnail">
                <img id="thumbnail" alt="Spot Thumbnail" class="spot-image" width="400" height="400">
            </div>
            <div class="details">
                <ul id="reservation-details" class="reservation-list">
                    @foreach ($facilities as $facility)
                        <li class="reservation-item">
                            <strong>{{ $facility['name'] }}</strong> - {{ number_format($facility['price']) }} USD<br>
                            <em>Location: {{ $facility['lat'] }}, {{ $facility['lng'] }}</em>
                        </li>
                    @endforeach
                </ul> <!-- 予約詳細のリストを表示 -->
            </div>
            <div class="total-price">
                <p><strong>Total Price:</strong> {{ number_format($totalPrice) }} USD</p>
            </div>

            <!-- 予約日付フォームを追加 -->
            <div class="reservation-date">
                <p><strong>Departure Date:</strong>
                    <input type="date" id="departure-date" name="departure-date" class="date-input">
                </p>
                <p><strong>Return Date:</strong>
                    <input type="date" id="return-date" name="return-date" class="date-input">
                </p>
            </div>

            <div class="actions">
                <button id="confirm-btn" class="confirm-btn">Confirm</button>
                <button id="back-btn" class="signup-btn">Back</button>
            </div>
        </main>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // 戻るボタン
        document.getElementById('back-btn').addEventListener('click', () => {
            window.history.back();
        });

        // Confirmボタンのクリックイベント
        document.getElementById('confirm-btn').addEventListener('click', () => {
            // 日付の取得
            const departureDate = document.getElementById('departure-date').value;
            const returnDate = document.getElementById('return-date').value;

            // 予約確認画面のクエリパラメータを作成
            const queryParams = new URLSearchParams({
                totalPrice: {{ $totalPrice }},
                departureDate: departureDate,
                returnDate: returnDate
            });

            @foreach ($facilities as $index => $facility)
                queryParams.append(`facility[{{ $index }}][name]`, "{{ $facility['name'] }}");
                queryParams.append(`facility[{{ $index }}][price]`, "{{ $facility['price'] }}");
                queryParams.append(`facility[{{ $index }}][lat]`, "{{ $facility['lat'] }}");
                queryParams.append(`facility[{{ $index }}][lng]`, "{{ $facility['lng'] }}");
            @endforeach

            // 決済画面への遷移
            window.location.href = `/map/reserve/checkout?${queryParams.toString()}`;
        });
    });
</script>

</body>
</html>
