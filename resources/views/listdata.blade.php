<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="{{ asset('css/list.css') }}"> <!-- Gantilah "styles.css" dengan nama file CSS Anda -->
    <!-- Tautan font Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
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

        <div class="container-fluid p-5">

            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th scope="col" class="text-center col-1">Id</th>
                        <th scope="col" class="text-center col-3">Title</th>
                        <th scope="col" class="text-center col-3">Nama</th>
                        <th scope="col" class="text-center col-3">Waktu Pengisian</th>
                        <th scope="col" class="text-center col-3">Hasil</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($information as $info)
                    <tr>
                        <td class="px-3">{{ $info->id }}</td>
                        <td class="px-3">{{ $info->title }}</td>
                        <td class="px-3">{{ $info->nama }}</td>
                        {{-- <td class="px-3">kanza</td> --}}
                        <td class="px-3 text-center">{{ $info->created_at}}</td>
                        {{-- <td class="px-3 text-center">2023-10-24 15:29</td> --}}
                        <td class="text-center py-3">
                            <a class="lihat px-2 py-1" href="{{ route('user.showview', ['userId' => $info->user_id, 'id' => $info->id]) }}" role="button">Lihat di sini</a>
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>

        </div>

    </main>

    <footer>
        &copy; 2023
    </footer>

</body>

</html>