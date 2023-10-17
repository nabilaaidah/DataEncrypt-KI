document.getElementById("registrationForm").addEventListener("submit", function(event){
    // Mengambil nilai input dari formulir
    const fullname = document.getElementById("fullname").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    console.log("Panjang password:", password.length);
    console.log("Memiliki angka:", /\d/.test(password));
    console.log("Memiliki huruf:", /[a-zA-Z]/.test(password));

// Validasi password (minimal 8 karakter, harus mengandung huruf dan angka)
if (password.length < 8 || !/\d/.test(password) || !/[a-zA-Z]/.test(password)) {
    alert("Password harus terdiri dari minimal 8 karakter dan mengandung setidaknya satu huruf dan satu angka.");
    event.preventDefault();
    return;
}

    // Validasi email menggunakan regular expression
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Masukkan alamat email yang valid.");
        event.preventDefault();
        return;
    }

    // Validasi password (minimal 8 karakter, harus mengandung huruf dan angka)
    if (password.length < 8 || !/\d/.test(password) || !/[a-zA-Z]/.test(password)) {
        alert("Password harus terdiri dari minimal 8 karakter dan mengandung setidaknya satu huruf dan satu angka.");
        event.preventDefault();
        return;
    }
    // Jika semua validasi berhasil, formulir akan dikirimkan
});