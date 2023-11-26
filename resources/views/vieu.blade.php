<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/view.css') }}"> <!-- Gantilah "form.css" dengan nama file CSS Anda -->
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
        @if ($latestInfo) 
        <section class="personal-data">
            <h2>Data Pribadi Anda</h2>
            <div class="data-row">
                <label for="name">Judul:</label>
                <p>{{ $latestInfo->title }}</p>
            </div>
            <div class="data-row">
                <label for="name">Nama:</label>
                <p>{{ $latestInfo->nama }}</p>
            </div>
            <div class="data-row">
                <label for="nik">Nomor Induk Kependudukan (NIK):</label>
                <p>{{ $latestInfo->NIK }}</p>
            </div>
            <div class="data-row">
                <label for="dob">Tanggal Lahir:</label>
                <p>{{ $latestInfo->dob }}</p>
            </div>
            <div class="data-row">
                <label for="gender">Jenis Kelamin:</label>
                <p>{{ $latestInfo->gender }}</p>
            </div>
            <div class="data-row">
                <label for="email">Alamat Email:</label>
                <p>{{ $latestInfo->email }}</p>
            </div>
            <div class="data-row">
                <label for="phone">Nomor Telepon:</label>
                <p>{{ $latestInfo->phone }}</p>
            </div>
            <div class="data-row">
                <label for="address">Alamat:</label>
                <p>{{ $latestInfo->address }}</p>
            </div>
            <!-- Masukkan data-data pribadi lainnya di sini -->
        </section>

        <section class="health-genetics">
            <h2>Data Kesehatan dan Genetika</h2>
            <div class="data-row">
                <label for="geneticDisease">Punya Penyakit Bawaan? (Ya/Tidak):</label>
                <p>{{ $latestInfo->geneticDisease }}</p>
            </div>
            <div class="data-row">
                <label for="allergies">Alergi? (Ya/Tidak):</label>
                <p>{{ $latestInfo->allergies }}</p>
            </div>
            <div class="data-row">
                <label for="medications">Obat-obatan yang Digunakan:</label>
                <p>{{ $latestInfo->medications }}</p>
            </div>
            <div class="data-row">
                <label for="bloodPressure">Tekanan Darah (mmHg):</label>
                <p>{{ $latestInfo->bloodPressure }}</p>
            </div>
            <div class="data-row">
                <label for="cholesterol">Kolesterol Total (mg/dL):</label>
                <p>{{ $latestInfo->cholesterol }}</p>
            </div>
            <div class="data-row">
                <label for="medicalHistory">Riwayat Medis:</label>
                <p>{{ $latestInfo->medicalHistory }}</p>
            </div>
            <!-- Masukkan data-data kesehatan dan genetika lainnya di sini -->
        </section>

        <section class="ethnicity-sexuality">
            <h2>Data Etnis dan Orientasi Seksual</h2>
            <div class="data-row">
                <label for="ethnicity">Etnis dan Ras:</label>
                <p>{{ $latestInfo->ethicity }}</p>
            </div>
            <div class="data-row">
                <label for="sexualOrientation">Orientasi Seksual:</label>
                <p>{{ $latestInfo->sexualOrientation }}</p>
            </div>
            <div class="data-row">
                <label for="religion">Agama yang Dianut:</label>
                <p>{{ $latestInfo->religion }}</p>
            </div>
            <div class="data-row">
                <label for="languages">Bahasa yang Dikuasai:</label>
                <p>{{ $latestInfo->languages }}</p>
            </div>
            <div class="data-row">
                <label for="nationality">Kewarganegaraan:</label>
                <p>{{ $latestInfo->nationality }}</p>
            </div>
            <div class="data-row">
                <label for="politicalAffiliation">Afiliasi Politik:</label>
                <p>{{ $latestInfo->politicalAffiliation }}</p>
            </div>
            <!-- Masukkan data-data etnis dan orientasi seksual lainnya di sini -->
        </section>

        <section class="biometric">
            <h2>Pemindaian Wajah (Video Verifikasi)</h2>
            <div class="data-row">
                <label for="biometricVideo">Pemindaian Wajah (Video Verifikasi):</label>
                <br>
                <p>
                    <video controls width="400" height="300">
                        <source src="{{ asset(str_replace('public', 'storage', $latestInfo->biometricVideo)) }}" type="video/mp4">
                    </video>
                </p>
            </div>
            <div class="data-row">
                <label for="biometricData">Data Biometrik Lainnya:</label>
                <p>{{ $latestInfo->biometricData }}a</p>
            </div>
            <div class="data-row">
                <label for="eyeColor">Warna Mata:</label>
                <p>{{ $latestInfo->eyeColor }}</p>
            </div>
            <div class="data-row">
                <label for="hairColor">Warna Rambut:</label>
                <p>{{ $latestInfo->hairColor }}</p>
            </div>
            <!-- Masukkan data-data pemindaian wajah lainnya di sini -->
        </section>

        <section class="kk-upload">
            <h2>Upload Kartu Keluarga (PDF)</h2>
            <div class="data-row">
                <label for="kkDocument">File Kartu Keluarga (PDF):</label>
                <br>
                <br>
                @if ($latestInfo->kkDocument)
                    <embed src="{{ asset(str_replace('public', 'storage', $latestInfo->kkDocument)) }}" type="application/pdf" width="400" height="300">
                @else
                    <p>Tidak ada file yang diunggah</p>
                @endif
            </div>
        </section>

        <section class="photo-upload">
            <h2>Unggah Foto</h2>
            <div class="data-row">
                <label for="photo1">Foto (3x4):</label>
                <br>
                <br>
                @if ($latestInfo->photo1)
                    <img src="{{ asset(str_replace('public', 'storage', $latestInfo->photo1)) }}" alt="Your PDF" width="400" height="300">
                @else
                    <p>Tidak ada foto yang diunggah</p>
                @endif
            </div>
        </section>
        @else
            <p> No data showed </p>
        @endif
    </main>

    <footer>
        &copy; 2023
    </footer>
</body>
</html>