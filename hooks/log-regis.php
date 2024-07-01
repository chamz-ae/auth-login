<?php
session_start(); // Mulai session

if (isset($_POST["register"])) {
    // Lakukan proses registrasi di sini

    // Setelah registrasi berhasil, misalnya Anda ingin mengatur session
    $_SESSION['registration_successful'] = true;

    // Redirect ke halaman lain atau tampilkan pesan sukses
    header("location: log-regis.php");
    exit; // Penting untuk menghentikan eksekusi kode setelah melakukan redirect
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Halaman Register</title>
</head>
<body>
    <h2>Register</h2>
    <form action="register.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="address">Alamat:</label>
        <input type="address" id="Alamat" name="alamat" required><br><br>

        <label for="telp">No Telp:</label>
        <input type="No" id="No Telp" name="telp" required><br><br>
        
        <input type="submit" name="register" value="Register">
    </form>
</body>
</html>
