<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location:login.php");
    exit;
}
if ($_SESSION["type"] != "admin") {
    header("Location:index.php");
    exit;
}
require "inc/koneksi.php";
$id = $_GET["id"];

$query = "DELETE FROM motor WHERE id_motor = $id";
$result = mysqli_query($conn, $query);

if ($result) {
    echo "
    <script>
    alert('Berhasil Menghapus Data!');
    document.location.href='index.php';
    </script>";
}
