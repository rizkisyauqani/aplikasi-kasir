 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>Laporan Penjualan</title>
 	<link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
 	<?php include '../koneksi.php';?>
 </head>
 <body>

 	<style type="text/css">
 		.table-tanggal tr th, .table-tanggal tr td{
 			padding: 5px;
 		}
 	</style>

	 	<?php
if (isset($_GET['tanggal_dari'])) {
    $tgl_dari = $_GET['tanggal_dari'];

    // Extract day, month, and year
    $day_dari = date('d', strtotime($tgl_dari));
    $month_dari = date('m', strtotime($tgl_dari));
    $year_dari = date('Y', strtotime($tgl_dari));

    function tgl_indo($tanggal)
    {
        $bulan = array(
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
    }
    ?>

 	<center>
 		<h4 style="font-size: 24px;">Laporan Penjualan Harian</h4>
		<h6 style="font-size: 16px;"><?php echo tgl_indo(date("$year_dari-$month_dari-$day_dari"));?></h6>
		<div class="row">
					<tr> <img style="width: 150px;" src="../assets/logo-kantin-cempaka-lima.jpg" alt="logo-kantin-cempaka-lima"> </tr>
		</div>
 	</center>

 		<br>


 		<table class="table table-bordered table-striped" id="table-datatable">
 			<thead>
 				<tr>
 					<th width="1%">No</th>
 					<th width="10%" class="text-center">No. Invoice</th>
 					<th class="text-center">Tanggal</th>
 					<th class="text-center">Shif</th>
 					<th class="text-center">Kasir</th>
 					<th class="text-center">Nama Produk</th>
 					<th class="text-center">Kategori</th>
 					<th class="text-center">Jumlah Yang Terjual (Pcs)</th>
 					<th class="text-center">Total (Rp)</th>
 					<th class="text-center">Modal (Rp)</th>
 					<th class="text-center">Laba (Rp)</th>
 				</tr>
 			</thead>
 			<tbody>
                    <?php
$no = 1;
    $produk_nama = '';
    $produk_kategori = '';
    $x_total_produk = 0;
    $x_total_total = 0;
    $x_total_modal = 0;
    $x_total_laba = 0;
    $data = mysqli_query($koneksi, "SELECT invoice_nomor,invoice_tanggal,invoice_pelanggan,kasir_nama,produk_nama,kategori,transaksi_jumlah,produk_harga_jual,produk_harga_modal from invoice,kasir,produk,kategori,transaksi where invoice_id=transaksi_invoice and transaksi_produk=produk_id and produk_kategori=kategori_id and invoice_kasir=kasir_id and date(invoice_tanggal) = '$tgl_dari'");
    while ($d = mysqli_fetch_array($data)) {
        ?>
                      <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td class="text-center"><?php echo $d['invoice_nomor']; ?></td>
                        <td class="text-center"><?php echo date('d-m-Y', strtotime($d['invoice_tanggal'])); ?></td>
                        <td class="text-center"><?php echo $d['invoice_pelanggan']; ?></td>
                        <td class="text-center"><?php echo $d['kasir_nama']; ?></td>
                        <td class="text-left"><?php echo $d['produk_nama']; ?></td>
                        <td class="text-center"><?php echo $d['kategori']; ?></td>
                        <td class="text-center"><?php echo $d['transaksi_jumlah']; ?></td>
                        <td class="text-right"><?php echo number_format($d['produk_harga_jual'] * $d['transaksi_jumlah']); ?></td>
                        <td class="text-right"><?php echo number_format($d['produk_harga_modal'] * $d['transaksi_jumlah']); ?></td>
                        <td class="text-right"><?php echo number_format($d['produk_harga_jual'] * $d['transaksi_jumlah'] - $d['produk_harga_modal'] * $d['transaksi_jumlah']); ?></td>
                      </tr>
<?php
}
    ?>
            </tbody>
 		</table>


 		<?php
} else {
    ?>

 		<div class="alert alert-info text-center">
 			Silahkan Filter Laporan Terlebih Dulu.
 		</div>

 		<?php
}
?>


 	<script>
 		window.print();
 		$(document).ready(function(){

 		});
 	</script>

 </body>
 </html>
