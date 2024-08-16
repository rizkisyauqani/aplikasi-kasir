 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>Cetak invoice - Sistem Point Of Sales (POS)</title>
 	<link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- <style>
        @page {
            size: 85mm 120mm;
            margin: 0;
			/* font-size: 30px; */
        }

        body {
            width: 85mm;
            height: 120mm;
            margin: 0;
            padding: 0;
			font-size: 18px;
        }</style> -->

		<style>
			body {
				margin: 0;
				padding: 0;
				font-size: 17px;
			}

			table td p {
				margin: 0;
			}
		</style>
 </head>
 <body>

 	<div class="row" style="min-width: 350px;">
		<img src="../assets/logo-kantin-cempaka-lima.jpg" alt="logo kantin cempaka lima" style="width: 220px; display: block; margin: auto;">
 		<h4 style="font-size: 25px; text-align: center; margin-top: -40px; margin-bottom: 20px;">Struk Pembelian</h4>
 	</div>
 	<!-- <br> -->

 	<?php
if ($_GET['id']) {
    ?>
 		<?php
include "../koneksi.php";
    $id = $_GET['id'];

    $invoice = mysqli_query($koneksi, "select * from invoice,kasir where invoice_kasir=kasir_id and invoice_id='$id'");
    while ($d = mysqli_fetch_array($invoice)) {
        ?>

 			<div class="row">
 				<div class="col-lg-4">
 					<table class="table">
 						<tr>
 							<th>No. Invoice</th>
 							<th>:</th>
 							<td><?php echo $d['invoice_nomor']; ?></td>
 						</tr>
 						<tr>
 							<th>Tanggal Invoice</th>
 							<th>:</th>
 							<td><?php echo date('d-m-Y', strtotime($d['invoice_tanggal'])); ?></td>
 						</tr>
 						<tr>
 							<th>Kasir</th>
 							<th>:</th>
 							<td><?php echo $d['kasir_nama']; ?></td>
 						</tr>
 						<!-- <tr>
 							<th width="40%">Kasir yang melayani</th>
 							<th width="1%">:</th>
 							<td><?php echo $d['kasir_nama']; ?></td>
 						</tr> -->
 					</table>
 				</div>
 			</div>

 			<h5 style="font-size: 18px; margin-top: 0;"><strong>Daftar Pembelian</strong></h5>

 			<table class="table table-bordered table-striped table-hover" id="table-pembelian" style="margin-bottom: 10px; position: relative;">
 				<thead>
 					<tr>
 						<!-- <th width="18%">Kode Produk</th> -->
 						<th>Nama Produk</th>
 						<!-- <th width="1%" style="text-align: center;">Harga</th>
 						<th width="1%" style="text-align: center;">Jumlah</th> -->
 						<th width="1%" style="text-align: center;">Total</th>
 					</tr>
 				</thead>
 				<tbody>
 					<?php
$id_invoice = $d['invoice_id'];
        $ppata = mysqli_query($koneksi, "SELECT * FROM produk,kategori,transaksi where produk_kategori=kategori_id and transaksi_invoice='$id_invoice' and transaksi_produk=produk_id");
        while ($pp = mysqli_fetch_array($ppata)) {
            ?>
 						<tr>
 							<!-- <td><?php echo $pp['produk_kode']; ?></td> -->
 							<td style="padding: 2px 8px;">
 								<p>
									<?php echo $pp['produk_nama']; ?>
								</p>
 								<!-- <br>
 								<small class="text-muted"><?php echo $pp['kategori']; ?></small> -->
								<p>
									<small class="text-muted"><?php echo number_format($pp['transaksi_harga']) . " x"; ?></small>
									<small class="text-muted"><?php echo $pp['transaksi_jumlah']; ?></small>
		</p>
 							</td>
 							<!-- <td style="text-align: center;"><?php echo "Rp." . number_format($pp['transaksi_harga']) . ",-"; ?></td>
 							<td style="text-align: center;"><?php echo $pp['transaksi_jumlah']; ?></td> -->
 							<td style="text-align: center; padding: 2px 8px;"><?php echo "Rp." . number_format($pp['transaksi_total']) . ",-"; ?></td>
 						</tr>
 						<?php
}
        ?>
		<tr>
						 <td colspan="1" style="text-align: right;">Total</th>
						 <td>
								  <span class="total_pembelian"><?php echo "Rp." . number_format($d['invoice_total']) . ",-"; ?></span>

						 </td>
					 </tr>
 				</tbody>
				 <!-- <tfoot>
					 <tr>
						 <td colspan="3" style="text-align: right;">Total Pembelian</th>
						 <td>
								  <span class="total_pembelian"><?php echo "Rp." . number_format($d['invoice_total']) . ",-"; ?></span>

						 </td>
					 </tr>
				 </tfoot> -->
			</table>

 			<div class="row" style="position: absolute;">
 				<div class="col-lg-12">
 					<table class="table table-bordered table-striped" style="width: 100%;">
						<tfoot>
 						<!-- <tr>
 							<th width="30%">Sub Total</th>
 							<td>
 								<span class="sub_total_pembelian"><?php echo "Rp." . number_format($d['invoice_sub_total']) . ",-"; ?></span>
 							</td>
 						</tr>
 						<tr>
 							<th>Diskon</th>
 							<td>
 								<?php echo $d['invoice_diskon'] ?>%
 							</td>
 						</tr> -->
 						<tr>
 							<!-- <th style="text-align: right;">Total</th> -->
 							<!-- <th colspan="3" style="text-align: right;">
								Total Pembelian
 							</td>
							<td>
 								<span class="total_pembelian"><?php echo "Rp." . number_format($d['invoice_total']) . ",-"; ?></span>

							</td> -->
 						</tr>
						</tfoot>
 					</table>
 				</div>
 			</div>

			<div class="row" style=" padding-bottom: 8px;">
					<p style="text-align: center; margin-top: 20px 0;">Terima kasih atas kunjungan Anda</p>
			</div>

 			<?php
}
    ?>
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
