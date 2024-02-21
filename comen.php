<?php
session_start();
include 'db.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WEB Galeri Foto</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="index.php">WEB GALERI FOTO</a></h1>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="data-image.php">Data Foto</a></li>
                <li><a href="keluar.php">Keluar</a></li>
            </ul>
        </div>
    </header>

    <!-- conten -->
    <div class="section">
        <div class="container">
            <h3>Tambah Foto</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">

                    <input type="text" name="nama_komen" class="input-control" placeholder="Nama Foto" required>
                    <textarea name="komentar" placeholder="Deskripsi" class="input-control"></textarea><br />

                    <input type="submit" name="submit" value="submit" class="btn">
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    $nama_komen = $_POST['nama_komen'];
                    $komentar = $_POST['komentar'];
                    $id_admin = $_POST['id_admin'];



                    $insert = mysqli_query($conn, "INSERT INTO tb_comen VALUES (
                            null,
                            '" . $nama_komen . "',
                            '" . $komentar . "',
                            '" . $id_admin . "'
                        )");
                    if ($insert) {
                        echo '<script>alert("Tambah komen berhasil")</script>';
                        echo '<script>window.location="comen.php"</script>';
                    } else {
                        echo 'gagal' . mysqli_error($conn);
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <!-- footer -->
    <div class="container">
        <small>Copyright &copy; 2024 - Web Galeri Foto</small>
    </div>

</body>

</html>