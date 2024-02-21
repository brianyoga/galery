<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true ){
        echo '<script>window.location="login.php"</script>';
    }
    $query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id ='" . $_SESSION['id'] . "'");
    $d = mysqli_fetch_object($query);
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
            <h3>Profil</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Lengkap" value="<?php echo $d->admin_name ?>" class="input-control" required>
                    <input type="text" name="user" placeholder="Username" value="<?php echo $d->username ?>" class="input-control" required>
                    <input type="text" name="hp" placeholder="Nomer Hp" value="<?php echo $d->admin_telp ?>" class="input-control" required>
                    <input type="text" name="email" placeholder="Email" value="<?php echo $d->admin_email ?>" class="input-control" required>
                    <input type="text" name="alamat" placeholder="Alamat" value="<?php echo $d->admin_address ?>" class="input-control" required>
                    <input type="submit" name="submit" value="Ubah Profil" class="btn">
                </form>
                <?php
                    if(isset($_POST['submit'])){
                        $nama = $_POST['nama'];
                        $user = $_POST['user'];
                        $hp = $_POST['hp'];
                        $email = $_POST['email'];
                        $alamat = $_POST['alamat'];

                        $update = mysqli_query($conn, "UPDATE tb_admin SET 
                            admin_name = '".$nama."',
                            username = '".$user."',
                            admin_telp = '".$hp."',
                            admin_email = '".$email."',
                            admin_address = '".$alamat."'
                            WHERE admin_id = '".$d->admin_id."'
                        ");
                        if($update){
                            echo '<script>alert("Ubah Data berhasil")</script>';
                            echo '<script>window.location="profil.php"</script>';
                        }else{
                            echo 'gagal'.mysqli_error($conn);
                        }
                    }
                ?>
            </div>

            <h3>Ubah Password</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="password" name="pass1" placeholder="Password Baru" class="input-control" required>
                    <input type="password" name="pass2" placeholder="Konfirmasi" class="input-control" required>
                    <input type="submit" name="submit" value="Ubah Profil" class="btn">
                </form>
                <?php
                    if(isset($_POST['ubah_password'])){
                        $pass1 = $_POST['pass1'];
                        $pass2 = $_POST['pass2'];

                        if($pass2 != $pass1){
                            echo '<script>alert("Konfirmasi Password Baru Tidak Sesuai")</script>'; 
                        }else {
                            $u_pass = mysqli_query($conn, "UPDATE tb_admin SET password = '".$pass1."' 
                            WHERE admin_id = '".$d->admin_id."'");

                            if($u_pass){
                                echo '<script>alert("Ubah Data berhasil")</script>';
                                echo '<script>window.location="profil.php"</script>';
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
</body>
</html>