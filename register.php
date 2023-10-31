<?php
require "inc/koneksi.php";
$errorAdmin = false;
$errorPass = false;
$errorUsername = false;
if (isset($_POST["submit"])) {
    $username = htmlspecialchars(strtolower($_POST["username"]));
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    if ($username === "admin") {
        $errorAdmin = true;
    } else if ($password != $cpassword) {
        $errorPass = true;
    } else if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$username'")) == 1) {
        $errorUsername = true;
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = mysqli_query($conn, "INSERT INTO pengguna VALUES (NULL, '$username', '$password')");
        if ($query) {
            echo "
            <script>
            alert('Berhasil register!');
            document.location.href='login.php';
            </script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style/login.css">
</head>

<body class="register">
    <div class="hero">
        <img src="img/login-logout.jpeg" alt="">
        <div class="hero-title">
            <h1>REGISTER</h1>
            <?php if ($errorAdmin == true) { ?>
                <p>Dilarang Menggunakan Username Admin!</p>
            <?php } else if ($errorPass == true) { ?>
                <p>Password dan Konfirmasi Password Anda Tidak Sesuai!</p>
            <?php } else if ($errorUsername == true) { ?>
                <p>Username Sudah Ada!</p>
            <?php } else { ?>
                <p style="background-color: none;
                            padding: 0px;
                            border-radius: 0;
                            box-shadow: 0px 0px;"></p>
            <?php } ?>
            <form action="" method="post">
                <div class="row">
                    <label for="username">Username</label>
                    <input type="text" placeholder="Huruf Kecil !" name="username" id="username" autofocus required>
                </div>
                <div class="row">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="row">
                    <label for="cpassword">Konfirmasi Password</label>
                    <input type="password" name="cpassword" id="cpassword" required>
                </div>
                <div class="row">
                    <button type="submit" name="submit">Register</button>
                </div>
            </form>
            <a href="login.php">Kembali</a>
        </div>
    </div>
</body>

</html>