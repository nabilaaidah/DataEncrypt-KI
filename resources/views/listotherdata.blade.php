<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="{{ asset('css/list.css') }}"> <!-- Gantilah "styles.css" dengan nama file CSS Anda -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <style>
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1000; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
        }

        .modal-content {
            background-color: #f2f2f2;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border-radius: 10px;
            width: 30%; /* Could be more or less, depending on screen size */
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            animation-name: animatetop;
            animation-duration: 0.4s
        }

        .close-button {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close-button:hover,
        .close-button:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        @keyframes animatetop {
            from {top: -300px; opacity: 0}
            to {top: 0; opacity: 1}
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
        </ul>
    </nav>
    <main>
        <div class="container-fluid p-5">
            <h3>You are looking to {{ $requestedId->name }}'s data!</h3>
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th scope="col" class="text-center col-1">Id</th>
                        <th scope="col" class="text-center col-3">Title</th>
                        <th scope="col" class="text-center col-3">Nama</th>
                        <th scope="col" class="text-center col-3">Waktu Pengisian</th>
                        <th scope="col" class="text-center col-3">Request</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($information as $info)
                    <tr>
                        <td class="px-3">{{ $info->id }}</td>
                        <td class="px-3">{{ $info->title }}</td>
                        <td class="px-3">{{ $info->nama }}</td>
                        <td class="px-3 text-center">{{ $info->created_at}}</td>
                        <td class="text-center py-3">
                            <form action="{{ route('request.storingrequest', ['userId' => $userId, 'requestedId' => $requestedId, 'informationId' => $info->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="info_id" value="{{ $info->id }}">
                                <button type="submit" class="lihat px-2 py-1" role="button">Request</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

    {{-- <!-- Modal HTML -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal()">&times;</span>
            <p>Request submitted successfully!</p>
        </div>
    </div> --}}

    <footer>
        &copy; 2023
    </footer>

    {{-- <script>
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission
                                
                // Show the modal
                document.getElementById('successModal').style.display = 'block';
            });
        });

        function closeModal() {
            document.getElementById('successModal').style.display = 'none';
        }
    </script> --}}
</body>
</html>