<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}"> <!-- Gantilah "profile.css" dengan nama file CSS Anda -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Tautan font Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <style>
        /* Tambahkan CSS ini */
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .edit-info,
        .welcome {
            display: flex;
            justify-content: space-between;
        }

        .column-left,
        .column-right {
            width: 30%;
            /* Sesuaikan lebar kolom sesuai kebutuhan */
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

            <button type="button" class="btn filldatabtn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Fill Data
            </button>
        </div>

        <div class="column-right">
            <h2>View Data</h2>
            <p>Anda dapat melihat data yang telah disimpan di sini.</p>
            <button type="button" class="btn filldatabtn" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                View Data
            </button>
        </div>

        <div class="column-right">
            <h2>Other Data</h2>
            <p>Anda dapat melakukan request data orang lain yang telah disimpan di sini.</p>
            <a href="{{ route('user.showinsertemail', ['userId' => $userId]) }}">Other Data</a>
        </div>

        <div class="column-right">
            <h2>Request Data</h2>
            <p>Anda dapat melihat notifikasi request yang diberikan user lain kepada Anda.</p>
            <a href="{{ route('request.showlist', ['userId' => $userId]) }}">Request Data</a>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Isi password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <p>Isikan password Anda.</p>

                    <form method="POST" action="{{ route('user.checkpassword', ['userId' => $userId]) }}">
                        @csrf
                        <div class="form-group">
                            <label for="passdata">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                    
                        <div class="modal-footer">
                            <button type="submit" class="lihat px-2 py-1">
                                <a style="color:black; text-decoration: none" href="">
                                    Submit
                                </a>
                            </button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Isi password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <p>Isikan password Anda.</p>

                    <form method="POST" action="{{ route('user.checkpasswordview', ['userId' => $userId]) }}">
                        @csrf
                        <div class="form-group">
                            <label for="passdata">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                    
                        <div class="modal-footer">
                            <button type="submit" class="lihat px-2 py-1">
                                <a style="color:black; text-decoration: none" href="">
                                    Submit
                                </a>
                            </button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <footer>
        &copy; 2023
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>