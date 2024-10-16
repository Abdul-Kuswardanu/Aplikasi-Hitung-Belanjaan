<?php
session_start();
include 'db.php';
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mengambil data user berdasarkan username
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $db->query($query);
    $user = $result->fetchArray(SQLITE3_ASSOC);

    // Periksa apakah user ada dan apakah password yang dimasukkan sesuai
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;
        header('Location: main.php');
        exit();
    } else {
        $error_message = "Username atau Password salah!";
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

    <title>Login</title>
    <link rel="stylesheet" href="main.css">
    <style>
        /* Styles (bisa disesuaikan dengan main.css) */
        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 120px);
            text-align: center;
            padding: 1px;
        }

        .form-login {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }

        .form-login label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            text-align: left;
        }

        .form-login input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-login button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .form-login button:hover {
            background-color: #45a049;
        }

        .form-login a {
            display: inline-block;
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }

        .form-login a:hover {
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

        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <header>
            <div class="container">
                <h1><a href="main.php">HitungTotalBelanja</a></h1>
            </div>
        </header>
    </div>

    <div class="content">
        <div class="form-login">
            <form method="POST" action="login.php">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Username" required><br><br>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Password" required><br><br>

                <button type="submit">Login</button>

                <p>Belum punya akun? <a href="signup.php">Daftar Akun</a></p>
            </form>

            <?php
            if (isset($error_message)) {
                echo "<p class='error-message'>$error_message</p>";
            }
            ?>
            <a href="main.php" class="back-btn">Kembali ke Halaman Utama</a>
        </div>
    </div>
</body>
</html>
