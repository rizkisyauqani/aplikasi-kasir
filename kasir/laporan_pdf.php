<?php
// memanggil library FPDF
require_once '../library/fpdf186/fpdf.php';

include '../koneksi.php';
$tgl_dari = $_GET['tanggal_dari'];
$tgl_sampai = $_GET['tanggal_sampai'];

// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l', 'mm', 'A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial', 'B', 14);
// mencetak string
$pdf->Image('../assets/logo-kantin-cempaka-lima.jpg', 10, 0, 50);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(280, 7, 'LAPORAN PENJUALAN PER PRODUK', 0, 1, 'C');

// Memberikan space kebawah agar tidak terlalu rapat
// $pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Arial', 'B', 10);

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

$pdf->Cell(280, 7, tgl_indo(date("$year_dari-$month_dari-$day_dari" . '-')) . ' - ' . tgl_indo(date("$year_sampai-$month_sampai-$day_sampai")), 0, 0, 'C');

$pdf->Cell(10, 25, '', 0, 1);
$pdf->SetFont('Arial', 'B', 10);

$pdf->cell(20, 7, "Tanggal", 0, 0, 'L');
$pdf->cell(5, 7, ":", 0, 0, 'L');
$pdf->cell(17, 7, tgl_indo(date('y-m-d')), 0, 1, 'L');
// $pdf->Cell(10, 1, '', 0, 1);
$pdf->cell(20, 7, "Perihal", 0, 0, 'L');
$pdf->cell(5, 7, ":", 0, 0, 'L');
$pdf->cell(17, 7, "Laporan Per Produk", 0, 1, 'L');

$pdf->Cell(10, 1, '', 0, 1);
$pdf->SetFillColor(168, 245, 86);
$pdf->Cell(15, 7, 'NO', 1, 0, 'C', true);
$pdf->Cell(45, 7, 'NAMA PRODUK', 1, 0, 'C', true);
$pdf->Cell(40, 7, 'KATEGORI', 1, 0, 'C', true);
$pdf->Cell(65, 7, 'JUMLAH PRODUK TERJUAL (Pcs)', 1, 0, 'C', true);
$pdf->Cell(35, 7, 'TOTAL (Rp)', 1, 0, 'C', true);
$pdf->Cell(35, 7, 'MODAL (Rp)', 1, 0, 'C', true);
$pdf->Cell(35, 7, 'LABA (Rp)', 1, 0, 'C', true);

$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Arial', '', 10);

$no = 1;
$data = mysqli_query($koneksi, "SELECT produk.produk_nama, produk.produk_harga_jual, produk.produk_harga_modal, SUM(transaksi.transaksi_jumlah) AS transaksi_jumlah, kategori.kategori FROM produk INNER JOIN transaksi ON produk.produk_id = transaksi.transaksi_produk INNER JOIN kategori ON kategori.kategori_id = produk.produk_kategori GROUP BY transaksi_produk");
while ($d = mysqli_fetch_array($data)) {

    $pdf->Cell(15, 6, $no++, 1, 0, 'C');
    $pdf->Cell(45, 6, $d['produk_nama'], 1, 0, 'L');
    $pdf->Cell(40, 6, $d['kategori'], 1, 0, 'C');
    $pdf->Cell(65, 6, $d['transaksi_jumlah'], 1, 0, 'C');
    $pdf->Cell(35, 6, number_format($d['transaksi_jumlah'] * $d['produk_harga_jual']), 1, 0, 'R');
    $pdf->Cell(35, 6, number_format($d['transaksi_jumlah'] * $d['produk_harga_modal']), 1, 0, 'R');
    $pdf->Cell(35, 6, number_format($d['transaksi_jumlah'] * $d['produk_harga_jual'] - $d['transaksi_jumlah'] * $d['produk_harga_modal']), 1, 0, 'R');

    $pdf->Cell(10, 6, '', 0, 1);
}

$pdf->Output();
