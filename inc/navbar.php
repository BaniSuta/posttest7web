<?php
date_default_timezone_set('Asia/Makassar');
if (!isset($_SESSION["login"])) {
    $_SESSION["login"] = false;
    $_SESSION["type"] = "user";
}
?>
<header id="head">
    <div class="cont-header">
        <div class="header-img">
            <img src="img/wan hart.png" alt="Wan Hart" />
            <img src="img/right.png" alt="">
        </div>
        <div class="navbar">
            <div class="list">
                <p>| <a id="nav-list" onclick="return confirm('Apakah Anda Yakin Ingin Berpindah Halaman?')" href="index.php">Home</a> | <a id="nav-list" onclick="return confirm('Apakah Anda Yakin Ingin Berpindah Halaman?')" href="about.php">About</a> |
                    <?php if ($_SESSION["type"] == "admin") : ?>
                        <a id="nav-list" onclick="return confirm('Apakah Anda Yakin Ingin Berpindah Halaman?')" href="add.php">Input Data</a> |
                    <?php endif ?>
                </p>
            </div>
            <div class="tanggal">
                <p>Current Date : <?= date('l, d-m-Y') ?></p>
                <p>Timezone : <?= date_default_timezone_get() ?></p>
            </div>
            <div class="button">
                <?php if ($_SESSION["login"] == true) { ?>
                    <a href="logout.php" class="btn">Logout</a>
                <?php } else { ?>
                    <a href="login.php" class="btn">Login</a>
                <?php } ?>
            </div>
        </div>
    </div>
</header>