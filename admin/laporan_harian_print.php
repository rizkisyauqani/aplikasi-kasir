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
        $ksr = isset($_GET['kasir']) ? $_GET['kasir'] : '';

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

            return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
        }
    ?>

    <center>
        <h4 style="font-size: 24px;">Laporan Penjualan Harian</h4>
        <h6 style="font-size: 16px;"><?php echo tgl_indo(date("$year_dari-$month_dari-$day_dari"));?></h6>
        <div class="row">
            <img style="width: 150px;" src="../assets/logo-kantin-cempaka-lima.jpg" alt="logo-kantin-cempaka-lima">
        </div>
    </center>

    <br>

    <table class="table table-bordered table-striped" id="table-datatable">
        <thead>
            <tr>
                <th width="1%">No</th>
                <th width="10%" class="text-center">No. Invoice</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Jam</th>
                <th class="text-center">Shift</th>
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
            $query = "SELECT invoice_nomor, invoice_tanggal, invoice_waktu, invoice_pelanggan, kasir_nama, produk_nama, kategori, transaksi_jumlah, produk_harga_jual, produk_harga_modal 
                      FROM invoice 
                      JOIN kasir ON invoice_kasir = kasir_id 
                      JOIN transaksi ON invoice_id = transaksi_invoice 
                      JOIN produk ON transaksi_produk = produk_id 
                      JOIN kategori ON produk_kategori = kategori_id 
                      WHERE date(invoice_tanggal) = '$tgl_dari'";

            if ($ksr && $ksr !== 'Belum Pilih Kasir') {
                $query .= " AND kasir_nama = '$ksr'";
            }

            $data = mysqli_query($koneksi, $query);
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
                    <td class="text-right"><?php echo number_format(($d['produk_harga_jual'] - $d['produk_harga_modal']) * $d['transaksi_jumlah']); ?></td>
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
