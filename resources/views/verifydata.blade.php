<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/view.css') }}"> <!-- Gantilah "form.css" dengan nama file CSS Anda -->
    <!-- Tautan font Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>

<body>
    <main>
        <section class="personal-data">
            <!-- @if (datanya diverify) -->
            <div class="data-row">
                <label for="">Hash:</label>
                <p>-</p>
            </div>
            <div class="data-row">
                <label for="">Date:</label>
                <p>-</p>
            </div>
            <div class="data-row">
                <label for="">Issuer:</label>
                <p>-</p>
            </div>
            <div class="data-row">
                <label for="">Signature date:</label>
                <p>-</p>
            </div>

            <button type="button" class="btn lihat px-2 py-1 dist" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <a style="color: white; text-decoration: none;" href="{{ route('user.showview', ['userId' => $userId, 'infoId' => $infoId]) }}">Kembali</a>
            </button>

            <!-- @else -->
            <p>Verifikasi gagal.</p>
            <!-- @endif -->
        </section>


    </main>

    <footer>
        &copy; 2023
    </footer>
</body>

</html>