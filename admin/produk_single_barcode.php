<?php require '../library/vendor/autoload.php';require '../koneksi.php';
?>

<html>
    <body onload="window.print()">

    <h2 style="font-size: 50px; font-weight: 600; text-align: center;">Produk Barcode</h2>
    <div style="display: flex; align-items: center; gap: 50px; flex-wrap: wrap; margin: auto">
        <?php
$id = $_GET['id'];
$produk = $koneksi->query("select * from produk where produk_id='$id'");
while ($p = mysqli_fetch_array($produk)) {
    for ($i = 0; $i <= 20; $i++) {
        ?>
    <div>
            <h3 style="text-align: center; margin: 0; color: black; "><?php echo $p['produk_nama'] ?></h3>
            <img style="width: 200px; height: 80px;" src="../library/barcode.php?text=<?php echo $p['produk_kode'] ?>&print=true" alt="<?php echo $p['produk_kode'] ?>">
    </div>

<?php
}
}?>
    </body>
</html>
