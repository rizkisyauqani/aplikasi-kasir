<?php require_once "../koneksi.php";?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Laporan Bulanan</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- ========================================================= -->


    <link rel="stylesheet" href="datatable/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="datatable/assets/css/datatables.min.css">
    <link rel="stylesheet" href="datatable/assets/css/style.css">






</head>
<body>
    <!-- =======  Data-Table  = Start  ========================== -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="data_table">
                    <table id="example" class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Jumlah Yang Terjual (Pcs)</th>
                                <th>Total (Rp)</th>
                                <th>Modal (Rp)</th>
                                <th>Laba (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$no = 1;
$data = mysqli_query($koneksi, "SELECT produk.produk_nama, produk.produk_harga_jual, produk.produk_harga_modal, SUM(transaksi.transaksi_jumlah) AS transaksi_jumlah, kategori.kategori FROM produk INNER JOIN transaksi ON produk.produk_id = transaksi.transaksi_produk INNER JOIN kategori ON kategori.kategori_id = produk.produk_kategori GROUP BY transaksi_produk");
while ($d = mysqli_fetch_array($data)) {
    ?>
<tr>
    <td><?php echo $no++; ?></td>
    <td ><?php echo $d['produk_nama'];
    ?></td>
    <td><?php echo $d['kategori'];
    ?></td>
    <td ><?php echo $d['transaksi_jumlah'];
    ?></td>
    <td><?php echo number_format($d['transaksi_jumlah'] * $d['produk_harga_jual']);
    ?></td>
    <td><?php echo number_format($d['transaksi_jumlah'] * $d['produk_harga_modal']);
    ?></td>
    <td><?php echo number_format($d['transaksi_jumlah'] * $d['produk_harga_jual'] - $d['transaksi_jumlah'] * $d['produk_harga_modal']);
    ?></td>
</tr>
<?php
}?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- =======  Data-Table  = End  ===================== -->
    <!-- ============ Java Script Files  ================== -->


    <script src="datatable/assets/js/bootstrap.bundle.min.js"></script>
    <script src="datatable/assets/js/jquery-3.6.0.min.js"></script>
    <script src="datatable/assets/js/datatables.min.js"></script>
    <script src="datatable/assets/js/pdfmake.min.js"></script>
    <script src="datatable/assets/js/vfs_fonts.js"></script>
    <script src="datatable/assets/js/custom.js"></script>




</body>

</html>
