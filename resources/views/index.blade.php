<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BonVoyage</title>
    <link rel="stylesheet" href="/css/styleindex.css">
</head>

<body>
    <div class="container">
        <!-- Header and Navigation -->
        <header>
            <div class="nav-container">
                <div class="logo">
                    <a href="/"><img src="/css/img/logo 1.png" alt=""></a>
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
                    <a href="/mypage"><button class="nav-btn">MY PAGE</button></a>
                    <button class="nav-btn">SETTINGS</button>
                    <a href="/login"><button class="signup-btn">Sign up</button></a>
                </div>
            </div>
            <div class="hero-section">
                <img src="/css/img/view-Ireland-coastline.jpg.webp" alt="Hero Image" class="hero-img">
                <div class="hero-text">
                    <h1>BonVoyage</h1>
                    <button class="see-more-btn">See More</button>
                </div>
            </div>
        </header>

        <!-- Search Filters -->
        <section class="search-section">
            <form action="{{route('map')}}">
                <div class="search-filters">
                    <input type="text" placeholder="City or address" class="filter-input" name="Addres">
                    <input type="date" class="filter-input">
                    <select class="filter-input">
                        <option>Landscape type</option>
                        <option>Mountains</option>
                        <option>Beaches</option>
                        <option>Cityscape</option>
                    </select>
                    <button class="search-btn" type="submit">
                        <img src="/css/img/search-button-svgrepo-com.svg" alt="Search">
                        Search
                    </button>
                </div>
            </form>
        </section>

        <!-- Recommended Destinations -->
        <section class="recommended-destination">
            <h2>Recommended Destinations</h2>
            <div class="destination-cards">
                <button class="card-nav prev-btn">&lt;</button>
                <div class="cards-wrapper">
                    <div class="cards-container">
                        <div class="card">
                            <img src="/css/img/tokyo-tower-night-landmark.jpg" alt="Tokyo">
                            <div class="card-content">
                                <h3>Tokyo</h3>
                                <p><span>Japan</span> | 4.9</p>
                            </div>
                        </div>
                        <div class="card">
                            <img src="/css/img/753564-visuel-paris-tour-eiffel-rue.jpg" alt="Paris">
                            <div class="card-content">
                                <h3>Paris</h3>
                                <p><span>France</span> | 4.5</p>
                            </div>
                        </div>

                        <div class="card">
                            <img src="/css/img/england.jpeg" alt="Beijing">
                            <div class="card-content">
                                <h3>London</h3>
                                <p><span>England</span> | 4.9</p>
                            </div>
                        </div>

                        <div class="card hidden-content">
                            <img src="/css/img/australia02.jpg" alt="Hidden Destination">
                            <div class="card-content">
                                <h3>Sidney</h3>
                                <p><span>Australia</span> | 4.0</p>
                            </div>
                        </div>

                        <div class="card hidden-content">
                            <img src="/css/img/canada.jpeg" alt="Hidden Destination">
                            <div class="card-content">
                                <h3>Canada</h3>
                                <p><span>Canada</span> | 4.2</p>
                            </div>
                        </div>

                        <div class="card">
                            <img src="/css/img/Great-Wall-New-Pic-228551391689622.jpg" alt="Beijing">
                            <div class="card-content">
                                <h3>China</h3>
                                <p><span>China</span> | 4.5</p>
                            </div>
                        </div>

                        <div class="card">
                            <img src="/css/img/newyork_NationalGeographic.jpeg" alt="Beijing">
                            <div class="card-content">
                                <h3>Newyork</h3>
                                <p><span>America</span> | 4.1</p>
                            </div>
                        </div>

                        <div class="card hidden-content">
                            <img src="/css/img/Unknown.jpeg" alt="Hidden Destination">
                            <div class="card-content">
                                <h3>HiddenDes</h3>
                                <p><span>HiddenLoc</span> | HiddenS</p>
                            </div>
                        </div>

                    </div>
                </div>
                <button class="card-nav next-btn">&gt;</button>
            </div>
        </section>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const prevBtn = document.querySelector('.prev-btn');
        const nextBtn = document.querySelector('.next-btn');
        const cards = document.querySelectorAll('.card');  // Assuming all cards
        let startIndex = 0;  // Start with the first 5 cards

        const totalCardsToShow = 5;  // Number of cards to show at a time

        // Assign an index to each card and ensure all cards are initially hidden except the first 5
        function showCards(startIndex) {
            cards.forEach((card, index) => {
                if (index >= startIndex && index < startIndex + totalCardsToShow) {
                    card.style.display = 'block';  // Show the card if within the range
                } else {
                    card.style.display = 'none';  // Hide the card otherwise
                }
            });
        }

        // Initially show the first 5 cards
        showCards(startIndex);

        // Event listener for the next button
        nextBtn.addEventListener('click', () => {
            console.log("Next button clicked, startIndex:", startIndex);

            // Ensure we don't exceed the number of cards
            if (startIndex + totalCardsToShow < cards.length) {
                startIndex++;  // Move the window forward by one card
                showCards(startIndex);  // Show the next set of 5 cards
            } else {
                console.log("No more cards to show.");
            }
        });

        // Event listener for the previous button
        prevBtn.addEventListener('click', () => {
            console.log("Previous button clicked, startIndex:", startIndex);

            // Ensure we don't go below the first card
            if (startIndex > 0) {
                startIndex--;  // Move the window backward by one card
                showCards(startIndex);  // Show the previous set of 5 cards
            } else {
                console.log("No more cards to hide.");
            }
        });
    });
</script>