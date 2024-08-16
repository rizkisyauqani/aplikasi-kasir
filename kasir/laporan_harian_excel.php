<?php require_once "../koneksi.php";

if (isset($_GET['tanggal_dari'])) {
    $tgl_dari = $_GET['tanggal_dari'];
}

$day_dari = date('d', strtotime($tgl_dari));
$month_dari = date('m', strtotime($tgl_dari));
$year_dari = date('Y', strtotime($tgl_dari));

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Laporan Harian Tanggal <?php echo date("$year_dari-$month_dari-$day_dari"); ?></title>
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
                                <th>No.Invoice</th>
                                <th >Tanggal</th>
                      <th >Shif</th>
                      <th >Kasir</th>
                      <th >Nama Produk</th>
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
$data = mysqli_query($koneksi, "SELECT invoice_nomor,invoice_tanggal,invoice_pelanggan,kasir_nama,produk_nama,kategori,transaksi_jumlah,produk_harga_jual,produk_harga_modal from invoice,kasir,produk,kategori,transaksi where invoice_id=transaksi_invoice and transaksi_produk=produk_id and produk_kategori=kategori_id and invoice_kasir=kasir_id and date(invoice_tanggal) = '$tgl_dari'");
while ($d = mysqli_fetch_array($data)) {
    ?>
<tr>
    <td><?php echo $no++; ?></td>
    <td ><?php echo $d['invoice_nomor'];
    ?></td>
    <td><?php echo date('d-m-Y', strtotime($d['invoice_tanggal']));
    ?></td>
    <td ><?php echo $d['invoice_pelanggan'];
    ?></td>
    <td><?php $d['kasir_nama'];
    ?></td>
    <td><?php echo $d['produk_nama'];
    ?></td>
    <td><?php echo $d['kategori'];
    ?></td>
    <td><?php echo $d['transaksi_jumlah'];
    ?></td>
    <td><?php echo number_format($d['produk_harga_jual'] * $d['transaksi_jumlah']);
    ?></td>
    <td><?php echo number_format($d['produk_harga_modal'] * $d['transaksi_jumlah']);
    ?></td>
    <td><?php echo number_format($d['produk_harga_jual'] * $d['transaksi_jumlah'] - $d['produk_harga_modal'] * $d['transaksi_jumlah']);
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
