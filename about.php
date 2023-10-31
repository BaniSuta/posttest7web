<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Me</title>
  <link rel="stylesheet" href="style/all.css">
  <link rel="stylesheet" href="style/style-about.css" />
</head>

<body>
  <?php include "inc/navbar.php" ?>

  <section>
    <div class="head-sec">
      <h2 id="title-about">About Me</h2>
    </div>
    <div class="body-sec">
      <div class="cont-img-sec">
        <img id="foto" src="img/1694395287638.jpg" alt="" />
      </div>
      <div class="isi-cont">
        <ul>
          <li>Nama : Achmad Nur Bani Suta</li>
          <li>NIM : 2209106016</li>
          <li>Kelas : Informatika A 2022</li>
          <li>TTL: Samarinda, 01 Juli 2004</li>
          <li>Email : banisuta66@gmail.com</li>
        </ul>
      </div>
    </div>
    <?php include "inc/toggleButton.php" ?>
  </section>

  <?php include "inc/footer.php" ?>
  <script src="js/script-about.js"></script>
</body>

</html>