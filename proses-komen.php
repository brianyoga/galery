<?php
include 'db.php';
$produk = mysqli_query($conn, "SELECT * FROM tb_image WHERE image_id = '" . $_GET['id'] . "'");
$p = mysqli_fetch_object($produk);
if (isset($_POST['submit'])) {
    $nama_komen = $_POST['nama_komen'];
    $komentar = $_POST['komentar'];
    $adminid = $_POST['adminid'];
    $insert = mysqli_query($conn, "INSERT INTO tb_comen VALUES (
                            null,
                            '" . $nama_komen . "',
                            '" . $komentar . "',
                            '" . $adminid . "'                           
                        )");
    if ($insert) {
        echo '<script>window.location="detail-image.php?id=<?php echo $p->image_id ?>"</script>';
    } else {
        echo 'gagal' . mysqli_error($conn);
    }
}
