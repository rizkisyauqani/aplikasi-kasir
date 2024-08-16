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

 	<center>
 		<h4 style="margin-top: 20px; margin-bottom: 0;">LAPORAN PENJUALAN PER PRODUK</h4>
 	<?php
if (isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari'])) {
    $tgl_dari = date($_GET['tanggal_dari']);
    $tgl_sampai = $_GET['tanggal_sampai'];

    // Extract day, month, and year
    $day_dari = date('d', strtotime($tgl_dari));
    $month_dari = date('m', strtotime($tgl_dari));
    $year_dari = date('Y', strtotime($tgl_dari));

    $day_sampai = date('d', strtotime($tgl_sampai));
    $month_sampai = date('m', strtotime($tgl_sampai));
    $year_sampai = date('Y', strtotime($tgl_sampai));

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

 		<div class="row">
 			<div class="col-lg">
					<tr>
 						<td><?php echo tgl_indo(date("$year_dari-$month_dari-$day_dari")); ?></td>
						<td>-</td>
 						<td><?php echo tgl_indo(date("$year_sampai-$month_sampai-$day_sampai")); ?></td>
 			</div>
 		</div>

		<div class="row">
					<tr> <img style="width: 150px;" src="../assets/logo-kantin-cempaka-lima.jpg" alt="logo-kantin-cempaka-lima"> </tr>
		</div>
	</center>

	<div>
	</div>

	<div class="row">
 			<div class="col-lg-2">
 				<table class="table-tanggal">
 					<tr>
 						<th width="30%">TANGGAL</th>
 						<th width="1%">:</th>
 						<td><?php echo tgl_indo(date('y-m-d')) ?></td>
 					</tr>
 					<tr>
 						<th width="30%">Perihal</th>
 						<th width="1%">:</th>
 						<td>Laporan Per Produk</td>
 					</tr>
 				</table>
 			</div>
 		</div>


 		<table class="table table-bordered table-striped" id="table-datatable">
 			<thead>
 				<tr style="background-color: #98fab2;">
 					<th width="1%">NO</th>
 					<th class="text-center">Nama Produk</th>
 					<th class="text-center">Kategori</th>
 					<th class="text-center">Jumlah Produk Terjual (Pcs)</th>
 					<th class="text-center">TOTAL (Rp)</th>
 					<th class="text-center">MODAL (Rp)</th>
 					<th class="text-center">LABA (Rp)</th>
 				</tr>
 			</thead>
 			<tbody>
 				<?php
$no = 1; 
    $data = mysqli_query($koneksi, "SELECT produk.produk_nama, produk.produk_harga_jual, produk.produk_harga_modal, SUM(transaksi.transaksi_jumlah) AS transaksi_jumlah, kategori.kategori FROM produk INNER JOIN transaksi ON produk.produk_id = transaksi.transaksi_produk INNER JOIN kategori ON kategori.kategori_id = produk.produk_kategori GROUP BY transaksi_produk");
    while ($d = mysqli_fetch_array($data)) {
        ?>
 					<tr>
 						<td class="text-center"><?php echo $no++; ?></td>
 						<td class="text-left"><?php echo $d['produk_nama']; ?></td>
 						<td class="text-center"><?php echo $d['kategori']; ?></td>
 						<td class="text-center"><?php echo $d['transaksi_jumlah']; ?></td>
 						<td class="text-right"><?php echo number_format($d['transaksi_jumlah'] * $d['produk_harga_jual']); ?></td>
						<td class="text-right"><?php echo number_format($d['transaksi_jumlah'] * $d['produk_harga_modal']); ?></td>
                        <td class="text-right"><?php echo number_format($d['transaksi_jumlah'] * $d['produk_harga_jual'] - $d['transaksi_jumlah'] * $d['produk_harga_modal']); ?></td>
				</tr>

 		<?php
}
    ?>
 	</center>

<?php
}?>


 	<script>
 		window.print();
 		$(document).ready(function(){

 		});
 	</script>

 </body>
 </html>
