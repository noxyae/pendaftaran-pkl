<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $birthdate = $_POST['birthdate'];

    // Koneksi ke database
    $conn = new mysqli('localhost', 'root', '', 'user_management'); // Pastikan database ini ada

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Memeriksa apakah email sudah ada
    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Email sudah terdaftar
        echo "Email sudah terdaftar! Silakan gunakan email lain.";
    } else {
        // Menyimpan data pengguna
        $stmt->close(); // Tutup statement sebelumnya

        $stmt = $conn->prepare("INSERT INTO users (email, password, fullname, phone, birthdate) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $email, $password, $fullname, $phone, $birthdate);

        if ($stmt->execute()) {
            // Redirect ke halaman login setelah berhasil mendaftar
            header("Location: index.php"); // Arahkan ke halaman login
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
}
?>