<?php require '../library/vendor/autoload.php';require '../koneksi.php'?>

<html>
    <body onload="window.print()">

    <h2 style="font-size: 50px; font-weight: 600; text-align: center;">Produk Barcode</h2>
    <div style="display: flex; align-items: center; gap: 50px; flex-wrap: wrap; margin: auto">
        <?php $no = 0;
$produk = $koneksi->query('SELECT * FROM produk');
while ($p = mysqli_fetch_array($produk)) {
    $no++;?>
    <a class="btn btn-warning btn-sm" style="text-decoration: none;" href="produk_single_barcode.php?id=<?php echo $p['produk_id'] ?>">
            <h3 style="text-align: center; margin: 0; color: black; "><?php echo $p['produk_nama'] ?></h3>
            <img style="width: 200px; height: 80px;" src="../library/barcode.php?text=<?php echo $p['produk_kode'] ?>&print=true" alt="<?php echo $p['produk_kode'] ?>">
    </a>
        <?php
}?>
    </div>

    </body>
</html>
