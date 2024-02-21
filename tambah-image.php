<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true ){
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
                <form action="" method="POST" enctype="multipart/form-data" >
                    <?php
                        $result = mysqli_query($conn, "select * from tb_category");
                        $jsArray = "var prdName = new Array();\n";
                        echo '<select name="kategori" onchange="document.getElementById(\'prd_name\').value = prdName[this.value]" class="input-control" required>
                            <option>-pilih Kategori Foto-<option>';
                            while ($row = mysqli_fetch_array($result)){
                                echo '<option value="'. $row['category_id'] .'">'. $row['category_name'] .'</option>';
                                $jsArray .= "prdName['". $row['category_id'] ."'] = '". addslashes($row['category_name']) ."';\n";}echo '</select>';               
                    ?>
                    </select>
                    <input type="hidden" name="nama_kategori" id="prd_name" >
                    <input type="hidden" name="adminid" value="<?php echo $_SESSION['a_global']->admin_id ?>" >
                    <input type="text" name="namaadmin" class="input-control" value="<?php echo $_SESSION['a_global']->admin_name ?>" readonly="readonly" >
                    <input type="text" name="nama" class="input-control" placeholder="Nama Foto" required>
                    <textarea name="deskripsi" placeholder="Deskripsi" class="input-control"></textarea><br/>
                    <input type="file" name="gambar" class="input-control" required>
                    <select name="status" class="input-control">
                        <option value="">--pilih--</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                    <input type="submit" name="submit" value="submit" class="btn">
                </form>
                <?php
                if(isset($_POST['submit'])){

                    $kategori = $_POST['kategori'];
                    $nama_ka = $_POST['nama_kategori'];
                    $ida = $_POST['adminid'];
                    $user = $_POST['namaadmin'];
                    $nama = $_POST['nama'];
                    $deskripsi = $_POST['deskripsi'];
                    $status = $_POST['status'];

                    $filename = $_FILES['gambar']['name'];
                    $tmp_name = $_FILES['gambar']['tmp_name'];

                    $type1 = explode('.', $filename);
                    $type2 = $type1[1];

                    $newname = 'foto'.time().'.'.$type2;

                    $tipe_diizinkan = array('jpg','jpeg','png','gif');

                    if(!in_array($type2, $tipe_diizinkan)){
                        echo '<script>alert("Format foto tidak diizinkan")</script>';
                    }else{
                        move_uploaded_file($tmp_name, './foto/'.$newname);
                        $insert = mysqli_query($conn, "INSERT INTO tb_image VALUES (
                            null,
                            '".$kategori."',
                            '".$nama_ka."',
                            '".$ida."',
                            '".$user."',
                            '".$nama."',
                            '".$deskripsi."',
                            '".$newname."',
                            '".$status."',
                            null
                        )");
                        if($insert){
                            echo '<script>alert("Tambah Foto berhasil")</script>';
                            echo '<script>window.location="data-image.php"</script>';
                        }else{
                            echo 'gagal'.mysqli_error($conn);
                        }
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