<!DOCTYPE html>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <div class="container">
        <h2>Registrasi</h2>
        <form action="{{ route('user.register') }}" method="POST" id="registrationForm">
            @csrf
            <div class="form-group">
                <label for="fullname">Nama Lengkap</label>
                <input type="text" id="fullname" name="fullname" required>
            </div>
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" required>
                @error('email')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Daftar</button>
            <button>
                <a class="regbutton" href="{{ route('user.showlogin') }}">Sudah Punya Akun?</a>
            </button>
            
        </form>
    </div>
    
</body>
<script>
    document.getElementById("registrationForm").addEventListener("submit", function(event){

    const fullname = document.getElementById("fullname").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    console.log("Panjang password:", password.length);
    console.log("Memiliki angka:", /\d/.test(password));
    console.log("Memiliki huruf:", /[a-zA-Z]/.test(password));

if (password.length < 8 || !/\d/.test(password) || !/[a-zA-Z]/.test(password)) {
    alert("Password harus terdiri dari minimal 8 karakter dan mengandung setidaknya satu huruf dan satu angka.");
    event.preventDefault();
    return;
}

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
</html>