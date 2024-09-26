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
            <h3 class="box-title">Filter Laporan Penjualan Harian</h3>
          </div>
          <div class="box-body">
            <div class="row">
            <form method="get" action="">
                <div class="col-md-2">

                  <div class="form-group">
                    <label>Tanggal</label>
                    <input autocomplete="off" type="text" value="<?php if (isset($_GET['tanggal_dari'])) {echo $_GET['tanggal_dari'];} else {echo "";}?>" name="tanggal_dari" class="form-control datepicker2" placeholder="Mulai Tanggal" required="required">
                  </div>
                </div>

                  <div class="col-md-2">
                  <div class="form-group">
                    <label>Kasir</label>
                    <select name="kasir" class="form-control">
                      <option value="Belum Pilih Kasir"><?php echo "- Belum Pilih Kasir";?></option>
                      <?php $kasirs = mysqli_query($koneksi, "SELECT kasir_nama FROM kasir");
                      while ($k = mysqli_fetch_array($kasirs)) {
                        ?>
                      <option value="<?php echo $k['kasir_nama'];?>"><?php echo $k['kasir_nama']; ?></option>
                      <?php } ?>
                    </select>
                  </div>

                </div>

                <div class="col-md-1">

                  <div class="form-group">
                    <input style="margin-top: 26px" type="submit" value="TAMPILKAN" class="btn btn-sm btn-primary btn-block">
                  </div>

                </div>
              </form>

              
          <div>
            <?php 
                  if(isset($_GET['tanggal_dari'])) {
                    $tanggal_dari = $_GET['tanggal_dari'];
                    if(isset($_GET['kasir'])) {
                      $kasir = $_GET['kasir'];
                      
              if($kasir == 'Belum Pilih Kasir') {
                      $penjualan_by_kasir = mysqli_query($koneksi, "SELECT invoice_tanggal, kasir_nama, SUM(transaksi_jumlah * produk_harga_jual) AS total_penjualan, SUM(transaksi_jumlah * produk_harga_modal) AS modal, SUM(transaksi_jumlah) AS transaksi_jumlah FROM invoice, kasir, produk, transaksi WHERE invoice_id = transaksi_invoice AND transaksi_produk=produk_id AND invoice_kasir=kasir_id AND date(invoice_tanggal) = '$tanggal_dari'");
                      while ($p = mysqli_fetch_array($penjualan_by_kasir)) { ?>
    
              <div style="margin-top: 19px;">
                <div class="col-md-1 bg-success" style="margin-left: 15px;">
                    <p style="margin: 0; text-align: center;">Total Penjualan</p>
                    <?php if ($p['total_penjualan'] != null) {?>
                      <p style="margin: 0; text-align: center; font-size: 1.6rem; font-weight: 700;"><?php echo number_format($p['total_penjualan']) ?></p>
                    <?php } else {?>
                      <p style="margin: 0; text-align: center; font-size: 1.6rem; font-weight: 700;"><?php echo number_format(0) ?></p>
                    <?php }?>
                </div>
                <div class="col-md-1 bg-success">
                  <p style="margin: 0; text-align: center;">Modal</p>
                  <?php if ($p['modal'] != null) {?>
                      <p style="margin: 0; text-align: center; font-size: 1.6rem; font-weight: 700;"><?php echo number_format($p['modal']) ?></p>
                    <?php } else {?>
                      <p style="margin: 0; text-align: center; font-size: 1.6rem; font-weight: 700;"><?php echo number_format(0) ?></p>
                    <?php }?>
                </div>
                <div class="col-md-1 bg-success">
                  <p style="margin: 0; text-align: center;">Laba</p>
                  <p style="margin: 0; text-align: center; font-size: 1.6rem; font-weight: 700;"><?php echo number_format($p['total_penjualan'] - $p['modal'])  ?></p>
                </div>
                <div class="col-md-1 bg-success">
                  <p style="margin: 0; text-align: center;">Produk Terjual</p>
                  <?php if ($p['transaksi_jumlah'] != null) {?>
                      <p style="margin: 0; text-align: center; font-size: 1.6rem; font-weight: 700;"><?php echo number_format($p['transaksi_jumlah']) ?></p>
                    <?php } else {?>
                      <p style="margin: 0; text-align: center; font-size: 1.6rem; font-weight: 700;"><?php echo number_format(0) ?></p>
                    <?php }?>
                </div>
              </div>
            <?php }
            } else {
            $penjualan_by_kasir = mysqli_query($koneksi, "SELECT invoice_tanggal, kasir_nama, SUM(transaksi_jumlah * produk_harga_jual) AS total_penjualan, SUM(transaksi_jumlah * produk_harga_modal) AS modal, SUM(transaksi_jumlah) AS transaksi_jumlah FROM invoice, kasir, produk, transaksi WHERE invoice_id = transaksi_invoice AND transaksi_produk=produk_id AND invoice_kasir=kasir_id AND date(invoice_tanggal) = '$tanggal_dari' AND kasir_nama = '$kasir'");
              while ($p = mysqli_fetch_array($penjualan_by_kasir)) { ?>
              <div style="margin-top: 19px;">
                <div class="col-md-1 bg-success" style="margin-left: 15px;">
                    <p style="margin: 0; text-align: center;">Total Penjualan</p>
                    <?php if ($p['total_penjualan'] != null) {?>
                      <p style="margin: 0; text-align: center; font-size: 1.6rem; font-weight: 700;"><?php echo number_format($p['total_penjualan']) ?></p>
                    <?php } else {?>
                      <p style="margin: 0; text-align: center; font-size: 1.6rem; font-weight: 700;"><?php echo number_format(0) ?></p>
                    <?php }?>
                </div>
                <div class="col-md-1 bg-success">
                  <p style="margin: 0; text-align: center;">Modal</p>
                  <?php if ($p['modal'] != null) {?>
                      <p style="margin: 0; text-align: center; font-size: 1.6rem; font-weight: 700;"><?php echo number_format($p['modal']) ?></p>
                    <?php } else {?>
                      <p style="margin: 0; text-align: center; font-size: 1.6rem; font-weight: 700;"><?php echo number_format(0) ?></p>
                    <?php }?>
                </div>
                <div class="col-md-1 bg-success">
                  <p style="margin: 0; text-align: center;">Laba</p>
                  <p style="margin: 0; text-align: center; font-size: 1.6rem; font-weight: 700;"><?php echo number_format($p['total_penjualan'] - $p['modal'])  ?></p>
                </div>
                <div class="col-md-1 bg-success">
                  <p style="margin: 0; text-align: center;">Produk Terjual</p>
                  <?php if ($p['transaksi_jumlah'] != null) {?>
                      <p style="margin: 0; text-align: center; font-size: 1.6rem; font-weight: 700;"><?php echo number_format($p['transaksi_jumlah']) ?></p>
                    <?php } else {?>
                      <p style="margin: 0; text-align: center; font-size: 1.6rem; font-weight: 700;"><?php echo number_format(0) ?></p>
                    <?php }?>
                </div>
              </div>
            <?php }}}} ?>


          </div>
            </div>

            
            
          </div>
        </div>

        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">Data Penjualan</h3>
          </div>
          <div class="box-body">

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

              <div class="row">
                <div class="col-lg-6">
                  <table class="table table-bordered">
                    <tr>
                      <th width="30%">TANGGAL</th>
                      <th width="1%">:</th>
                      <td><?php echo $tgl_dari;
 ?></td>
                    </tr>
                  </table>

                </div>
              </div>

              <a href="laporan_harian_pdf.php?tanggal_dari=<?php echo $tgl_dari ?>&kasir=<?php echo $kasir ?>" target="_blank" class="btn btn-sm btn-danger"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a>
              <a href="laporan_harian_print.php?tanggal_dari=<?php echo $tgl_dari ?>&kasir=<?php echo $kasir ?>" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> &nbsp PRINT</a>
              <a href="laporan_harian_excel.php?tanggal_dari=<?php echo $tgl_dari ?>&kasir=<?php echo $kasir ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-print"></i> &nbsp CETAK EXCEL</a>
              <?php if(isset($_GET['kasir'])) {
                  $kasir = $_GET['kasir'];

              if($kasir == 'Belum Pilih Kasir') {
              ?>

              <div class="table-responsive">


                <table class="table table-bordered table-striped" id="table-datatable">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="10%" class="text-center">No.Invoice</th>
                      <th class="text-center">Tanggal</th>
                      <th class="text-center">Jam</th>
                      <th class="text-center">Shif</th>
                      <th class="text-center">Kasir</th>
                      <th class="text-center">Nama Produk</th>
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
    $data = mysqli_query($koneksi, "SELECT invoice_nomor,invoice_tanggal,invoice_waktu,invoice_pelanggan,kasir_nama,produk_nama,kategori,transaksi_jumlah,produk_harga_jual,produk_harga_modal from invoice,kasir,produk,kategori,transaksi where invoice_id=transaksi_invoice and transaksi_produk=produk_id and produk_kategori=kategori_id and invoice_kasir=kasir_id and date(invoice_tanggal) = '$tgl_dari'");
    while ($d = mysqli_fetch_array($data)) {
        ?>
                      <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td class="text-center"><?php echo $d['invoice_nomor']; ?></td>
                        <td class="text-center"><?php echo date('d-m-Y', strtotime($d['invoice_tanggal'])); ?></td>
                        <td class="text-center"><?php echo $d['invoice_waktu']; ?></td>
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


              </div>

              <?php
              } else { ?>
                <div class="table-responsive">


                <table class="table table-bordered table-striped" id="table-datatable">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="10%" class="text-center">No.Invoice</th>
                      <th class="text-center">Tanggal</th>
                      <th class="text-center">Jam</th>
                      <th class="text-center">Shif</th>
                      <th class="text-center">Kasir</th>
                      <th class="text-center">Nama Produk</th>
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
    $data = mysqli_query($koneksi, "SELECT invoice_nomor,invoice_tanggal,invoice_waktu,invoice_pelanggan,kasir_nama,produk_nama,kategori,transaksi_jumlah,produk_harga_jual,produk_harga_modal from invoice,kasir,produk,kategori,transaksi where invoice_id=transaksi_invoice and transaksi_produk=produk_id and produk_kategori=kategori_id and invoice_kasir=kasir_id and date(invoice_tanggal) = '$tgl_dari' and kasir_nama = '$kasir'");
    while ($d = mysqli_fetch_array($data)) {
        ?>
                      <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td class="text-center"><?php echo $d['invoice_nomor']; ?></td>
                        <td class="text-center"><?php echo date('d-m-Y', strtotime($d['invoice_tanggal'])); ?></td>
                        <td class="text-center"><?php echo $d['invoice_waktu']; ?></td>
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


              </div>
             <?php }
            
            }
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