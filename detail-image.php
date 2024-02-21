<?php
error_reporting(0);
include 'db.php';
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 2");
$a = mysqli_fetch_object($kontak);

$produk = mysqli_query($conn, "SELECT * FROM tb_image WHERE image_id = '" . $_GET['id'] . "'");
$p = mysqli_fetch_object($produk);
$komentar = mysqli_query($conn, "SELECT * FROM tb_comen WHERE id_komen");
$k = mysqli_fetch_object($produk);
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
                <li><a href="galeri.php">Galeri</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </div>
    </header>

    <!-- search -->
    <div class="search">
        <div class="container">
            <form action="galeri.php">
                <input type="text" name="serach" placeholder="Cari Foto" value="<?php echo $_GET['search'] ?>">
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
                <input type="submit" name="cari" value="Cari Foto">
            </form>
        </div>
    </div>

    <!-- produk detail -->
    <div class="section">
        <div class="container">
            <h3>Detail Foto</h3>
            <div class="box">
                <div class="col-2">
                    <img src="foto/<?php echo $p->image_varchar ?>" width="100%" alt="">
                </div>
                <div class="col-2">
                    <h3><?php echo $p->image_name ?><br />Kategori : <?php echo $p->category_name ?></h3>
                    <h4>Nama User : <?php echo $p->admin_name ?><br />Upload pada tanggal : <?php echo $p->date_created ?></h4>
                    <p>Deskripsi : <br /><?php echo $p->image_description ?></p>
                    <p>komentar : <br /><?php echo $k->komentar ?></p>

                </div>



                <form action="proses-komen.php" method="POST" enctype="multipart/form-data">

                    <input type="text" name="nama_komen" class="input-control" placeholder="Nama" required>
                    <textarea name="komentar" placeholder="Komentar" class="input-control"></textarea><br />
                    <input type="hidden" name="id_admin" class="input-control" value="<?php echo $p->image_id ?>placeholder=" Nama Foto" required>

                    <input type="submit" name="submit" value="submit komentar" class="btn">
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>

    <!-- footer -->
    <div class="container">
        <small>Copyright &copy; 2024 - Web Galeri Foto</small>
    </div>
</body>

</html>