<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
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
                <button class="signup-btn" type="button">Sign up</button>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="login-form">
            <div class="form-header">
                <h2>Login</h2>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="login-type">
                    <label>
                        <input type="radio" name="loginType" value="personal" checked> Personal Login
                    </label>
                    <label>
                        <input type="radio" name="loginType" value="company"> Company Login
                    </label>
                </div>

                <div class="form-group" id="username-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username">
                </div>

                <div class="form-group" id="company-id-group" style="display: none;">
                    <label for="company-id">Company ID:</label>
                    <input type="text" id="company-id" name="company-id" placeholder="Enter your company ID">
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>

                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Always Remember Me</label>
                </div>

                <button type="submit" class="login-btn">Login</button>
            </form>

            <p>Don't have an account? <a href="signup.html">Sign up here</a></p>
            <p>Forgot your password? <a href="findpw.html">Click here</a></p>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const personalFields = document.getElementById('username-group');
                const companyFields = document.getElementById('company-id-group');
                const selectedType = document.querySelector('input[name="loginType"]:checked').value;

                if (selectedType === 'personal') {
                    personalFields.style.display = 'block';
                    companyFields.style.display = 'none';
                } else {
                    personalFields.style.display = 'none';
                    companyFields.style.display = 'block';
                }

                document.querySelectorAll('input[name="loginType"]').forEach((radio) => {
                    radio.addEventListener('change', (event) => {
                        if (event.target.value === 'personal') {
                            personalFields.style.display = 'block';
                            companyFields.style.display = 'none';
                        } else {
                            personalFields.style.display = 'none';
                            companyFields.style.display = 'block';
                        }
                    });
                });
            });
        </script>
    </div>
</body>


</html>