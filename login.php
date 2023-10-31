<?php
session_start();
require "inc/koneksi.php";
if (isset($_SESSION["login"])) {
    header("Location:index.php");
    exit;
}
$errorPass = false;
$errorUsername = false;
if (isset($_POST["submit"])) {
    $username = htmlspecialchars(strtolower($_POST["username"]));
    $password = $_POST["password"];

    $query = mysqli_query($conn, "SELECT * FROM pengguna WHERE `username` = '$username'");
    if (mysqli_num_rows($query) == 1) {
        $row = mysqli_fetch_assoc($query);
        if ($row["username"] == "admin") {
            if (password_verify($password, $row["password"])) {
                $nama = strtoupper($row["username"]);
                $_SESSION["login"] = true;
                $_SESSION["type"] = "admin";
                echo "
                <script>
                alert('Hai, Selamat Datang $nama !');
                document.location.href='index.php';
                </script>";
            } else {
                $errorPass = true;
            }
        } else {
            if (password_verify($password, $row["password"])) {
                $nama = strtoupper($row["username"]);
                $_SESSION["login"] = true;
                $_SESSION["type"] = "user";
                echo "
                <script>
                alert('Hai, Selamat Datang $nama !');
                document.location.href='index.php';
                </script>";
            } else {
                $errorPass = true;
            }
        }
    } else {
        $errorUsername = true;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style/login.css">
</head>

<body class="login">
    <div class="hero">
        <img src="img/login-logout.jpeg" alt="">
        <div class="hero-title">
            <h1>LOGIN</h1>
            <?php if ($errorPass == true) { ?>
                <p class="error">Password Anda Salah!</p>
            <?php } else if ($errorUsername == true) { ?>
                <p class="error">Username Anda Salah!</p>
            <?php } else { ?>
                <p style="background-color: none;
                            padding: 0px;
                            border-radius: 0;
                            box-shadow: 0px 0px;"></p>
            <?php } ?>
            <form action="" method="post">
                <div class="row">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autofocus required>
                </div>
                <div class="row">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="row">
                    <button type="submit" name="submit">Login</button>
                </div>
            </form>
            <p class="new">Belum Punya Akun? <a href="register.php">Klik Disini</a></p>
        </div>
    </div>
</body>

</html>