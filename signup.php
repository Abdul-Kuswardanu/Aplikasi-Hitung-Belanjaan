<?php
session_start();
include 'db.php';
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validasi input
    if (preg_match('/^[a-zA-Z\s]+$/', $nama) && 
        preg_match('/^[a-zA-Z0-9]+$/', $username) && 
        filter_var($email, FILTER_VALIDATE_EMAIL) && 
        preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,16}$/', $password)) {

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Simpan data pendaftaran di tabel signup
        $query_signup = "INSERT INTO signup (nama, username, email, password) VALUES ('$nama', '$username', '$email', '$hashed_password')";
        if ($db->exec($query_signup)) {
            // Pindahkan data ke tabel users
            $query_move_to_users = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
            $db->exec($query_move_to_users);

            // Hapus data dari tabel signup setelah berhasil dipindahkan
            $query_delete_signup = "DELETE FROM signup WHERE username = '$username'";
            $db->exec($query_delete_signup);

            // Tampilkan notifikasi
            echo "<script>alert('Akun berhasil dibuat!'); window.location.href = 'login.php';</script>";
            exit();
        } else {
            $error_message = "Gagal membuat akun: " . $db->lastErrorMsg();
        }
    } else {
        $error_message = "Nama, Username, Email, atau Password ada Kesalahan. 
                        <br> Mohon untuk Password sudah Huruf Besar, Huruf kecil, 
                        <br> Angka, dan Simbol ya ! 
                        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="no-cache" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="expires" content="0">
    <meta http-equiv="pragma" content="no-cache">

    <title>Daftar Akun</title>
    <link rel="stylesheet" href="main.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .dashboard {
            background-color: rgb(15, 165, 173);
            color: white;
            padding: 20px;
        }
        .dashboard h1 {
            margin: 0;
        }
        .content {
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            max-width: 800px;
            box-sizing: border-box;
        }
        .form-signup {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }
        label {
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }
        input[type="text"], input[type="password"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        button {
            padding: 10px 20px;
            background-color: rgb(15, 165, 173);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #128b8e;
        }
        .form-signup a {
            color: rgb(15, 165, 173);
            text-decoration: none;
            font-weight: bold;
        }
        .form-signup a:hover {
            text-decoration: underline;
        }
        .back-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #ddd;
            color: #333;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
        }
        .back-btn:hover {
            background-color: #bbb;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <header>
            <h1>Daftar Akun</h1>
        </header>
    </div>

    <div class="content">
        <form class="form-signup" method="POST" action="signup.php">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Daftar</button>
        </form>

        <a href="login.php" class="back-btn">Kembali ke Login</a>

        <?php
        if (isset($error_message)) {
            echo "<p style='color: red;'>$error_message</p>";
        }
        ?>
    </div>
</body>
</html>
