<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "db_showroom";

$conn = mysqli_connect($host, $user, $pass, $db);

if (mysqli_connect_errno()) {
    echo mysqli_connect_errno();
}
