<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}"> <!-- Gantilah "profile.css" dengan nama file CSS Anda -->

    <!-- Tautan font Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <style>
        /* Tambahkan CSS ini */
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .edit-info, .welcome {
            display: flex;
            justify-content: space-between;
        }

        .column-left, .column-right {
            width: 45%; /* Sesuaikan lebar kolom sesuai kebutuhan */
            padding: 20px;
            border: 1px solid #ccc;
            margin: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Dashboard</h1>
    </header>

    <nav>
        <ul>
            <li><a href="{{ route('user.dashboard', ['userId' => $userId]) }}">Dashboard</a></li>
            <li><a href="{{ route('logout') }}">Keluar</a></li>
        </ul>
    </nav>

    <section class="welcome">
        <h2>Selamat Datang, {{ $latestInfo->name }}!</h2>
    </section>

    <section class="edit-info">
        <div class="column-left">
            <h2>Fill Data</h2>
            <p>Anda dapat mengisikan informasi pribadi di sini.</p>
            <a href="{{ route('user.showform', ['userId' => $userId]) }}">Fill Data</a>
        </div>

        <div class="column-right">
            <h2>View Data</h2>
            <p>Anda dapat melihat data yang telah disimpan di sini.</p>
            <a href="{{ route('user.showview', ['userId' => $userId]) }}">View Data</a>
        </div>
    </section>

    <footer>
        &copy; 2023
    </footer>
</body>
</html>