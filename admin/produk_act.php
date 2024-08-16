<?php
require '../library/vendor/autoload.php';
include '../koneksi.php';
$kode = $_POST['kode'];
$nama = $_POST['nama'];
$satuan = $_POST['satuan'];
$kategori = $_POST['kategori'];
$stok = $_POST['stok'];
$harga_modal = $_POST['harga_modal'];
$harga_jual = $_POST['harga_jual'];
$keterangan = $_POST['keterangan'];
$isBarcode = $_POST['isBarcode'];

$rand = rand();
$allowed = array('gif', 'png', 'jpg', 'jpeg');
$filename = $_FILES['foto']['name'];

if ($filename == "") {
    mysqli_query($koneksi, "insert into produk values (NULL,'$kode','$nama','$satuan','$kategori','$stok','$harga_modal','$harga_jual','$keterangan','')") or die(mysqli_error($koneksi));
    header("location:produk.php");
} else {
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    if (!in_array($ext, $allowed)) {
        header("location:produk.php?alert=gagal");
    } else {
        move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/produk/' . $rand . '_' . $filename);
        $file_gambar = $rand . '_' . $filename;
        mysqli_query($koneksi, "insert into produk values (NULL,'$kode','$nama','$satuan','$kategori','$stok','$harga_modal','$harga_jual','$keterangan','$file_gambar')");
        header("location:produk.php");
    }
}
