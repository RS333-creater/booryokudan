<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>決済ページ</title>
  <link rel="stylesheet" href="/css/stylepay.css">
  <script>
    // クエリパラメータを取得する関数
    function getQueryParams() {
        const urlParams = new URLSearchParams(window.location.search);
        let params = {
            totalPrice: urlParams.get('totalPrice'),
            departureDate: urlParams.get('departureDate'),  // departureDateを取得
            returnDate: urlParams.get('returnDate'),  // returnDateを取得
            facilities: []
        };

        // 施設情報を取得
        let index = 0;
        while (urlParams.has(`facility[${index}][name]`)) {
            params.facilities.push({
            name: urlParams.get(`facility[${index}][name]`),
            price: urlParams.get(`facility[${index}][price]`),
            lat: urlParams.get(`facility[${index}][lat]`),
            lng: urlParams.get(`facility[${index}][lng]`)
            });
            index++;
        }
        return params;
    }

    // ページの内容を動的に更新する関数
    function updatePageContent() {
      const params = getQueryParams();
      const totalPrice = params.totalPrice || 0;

      // 施設リストの表示
      const reservationDetails = document.getElementById('reservation-details');
      params.facilities.forEach(facility => {
        const listItem = document.createElement('div');
        listItem.classList.add('item');
        listItem.innerHTML = `<span>${facility.name} × 1</span><strong>¥${facility.price}</strong>`;
        reservationDetails.appendChild(listItem);
      });

      // 合計金額の更新
      const totalElement = document.querySelector('.total');
      totalElement.innerHTML = `
        <p><span>小計:</span> <strong>¥${totalPrice}</strong></p>
        <p><span>税金 (10%):</span> <strong>¥${(totalPrice * 0.10).toFixed(0)}</strong></p>
        <p><span>その他費用:</span> <strong>¥500</strong></p>
        <p><span>合計:</span> <strong>¥${(totalPrice * 1.1 + 500).toFixed(0)}</strong></p>
      `;
    }


    // 施設情報と日付をhiddenフィールドとしてフォームに追加する関数
    function appendHiddenFields() {
    const params = getQueryParams();
    const form = document.getElementById('paymentForm');

    // 施設情報をhiddenフィールドとして追加
    params.facilities.forEach((facility, index) => {
        let nameInput = document.createElement('input');
        nameInput.type = 'hidden';
        nameInput.name = `facility[${index}][name]`;
        nameInput.value = facility.name;
        form.appendChild(nameInput);

        let priceInput = document.createElement('input');
        priceInput.type = 'hidden';
        priceInput.name = `facility[${index}][price]`;
        priceInput.value = facility.price;
        form.appendChild(priceInput);

        let latInput = document.createElement('input');
        latInput.type = 'hidden';
        latInput.name = `facility[${index}][lat]`;
        latInput.value = facility.lat;
        form.appendChild(latInput);

        let lngInput = document.createElement('input');
        lngInput.type = 'hidden';
        lngInput.name = `facility[${index}][lng]`;
        lngInput.value = facility.lng;
        form.appendChild(lngInput);
    });

    // 日付をhiddenフィールドとして追加
    if (params.departureDate) {
        let departureInput = document.createElement('input');
        departureInput.type = 'hidden';
        departureInput.name = 'departureDate';
        departureInput.value = params.departureDate;
        form.appendChild(departureInput);
    }

    if (params.returnDate) {
        let returnInput = document.createElement('input');
        returnInput.type = 'hidden';
        returnInput.name = 'returnDate';
        returnInput.value = params.returnDate;
        form.appendChild(returnInput);
    }
    }

    document.addEventListener('DOMContentLoaded', () => {
    updatePageContent();
    appendHiddenFields();  // hiddenフィールドをフォームに追加
    });
    // 決済処理とフォーム送信
    function validateForm(event) {
      event.preventDefault(); // デフォルトのフォーム送信を防ぐ

      // 入力チェック
      const cardNumber = document.getElementById("cardNumber").value.trim();
      const cardHolder = document.getElementById("cardHolder").value.trim();
      const expiryMonth = document.getElementById("expiryMonth").value;
      const expiryYear = document.getElementById("expiryYear").value;
      const cvv = document.getElementById("cvv").value.trim();

      if (!cardNumber || !cardHolder || !expiryMonth || !expiryYear || !cvv) {
        alert("すべての入力項目を正しく入力してください。");
        return;
      }

      // 決済処理のシミュレーション（実際の決済処理を組み込む場合はここを変更）
      setTimeout(() => {
        alert("決済が完了しました！");
        event.target.submit(); // フォームをPOST送信
      }, 1000);
    }
  </script>
</head>
<body>
  <header>
    <!-- ヘッダーの内容 -->
  </header>

  <div class="container">
    <div class="order-section">
      <div class="order-details">
        <h2>注文詳細</h2>
        <div id="reservation-details"></div>
        <div class="total"></div>
      </div>
    </div>

    <div class="payment-section">
      <!-- action 属性で POST 先のルートを指定 -->
      <form id="paymentForm" action="{{ route('submit') }}" method="POST" onsubmit="validateForm(event)">
        @csrf
        <div>
          <label for="cardNumber">カード番号</label>
          <input type="text" id="cardNumber" name="cardNumber" placeholder="例: 1234 5678 9012 3456" maxlength="19" required>
        </div>
        <div>
          <label for="cardHolder">カード名義人</label>
          <input type="text" id="cardHolder" name="cardHolder" placeholder="例: Taro Yamada" required>
        </div>
        <div>
          <label for="expiryDate">有効期限</label>
          <div style="display: flex; gap: 10px;">
            <select id="expiryMonth" name="expiryMonth" required>
              <option value="" disabled selected>月</option>
              <option value="01">01</option>
              <option value="02">02</option>
              <option value="03">03</option>
              <option value="04">04</option>
              <option value="05">05</option>
              <option value="06">06</option>
              <option value="07">07</option>
              <option value="08">08</option>
              <option value="09">09</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
            </select>
            <select id="expiryYear" name="expiryYear" required>
              <option value="" disabled selected>年</option>
              <option value="2024">2024</option>
              <option value="2025">2025</option>
              <option value="2026">2026</option>
              <option value="2027">2027</option>
              <option value="2028">2028</option>
            </select>
          </div>
        </div>
        <div>
          <label for="cvv">CVV</label>
          <input type="number" id="cvv" name="cvv" placeholder="例: 123" required>
        </div>

        <button type="submit">決済を行う</button>
        <button type="button" onclick="window.history.back();">戻る</button>
      </form>
    </div>
  </div>
</body>
</html>
