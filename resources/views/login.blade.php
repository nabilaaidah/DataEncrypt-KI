<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <!-- Tautan font Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="{{ route('user.login') }}" method="POST" id="loginForm">
            @csrf
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            @if ($errors->has('login_error'))
                <div style="color: red;" class="error">{{ $errors->first('login_error') }}</div>
            @endif
            <br>
            <button type="submit">Login</button>
        </form>
    </div>
    
    <script>
        document.getElementById("loginForm").addEventListener("submit", function(event) {

            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert("Masukkan alamat email yang valid.");
                event.preventDefault();
                return;
            }

            if (password.length < 8 || !/\d/.test(password) || !/[a-zA-Z]/.test(password)) {
                alert("Password harus terdiri dari minimal 8 karakter dan mengandung setidaknya satu huruf dan satu angka.");
                event.preventDefault();
                return;
            }

        });
    </script>
</body>
</html>