<?php
session_start(); // Memulai session

if (isset($_POST["submit"])) {
  // koneksi ke database
  $conn = mysqli_connect("localhost", "root", "", "login_up");

  // cek tombol submitnya bree
  if ($conn) {
    // ambil data dari form
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // query ke database
    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // cek username dan password
    if (mysqli_num_rows($result) > 0) {
      // ambil password dari database
      $row = mysqli_fetch_assoc($result);
      $passwordDB = $row["password"];

      // cek password
      if (password_verify($password, $passwordDB)) {
        // nek bener, lanjut halaman
        $_SESSION['username'] = $username; // Set session untuk pengguna yang login
        header("location: admin.php");
        exit;
      } else {
        // nek salah, tampilkan salah
        $error = "Username atau password salah";
      }
    } else {
      // nek salah, tampilkan salah
      $error = "Username atau password salah";
    }
  } else {
    echo "Koneksi ke database gagal";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Login Page</title>
</head>
<style>
  @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

  .Poppins {
    font-family: "Poppins", sans-serif;
  }
</style>

<body>
  <main class="Poppins bg-blue-400 mt-20 p-10 rounded-3xl text-center mx-auto max-w-[500px]">
    <div class="ClassName">
      <div class="ClassName">
        <img src="../PHP-Login/src/assets/games.jpeg" class="w-14 mx-auto rounded-full" alt="" />
      </div>
      <h1 class="mt-5 text-3xl tracking-tighter font-semibold">Login admin</h1>
      <div class="ClassName"></div>
    </div>
    <?php if (isset($error)) : ?>
      <p style="color: red; font-style: italic">
        username / password lu salah pea!
      </p>
    <?php endif; ?>
    <ul class="mt-6">
      <form action="" method="POST">
        <li class="ClassLabel grid">
          <label for="username font-semibold">Username </label>
          <input class="p-2 mt-3 text-sm rounded-lg" type="text" name="username" placeholder="Username" id="username" />
        </li>
        <li class="ClassLabel mt-6 grid">
          <label for="password font-semibold">Password </label>
          <input class="p-2 mt-3 text-sm rounded-lg" type="password" name="password" placeholder="Password" id="password" />
        </li>
        <li class="mt-12 bg-gray-200 w-32 p-2 hover:scale-95 duration-200 rounded-full mx-auto">
          <button class="font-semibold" type="submit" name="submit">
            Login
          </button>
        </li>
      </form>
      <form action="log-regis.php" method="POST">
        <li class="mt-7 bg-gray-200 w-32 p-2 hover:scale-95 duration-200 rounded-full mx-auto">
          <button class="font-semibold" type="submit" name="register">
            Register
          </button>
        </li>
      </form>
      <form action="forgot_password.php" method="POST">
        <li class="mt-7 bg-gray-200 w-32 p-2 hover:scale-95 duration-200 rounded-full mx-auto">
          <button class="font-semibold" type="submit" name="Forgot Password">
            Forgot Password
          </button>
        </li>
      </form>
    </ul>
  </main>
</body>

</html>
