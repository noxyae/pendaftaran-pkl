<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <link rel="stylesheet" href="register.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper">
        <div class="form-header">
            <div class="title">
                <div class="title-login">Register</div>
            </div>
        </div>  
        <form action="register_proses.php" method="POST">
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
                <input type="text" id="fullname" name="fullname" class="input-field" required>
                <label for="fullname" class="label">Nama Lengkap</label>
                <i class='bx bx-user icon'></i>
            </div>
            <div class="input-box">
                <input type="tel" id="phone" name="phone" class="input-field" required>
                <label for="phone" class="label">Nomor Telepon</label>
                <i class='bx bxs-phone icon'></i>
            </div>
            <div class="input-box">
                <input type="date" id="birthdate" name="birthdate" class="input-field" placeholder="" required>
                <label for="birthdate" class="label">Tanggal Lahir</label>
            </div>
            <div class="input-box">
                <button type="submit" class="btn-submit" id="Submit">Submit<i class='bx bx-log-in'></i></button>
            </div> 
        </form>
        <p>Sudah punya akun? <a href="index.php">Login di sini</a></p>
    </div>
</body>
</html>