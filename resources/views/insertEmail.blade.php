<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="{{ asset('css/insertEmail.css') }}"> <!-- Gantilah "styles.css" dengan nama file CSS Anda -->
    <!-- Tautan font Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1>Dashboard</h1>
    </header>
    <nav>
        <ul>
            <li><a href="{{ route('user.dashboard', ['userId' => $userId]) }}">Dashboard</a></li>
        </ul>
    </nav>
    <main>
        <form action="{{ route('user.checkemail', ['userId' => $userId]) }}" method="POST" id="personalDataForm" enctype="multipart/form-data">
            @csrf
            <section class="personal-data">
                <h2>Isikan Email Dari Orang Yang Ingin Anda Cari</h2>
                    <div class="form-row">
                        <label for="email">Alamat Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    @if ($errors->has('email_inexistent'))
                        <div style="color: red;" class="error">{{ $errors->first('login_error') }}</div>
                    @endif
            </section>
            <button type="submit">Cari Email</button>
        </form>
    </main>

    <footer>
        &copy; 2023
    </footer>
    {{-- <script>
        document.getElementById("children").addEventListener("change", function() {
            const childrenData = document.getElementById("childrenData");
            if (this.value === "0") {
                childrenData.style.display = "none";
            } else {
                childrenData.style.display = "block";
            }
        });
        document.getElementById("personalDataForm").addEventListener("submit", function(event) {
            event.preventDefault();
            // Proses penyimpanan data pribadi dan file yang diunggah di sini
        });
    </script> --}}
</body>
</html>