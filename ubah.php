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

$query = "SELECT * FROM transmisi";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $transmissions[] = $row;
}

$stmt = "SELECT * FROM motor WHERE id_motor = $id";
$hasil = mysqli_query($conn, $stmt);
$bike = mysqli_fetch_assoc($hasil);

if (isset($_POST["submit"])) {
    $id = $_POST["id"];
    $nama = htmlspecialchars($_POST["nama"]);
    $bensin = htmlspecialchars($_POST["bensin"]);
    $berat = $_POST["berat"];
    $transmisi = $_POST["transmisi"];
    $harga = $_POST["harga"];
    if ($_FILES["gambar"]["name"] != "") {
        $gambar = $_FILES["gambar"]["name"];
        $tmpName = $_FILES["gambar"]["tmp_name"];
        $ekstensigmbr = explode(".", $gambar);
        $ekstensigmbr = strtolower(end($ekstensigmbr));
        $nm_gambar = date('Y-m-d');
        $nm_gambar .= ".";
        $nm_gambar .= strtolower($nama) . "-file";
        $nm_gambar .= ".";
        $nm_gambar .= $ekstensigmbr;
        // menyimpan gambar yang diupload pada folder img/data/
        move_uploaded_file($tmpName, 'img/data/' . $nm_gambar);

        $query = "UPDATE motor SET nama_motor = '$nama', tangki = $bensin, berat = $berat, id_transmisi = $transmisi, harga = $harga, gambar = '$nm_gambar' WHERE id_motor = $id";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "
            <script>
            alert('Berhasil mengubah data motor!');
            document.location.href='index.php';
            </script>";
        }
    } else {
        $query = "UPDATE motor SET nama_motor = '$nama', tangki = $bensin, berat = $berat, id_transmisi = $transmisi, harga = $harga WHERE id_motor = $id";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "
            <script>
            alert('Berhasil mengubah data motor!');
            document.location.href='index.php';
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
    <title>Tambah Data</title>
    <link rel="stylesheet" href="style/all.css">
    <link rel="stylesheet" href="style/style-input.css">
</head>

<body>
    <?php include "inc/navbar.php" ?>

    <div class="container">
        <table>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $id ?>">
                <tr>
                    <td>
                        <label for="nama">Masukkan Nama Motor</label>
                    </td>
                    <td colspan="2">
                        <input class="ketik" value="<?= $bike["nama_motor"] ?>" type="text" name="nama" id="nama" autofocus required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="bensin">Masukkan Kapasitas Tangki Motor</label>
                    </td>
                    <td colspan="2">
                        <input class="ketik" type="text" value="<?= $bike["tangki"] ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46" name="bensin" id="bensin" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="berat">Masukkan Berat Motor</label>
                    </td>
                    <td colspan="2">
                        <input class="ketik" type="number" value="<?= $bike["berat"] ?>" name="berat" id="berat" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="transmisi">Pilih Transmisi Motor</label>
                    </td>
                    <td colspan="2">
                        <select name="transmisi" id="transmisi">
                            <?php foreach ($transmissions as $transmisi) : ?>
                                <option value="<?= $transmisi["id_transmisi"] ?>" <?php if ($transmisi["id_transmisi"] == $bike["id_transmisi"]) : ?> selected <?php endif ?>><?= $transmisi["nama_transmisi"] ?></option>
                            <?php endforeach ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="harga">Masukkan Harga Motor</label></td>
                    <td><input type="number" value="<?= $bike["harga"] ?>" name="harga" id="harga"></td>
                </tr>
                <tr>
                    <td><label for="gambar">Masukkan Foto Motor</label></td>
                    <td><input type="file" name="gambar" id="gambar" accept="image/*"></td>
                </tr>
                <tr>
                    <td class="akhir" align="right" colspan="4">
                        <div class="for-btn">
                            <button type="submit" name="submit">Submit</button>
                        </div>
                    </td>
                </tr>
            </form>
        </table>
    </div>

    <?php include "inc/toggleButton.php" ?>

    <?php include "inc/footer.php" ?>
    <script src="js/script-add.js"></script>
    <script src="js/script-index.js"></script>
</body>

</html>