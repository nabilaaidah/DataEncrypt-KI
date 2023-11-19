<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}"> <!-- Gantilah "styles.css" dengan nama file CSS Anda -->
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
        <form action="{{ route('information.store', ['userId' => $userId]) }}" method="POST" id="personalDataForm" enctype="multipart/form-data">
            @csrf
            <section class="personal-data">
                <h2>Isikan Data Pribadi Anda</h2>
                    <div class="form-row">
                        <label for="title">Judul:</label>
                        <input type="text" id="title" name="title" required>
                    </div>
                    <div class="form-row">
                        <label for="name">Nama:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-row">
                        <label for="nik">Nomor Induk Kependudukan (NIK):</label>
                        <input type="text" id="nik" name="nik" required>
                    </div>
                    <div class="form-row">
                        <label for="dob">Tanggal Lahir:</label>
                        <input type="date" id="dob" name="dob" required>
                    </div>
                    <div class="form-row">
                        <label for="gender">Jenis Kelamin:</label>
                        <select id="gender" name="gender" required>
                            <option value="male">Laki-laki</option>
                            <option value="female">Perempuan</option>
                            <option value="other">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <label for="email">Alamat Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-row">
                        <label for="phone">Nomor Telepon:</label>
                        <input type="text" id="phone" name="phone" required>
                    </div>
                    <div class="form-row">
                        <label for="address">Alamat:</label>
                        <textarea id="address" name="address" required></textarea>
                    </div>
                    <!-- Masukkan elemen-elemen lainnya yang terkait dengan data pribadi di sini -->
                <h2>Data Kesehatan dan Genetika</h2>
                    <div class="form-row">
                        <label for="geneticDisease">Punya Penyakit Bawaan? (Ya/Tidak):</label>
                        <input type="text" id="geneticDisease" name="geneticDisease" required>
                    </div>
                    <div class="form-row">
                        <label for="allergies">Alergi? (Ya/Tidak):</label>
                        <input type="text" id="allergies" name="allergies" required>
                    </div>
                    <div class="form-row">
                        <label for="medications">Obat-obatan yang Digunakan:</label>
                        <input type="text" id="medications" name="medications" required>
                    </div>
                    <div class "form-row">
                        <label for="bloodPressure">Tekanan Darah (mmHg):</label>
                        <input type="number" id="bloodPressure" name="bloodPressure" required>
                    </div>
                    <div class="form-row">
                        <label for="cholesterol">Kolesterol Total (mg/dL):</label>
                        <input type="number" id="cholesterol" name="cholesterol" required>
                    </div>
                    <div class="form-row">
                        <label for="medicalHistory">Riwayat Medis:</label>
                        <textarea id="medicalHistory" name="medicalHistory" required></textarea>
                    </div>
                    <!-- Masukkan elemen-elemen lainnya yang terkait dengan data kesehatan dan genetika di sini -->
                <h2>Data Etnis dan Orientasi Seksual</h2>
                    <div class="form-row">
                        <label for="ethnicity">Etnis dan Ras:</label>
                        <input type="text" id="ethnicity" name="ethnicity" required>
                    </div>
                    <div class="form-row">
                        <label for="sexualOrientation">Orientasi Seksual:</label>
                        <input type="text" id="sexualOrientation" name="sexualOrientation" required>
                    </div>
                    <div class="form-row">
                        <label for="religion">Agama yang Dianut:</label>
                        <input type="text" id="religion" name="religion" required>
                    </div>
                    <div class="form-row">
                        <label for="languages">Bahasa yang Dikuasai:</label>
                        <input type="text" id="languages" name="languages" required>
                    </div>
                    <div class="form-row">
                        <label for="nationality">Kewarganegaraan:</label>
                        <input type="text" id="nationality" name="nationality" required>
                    </div>
                    <div class="form-row">
                        <label for="politicalAffiliation">Afiliasi Politik:</label>
                        <input type="text" id="politicalAffiliation" name="politicalAffiliation" required>
                    </div>
                    <!-- Masukkan elemen-elemen lainnya yang terkait dengan data etnis dan orientasi seksual di sini -->
                <h2>Pemindaian Wajah (Video Verifikasi)</h2>
                    <div class="form-row">
                        <label for="biometricVideo">Pemindaian Wajah (Video Verifikasi):</label>
                        <input type="file" id="biometricVideo" name="biometricVideo" accept="video/*" required>
                    </div>
                    <div class="form-row">
                        <label for="biometricData">Data Biometrik Lainnya:</label>
                        <input type="text" id="biometricData" name="biometricData" required>
                    </div>
                    <div class="form-row">
                        <label for="eyeColor">Warna Mata:</label>
                        <input type="text" id="eyeColor" name="eyeColor" required>
                    </div>
                    <div class="form-row">
                        <label for="hairColor">Warna Rambut:</label>
                        <input type="text" id="hairColor" name="hairColor" required>
                    </div>
                    <!-- Masukkan elemen-elemen lainnya yang terkait dengan pemindaian wajah di sini -->
                <h2>Upload Kartu Keluarga (PDF)</h2>
                    <div class="form-row">
                        <label for="kkDocument">Pilih File Kartu Keluarga (PDF):</label>
                        <input type="file" id="kkDocument" name="kkDocument" accept=".pdf" required>
                    </div>
                <h2>Unggah Foto</h2>
                    <div class="form-row">
                        <label for="photo1">Foto (3x4):</label>
                        <input type="file" id="photo1" name="photo1" accept="image/*" required>
                    </div>
            </section>
            <button type="submit">Simpan Data</button>
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