<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $email = $data['email'];

    // Koneksi ke database
    $conn = new mysqli('localhost', 'root', '', 'user_management');

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Memeriksa apakah email sudah terdaftar
    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    $response = array('exists' => $stmt->num_rows > 0);
    echo json_encode($response);

    $stmt->close();
    $conn->close();
}
?>