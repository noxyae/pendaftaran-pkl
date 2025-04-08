<?php
session_start(); // Mulai sesi untuk menyimpan status login

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Koneksi ke database
    $conn = new mysqli('localhost', 'root', '', 'user_management'); // Pastikan database ini ada

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Memeriksa email dan password
    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        // Menyimpan status login ke dalam sesi
        $_SESSION['email'] = $email;
        header("Location: profile.php"); // Redirect ke halaman profil
        exit;
    } else {
        $error = "Email atau password salah!";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper">
        <div class="form-header">
            <div class="title">
                <div class="title-login">Login</div>
            </div>
        </div>  
        <form action="" method="POST" id="LoginForm">
            <div class="input-box">
                <input type="email" id="email" name="email" class="input-field" required>
                <label for="email" class="label">Email</label>
                <i class='bx bxs-envelope icon'></i>
            </div>
            <div class="input-box">
                <input type="password" id="password" name="password" class="input-field" required>
                <label for="password" class="label">Password</label>
                <i class='bx bx-lock-alt icon'></i>
            </div>
            <div class="input-box">
                <button type="submit" class="btn-submit" id="SignIn">Sign In <i class='bx bx-log-in'></i></button>
            </div> 
        </form>
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
        <div id="notification" class="notification"></div> <!-- Notifikasi pop-up -->
    </div>

    <script src="script.js"></script>
</body>
</html>