<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="list.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <header>
        <h1>Dashboard</h1>
    </header>
    <nav>
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
                        <th scope="col" class="text-center col-3">Judul Informasi</th>
                        <th scope="col" class="text-center col-3">Status Verifikasi</th>
                        <th scope="col" class="text-center col-3">Verify</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- @foreach ($information as $info) -->
                    <tr>
                        <td class="px-3 text-center">{{ $info->id }}</td>
                        <td class="px-3 text-center">{{ $info->information_id }}</td>
                        <td class="px-3 text-center">{{ $info->title}}</td>
                        <td class="px-3 text-center">{{ $info->verify}}</td>
                        <td class="text-center py-3">
                            <button data-status="" type="button" class="lihat px-2 py-1 dist verify-button" data-toggle="modal" data-target="#successModal">Verify</button>
                        </td>
                    </tr>
                    <!-- @endforeach -->
                </tbody>
            </table>
        </div>
    </main>
    <footer>
        &copy; 2023
    </footer>

    <!-- Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Verifikasi Sukses</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Data telah berhasil diverifikasi.
                </div>
               
            </div>
        </div>
    </div>

    <!-- Load jQuery dan Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <style>
        button:disabled {
            pointer-events: none;
            background-color: #999;
        }
    </style>
    

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var verifyButtons = document.querySelectorAll('.verify-button');

            verifyButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    $('#successModal').modal('show');
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var closeButtons = document.querySelectorAll('.close');

            closeButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var modalId = this.closest('.modal').id;
                    $(#${modalId}).modal('hide');
                });
            });
        });
    </script>
</body>
</html>