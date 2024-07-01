<?php
session_start();

// Mengambil data dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // print_r($_POST); die;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];

    // Melakukan validasi data (contoh: minimal panjang username dan password)
    if (strlen($username) < 2 || strlen($password) < 4) {
        echo "Username harus minimal 2 karakter dan password minimal 4 karakter.";
        exit;
    }

    // Melakukan koneksi ke database
    $host = "localhost"; // ganti dengan host database Anda
    $dbusername = "root"; // ganti dengan username database Anda
    $dbpassword = ""; // ganti dengan password database Anda
    $dbname = "login_up"; // ganti dengan nama database yang ingin Anda gunakan

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Membuat tabel user jika belum ada
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(50) NOT NULL,
        alamat VARCHAR(250) NOT NULL,
        telp VARCHAR(50) NOT NULL
    )";

    if ($conn->query($sql) === false) {
        echo "Error creating table: " . $conn->error;
        exit;
    }

    // Menyimpan data ke database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password, email, alamat, telp) VALUES ('$username', '$hashedPassword', '$email', '$alamat', '$telp')";

    if ($conn->query($sql) === true) {
        // Registrasi berhasil, atur session
        $_SESSION['registration_successful'] = true;
        echo "Registrasi berhasil!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="ClassName mt-20">
      <a class="p-5 bg-blue-400 mtrounded-lg" href="index.php">HOME</a>
    </div>
</body>
</html>
    