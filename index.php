<?php
session_start();
require "inc/koneksi.php";

$result = mysqli_query($conn, "SELECT * FROM motor JOIN transmisi ON motor.id_transmisi = transmisi.id_transmisi");
while ($row = mysqli_fetch_assoc($result)) {
  $bikes[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home</title>
  <link rel="stylesheet" href="style/all.css">
  <link rel="stylesheet" href="style/style.css" />
</head>

<body>
  <?php include "inc/navbar.php" ?>

  <section>
    <div class="hero">
      <img src="img/hero.jpeg" alt="">
      <div class="hero-title">
        <h1 id="hero-title">Showroom Motor</h1>
      </div>
    </div>
    <div class="cont-card">
      <?php foreach ($bikes as $bike) : ?>
        <div class="card">
          <div class="content">
            <div class="card-img">
              <img src="img/data/<?= $bike["gambar"] ?>" alt="" />
            </div>
            <h4 id="card-title"><?= $bike["nama_motor"] ?></h4>
            <p>
            <ul>
              <li>Kapasitas Tangki : <?= $bike["tangki"] ?> L</li>
              <li>Berat Motor : <?= $bike["berat"] ?> Kg</li>
              <li>Transmisi : <?= $bike["nama_transmisi"] ?></li>
            </ul>
            </p>
            <br>
            <label class="harga" for="">Rp. <?= $bike["harga"] ?></label>
            <?php if ($_SESSION["type"] == "admin") : ?>
              <div class="btn-aksi">
                <a class="btn" href="ubah.php?id=<?= $bike["id_motor"] ?>">Ubah</a>
                <a class="btn" href="hapus.php?id=<?= $bike["id_motor"] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data <?= $bike['nama_motor'] ?>')">Hapus</a>
              </div>
            <?php endif ?>
          </div>
        </div>
      <?php endforeach ?>
    </div>
    <?php include "inc/toggleButton.php" ?>
  </section>


  <?php include "inc/footer.php" ?>
  <script src="js/script-index.js"></script>
</body>

</html>