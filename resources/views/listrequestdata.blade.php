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
        @if ($information == null)
        <main>
            <div class="text-center">
                <h1>There's no request</h1>
            </div>
        </main>
    </nav>
        @else
            @php
                $userId = $information->first()->user_id;
            @endphp
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
                        <th scope="col" class="text-center col-3">Id Informasi</th>
                        <th scope="col" class="text-center col-3">Waktu Pengisian</th>
                        <th scope="col" class="text-center col-3">Email Pemohon</th>
                        <th scope="col" class="text-center col-3">Status</th>
                        <th scope="col" class="text-center col-3">Request</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($information as $info)
                    <tr>
                        <td class="px-3">{{ $info->id }}</td>
                        <td class="px-3">{{ $info->information_id }}</td>
                        <td class="px-3 text-center">{{ $info->created_at}}</td>
                        {{-- <td class="px-3 text-center">2023-10-24 15:29</td> --}}
                        <td class="px-3 text-center">{{ $info->senderEmail}}</td>
                        <td class="px-3 text-center">{{ $info->status}}</td>
                        <td class="text-center py-3">
                            <form action="{{ route('request.accept', ['requestId' => $info->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="info_id" value="{{ $info->id }}">
                                <button type="submit" class="lihat px-2 py-1 dist">Accept</button>
                            </form>
                            
                            <form action="{{ route('request.decline', ['requestId' => $info->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="info_id" value="{{ $info->id }}">
                                <button type="submit" class="lihat px-2 py-1 dist">Decline</button>
                            </form>
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
        </main>
        @endif

    <footer>
        &copy; 2023
    </footer>

</body>

</html>