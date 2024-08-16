<?php include 'header.php';?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      LAPORAN
      <small>Data Laporan Penjualan</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">Filter Laporan Penjualan</h3>
          </div>
          <div class="box-body">
            <form method="get" action="">
              <div class="row">
                <div class="col-md-2">

                  <div class="form-group">
                    <label>Mulai Tanggal</label>
                    <input autocomplete="off" type="text" value="<?php if (isset($_GET['tanggal_dari'])) {echo $_GET['tanggal_dari'];} else {echo "";}?>" name="tanggal_dari" class="form-control datepicker2" placeholder="Mulai Tanggal" required="required">
                  </div>

                </div>

                <div class="col-md-2">

                  <div class="form-group">
                    <label>Sampai Tanggal</label>
                    <input autocomplete="off" type="text" value="<?php if (isset($_GET['tanggal_sampai'])) {echo $_GET['tanggal_sampai'];} else {echo "";}?>" name="tanggal_sampai" class="form-control datepicker2" placeholder="Sampai Tanggal" required="required">
                  </div>

                </div>

                <div class="col-md-1">

                  <div class="form-group">
                    <input style="margin-top: 26px" type="submit" value="TAMPILKAN" class="btn btn-sm btn-primary btn-block">
                  </div>

                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">Data Penjualan</h3>
          </div>
          <div class="box-body">

            <?php
if (isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari'])) {
    $tgl_dari = $_GET['tanggal_dari'];
    $tgl_sampai = $_GET['tanggal_sampai'];
    ?>

              <div class="row">
                <div class="col-lg-6">
                  <table class="table table-bordered">
                    <tr>
                      <th width="30%">DARI TANGGAL</th>
                      <th width="1%">:</th>
                      <td><?php echo $tgl_dari; ?></td>
                    </tr>
                    <tr>
                      <th>SAMPAI TANGGAL</th>
                      <th>:</th>
                      <td><?php echo $tgl_sampai; ?></td>
                    </tr>
                  </table>

                </div>
              </div>

              <a href="laporan_pdf.php?tanggal_dari=<?php echo $tgl_dari ?>&tanggal_sampai=<?php echo $tgl_sampai ?>" target="_blank" class="btn btn-sm btn-danger"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a>
              <a href="laporan_print.php?tanggal_dari=<?php echo $tgl_dari ?>&tanggal_sampai=<?php echo $tgl_sampai ?>" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> &nbsp PRINT</a>
              <a href="laporan_excel.php?tanggal_dari=<?php echo $tgl_dari ?>&tanggal_sampai=<?php echo $tgl_sampai ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-print"></i> &nbsp CETAK EXCEL</a>
              <div class="table-responsive">

                <table class="table table-bordered table-striped" id="table-datatable">
                  <thead>
                    <tr style="background-color: rgb(168, 245, 86);">
                      <th width="1%">NO</th>
                      <th width="10%" class="text-center">Nama Produk</th>
                      <th class="text-center">Kategori</th>
                      <th class="text-center">Jumlah Produk Terjual (Pcs)</th>
                      <th class="text-center">Total (Rp)</th>
                      <th class="text-center">Modal (Rp)</th>
                      <th class="text-center">Laba (Rp)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
$no = 1;
    $x_total_sub_total = 0;
    $x_total_total = 0;
    $x_total_modal = 0;
    $x_total_laba = 0;
    $data = mysqli_query($koneksi, "SELECT produk.produk_nama, produk.produk_harga_jual, produk.produk_harga_modal, SUM(transaksi.transaksi_jumlah) AS transaksi_jumlah, kategori.kategori FROM produk INNER JOIN transaksi ON produk.produk_id = transaksi.transaksi_produk INNER JOIN kategori ON kategori.kategori_id = produk.produk_kategori GROUP BY transaksi_produk");
    while ($d = mysqli_fetch_array($data)) {
      $x_total_total = number_format($d['transaksi_jumlah'] * $d['produk_harga_jual'])
        ?>
                      <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td><?php echo $d['produk_nama']; ?></td>
                        <td class="text-center"><?php echo $d['kategori']; ?></td>
                        <td class="text-center"><?php echo $d['transaksi_jumlah']; ?></td>
                        <td class="text-right"><?php echo number_format($d['transaksi_jumlah'] * $d['produk_harga_jual']) ?></td>
                        <td class="text-right"><?php echo number_format($d['transaksi_jumlah'] * $d['produk_harga_modal']) ?></td>
                        <td class="text-right"><?php echo number_format($d['transaksi_jumlah'] * $d['produk_harga_jual'] - $d['transaksi_jumlah'] * $d['produk_harga_modal']) ?></td>
                      </tr>
                      <?php
}
    ?>
                  </tbody>
                  <!-- <tfoot>
 				<tr class="bg-info">
 					<td colspan="4" class="text-right"><b>TOTAL</b></td>
 					<td class="text-right"><?php echo number_format($total); ?></td>
 					<td class="text-right"><?php echo number_format(1);?></td>
 					<td class="text-right"><?php echo number_format(1); ?></td>
 				</tr>
 			</tfoot> -->
                </table>
              </div>
              <?php
} else {
    ?>
              <div class="alert alert-info text-center">
                Silahkan Filter Laporan Terlebih Dulu.
              </div>
              <?php
}
?>
          </div>
        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php';?>