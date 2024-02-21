<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true ){
        echo '<script>window.location="login.php"</script>';
    }
    $produk = mysqli_query($conn, "SELECT * FROM tb_image WHERE image_id = '".$_GET['id']."'");
    if(mysqli_num_rows($produk) == 0){
        echo '<script>window.location="data-image.php"</script>'; 
    }
    $p = mysqli_fetch_object($produk);
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
            <h3>Edit Data Foto</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data" >
                    <input type="text" name="kategori" placeholder="Kategori foto" class="input-control" value="<?php echo $p->category_name ?>" readonly="readonly" >
                    <input type="text" name="namauser" placeholder="Nama User" class="input-control" value="<?php echo $p->admin_name ?>" readonly="readonly" >
                    <input type="text" name="nama" placeholder="Nama foto" class="input-control" value="<?php echo $p->image_name ?>" required >

                    <img src="foto/<?php echo $p->image ?>" width="100px" alt="">
                    <input type="hidden" name="foto" value="<?php echo $p->image ?>" >
                    <input type="file" name="gambar" class="input-control">
                    <textarea name="deskripsi" placeholder="Deskripsi" class="input-control"><?php echo $p->image_description ?></textarea><br/>
                    <select name="status" class="input-control">
                        <option value="">--pilih--</option>
                        <option value="1" <?php echo ($p->image_status == 1)?'selected':''; ?>>Aktif</option>
                        <option value="0" <?php echo ($p->image_status == 0)?'selected':''; ?>>Tidak Aktif</option>
                    </select>
                    <input type="submit" name="submit" value="submit" class="btn">
                </form>
                <?php
                if(isset($_POST['submit'])){

                    $kategori = $_POST['kategori'];
                    $user = $_POST['namauser'];
                    $nama = $_POST['nama'];
                    $deskripsi = $_POST['deskripsi'];
                    $status = $_POST['status'];
                    $foto = $_POST['foto'];

                    $filename = $_FILES['gambar']['name'];
                    $tmp_name = $_FILES['gambar']['tmp_name'];

                    if($filename != ''){
                        $type1 = explode('.', $filename);
                        $type2 = $type1[1];

                        $newname = 'foto'.time().'.'.$type2;

                        $tipe_diizinkan = array('jpg','jpeg','png','gif');

                        if(!in_array($type2, $tipe_diizinkan)){
                            echo '<script>alert("Format foto tidak diizinkan")</script>';
                        }else{
                            unlink('./foto/'.$foto);
                            move_uploaded_file($tmp_name, './foto/'.$newname);
                            $namagambar = $newname;
                        }
                    }else{
                        $namagambar = $foto;
                    }
                        $update = mysqli_query($conn, "UPDATE tb_image SET 
                            category_name = '".$kategori."',
                            admin_name = '".$user."',
                            image_name = '".$nama."',
                            image_description = '".$deskripsi."',
                            image = '".$namagambar."',
                            image_status = '".$status."'
                            WHERE image_id = '".$p->image_id."'
                        ");
                        if($update){
                            echo '<script>alert("Ubah Data Foto berhasil")</script>';
                            echo '<script>window.location="data-image.php"</script>';
                        }else{
                            echo 'gagal'.mysqli_error($conn);
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
    <script>
        CKEDITOR.replace('deskripsi');
    </script>
    <script><?php echo $jsArray; ?></script>
</body>
</html>