<?php
session_start(); 

if (!isset($_SESSION['username'])) {
    header("Location: index.php"); 
    exit;
}

$username = $_SESSION['username'];
$update_success = false;
$fullname = '';
$phone = '';
$birthdate = '';

// Koneksi ke database
$conn = new mysqli('localhost', 'username', 'password', 'user_management');

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data pengguna
$stmt = $conn->prepare("SELECT fullname, phone, birthdate FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($fullname, $phone, $birthdate);
$stmt->fetch();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = htmlspecialchars(trim($_POST['fullname']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $birthdate = htmlspecialchars(trim($_POST['birthdate']));

    // Memperbarui data pengguna
    $stmt = $conn->prepare("UPDATE users SET fullname = ?, phone = ?, birthdate = ? WHERE username = ?");
    $stmt->bind_param("ssss", $fullname, $phone, $birthdate, $username);

    if ($stmt->execute()) {
        $update_success = true; 
    } else {
        $update_success = false; // Could not save changes
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profil Pengguna</title>
    <link rel="stylesheet" href="profil.css">
</head>
<body>
    <header>
        <h1>Perbarui Profil</h1>
    </header>
    <main>
        <section>
            <h2>Selamat datang, <?php echo htmlspecialchars($username); ?>!</h2>

            <?php if ($update_success): ?>
                <p style="color:green;">Profil berhasil diperbarui!</p>
            <?php else: ?>
                <p style="color:red;">Terjadi kesalahan saat memperbarui profil.</p>
            <?php endif; ?>
            <form method="POST" action="">
                <label for="fullname">Nama Lengkap:</label>
                <input type="text" name="fullname" placeholder="Masukkan nama lengkap" value="<?php echo htmlspecialchars($fullname); ?>" required>
                <label for="phone">Nomor Telepon:</label>
                <input type="tel" name="phone" placeholder="Masukkan nomor telepon" value="<?php echo htmlspecialchars($phone); ?>" required>
                <label for="birthdate">Tanggal Lahir:</label>
                <input type="date" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>" required>
                <input type="submit" value="Simpan Perubahan">
                <button onclick="location.href='login.php'">Logout</button>
            </form>
        </section>
    </main>
</body>
</html>