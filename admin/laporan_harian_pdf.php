<?php
// memanggil library FPDF
require_once '../library/fpdf186/fpdf.php';

include '../koneksi.php';
$tgl_dari = $_GET['tanggal_dari'];
$ksr = $_GET['kasir'];

// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l', 'mm', 'A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial', 'B', 14);
// mencetak string
$pdf->Image('../assets/logo-kantin-cempaka-lima.jpg', 10, 0, 50);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(280, 7, 'LAPORAN PENJUALAN HARIAN', 0, 1, 'C');

// Memberikan space kebawah agar tidak terlalu rapat
// $pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Arial', 'B', 10);

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

$pdf->Cell(280, 7, tgl_indo(date("$year_dari-$month_dari-$day_dari" . '-')), 0, 0, 'C');

$pdf->Cell(10, 25, '', 0, 1);
$pdf->SetFont('Arial', 'B', 10);

$pdf->cell(20, 7, "Tanggal", 0, 0, 'L');
$pdf->cell(5, 7, ":", 0, 0, 'L');
// $pdf->cell(17, 7, tgl_indo(date("$year_dari-$month_dari-$day_dari" . '-')), 0, 1, 'L');
// $pdf->Cell(10, 1, '', 0, 1);

$pdf->Cell(10, 1, '', 0, 1);
$pdf->SetFillColor(168, 245, 86);
$pdf->Cell(11, 7, 'NO', 1, 0, 'C', true);
$pdf->Cell(25, 7, 'NO INVOICE', 1, 0, 'C', true);
$pdf->Cell(22, 7, 'TANGGAL', 1, 0, 'C', true);
$pdf->Cell(18, 7, 'JAM', 1, 0, 'C', true);
$pdf->Cell(15, 7, 'SHIF', 1, 0, 'C', true);
$pdf->Cell(30, 7, 'KASIR', 1, 0, 'C', true);
$pdf->Cell(55, 7, 'NAMA PRODUK', 1, 0, 'C', true);
$pdf->Cell(30, 7, 'KATEGORI', 1, 0, 'C', true);
$pdf->Cell(18, 7, 'JUMLAH', 1, 0, 'C', true);
$pdf->Cell(18, 7, 'TOTAL', 1, 0, 'C', true);
$pdf->Cell(18, 7, 'MODAL', 1, 0, 'C', true);
$pdf->Cell(18, 7, 'LABA', 1, 0, 'C', true);

$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Arial', '', 10);

if ($ksr == 'Belum Pilih Kasir') {

$no = 1;
$data = mysqli_query($koneksi, "SELECT invoice_nomor,invoice_tanggal,invoice_waktu,invoice_pelanggan,kasir_nama,produk_nama,kategori,transaksi_jumlah,produk_harga_jual,produk_harga_modal from invoice,kasir,produk,kategori,transaksi where invoice_id=transaksi_invoice and transaksi_produk=produk_id and produk_kategori=kategori_id and invoice_kasir=kasir_id and date(invoice_tanggal) = '$tgl_dari'");
while ($d = mysqli_fetch_array($data)) {
        $pdf->Cell(11, 6, $no++, 1, 0, 'C');
        $pdf->Cell(25, 6, $d['invoice_nomor'], 1, 0, 'C');
        $pdf->Cell(22, 6, $d['invoice_tanggal'], 1, 0, 'C');
        $pdf->Cell(18, 6, $d['invoice_waktu'], 1, 0, 'C');
        $pdf->Cell(15, 6, $d['invoice_pelanggan'], 1, 0, 'C');
        $pdf->Cell(30, 6, $d['kasir_nama'], 1, 0, 'C');
        $pdf->Cell(55, 6, $d['produk_nama'], 1, 0, 'L');
        $pdf->Cell(30, 6, $d['kategori'], 1, 0, 'C');
        $pdf->Cell(18, 6, $d['transaksi_jumlah'], 1, 0, 'C');
        $pdf->Cell(18, 6, number_format($d['transaksi_jumlah'] * $d['produk_harga_jual']), 1, 0, 'R');
        $pdf->Cell(18, 6, number_format($d['transaksi_jumlah'] * $d['produk_harga_modal']), 1, 0, 'R');
        $pdf->Cell(18, 6, number_format($d['transaksi_jumlah'] * $d['produk_harga_jual'] - $d['transaksi_jumlah'] * $d['produk_harga_modal']), 1, 0, 'R');

        $pdf->Cell(10, 6, '', 0, 1);
    }
} else {
    $no = 1;
    $data = mysqli_query($koneksi, "SELECT invoice_nomor,invoice_tanggal,invoice_waktu,invoice_pelanggan,kasir_nama,produk_nama,kategori,transaksi_jumlah,produk_harga_jual,produk_harga_modal from invoice,kasir,produk,kategori,transaksi where invoice_id=transaksi_invoice and transaksi_produk=produk_id and produk_kategori=kategori_id and invoice_kasir=kasir_id and date(invoice_tanggal) = '$tgl_dari' and kasir_nama = '$ksr'");
    while ($d = mysqli_fetch_array($data)) {
        $pdf->Cell(11, 6, $no++, 1, 0, 'C');
        $pdf->Cell(25, 6, $d['invoice_nomor'], 1, 0, 'C');
        $pdf->Cell(22, 6, $d['invoice_tanggal'], 1, 0, 'C');
        $pdf->Cell(18, 6, $d['invoice_waktu'], 1, 0, 'C');
        $pdf->Cell(15, 6, $d['invoice_pelanggan'], 1, 0, 'C');
        $pdf->Cell(30, 6, $d['kasir_nama'], 1, 0, 'C');
        $pdf->Cell(55, 6, $d['produk_nama'], 1, 0, 'L');
        $pdf->Cell(30, 6, $d['kategori'], 1, 0, 'C');
        $pdf->Cell(18, 6, $d['transaksi_jumlah'], 1, 0, 'C');
        $pdf->Cell(18, 6, number_format($d['transaksi_jumlah'] * $d['produk_harga_jual']), 1, 0, 'R');
        $pdf->Cell(18, 6, number_format($d['transaksi_jumlah'] * $d['produk_harga_modal']), 1, 0, 'R');
        $pdf->Cell(18, 6, number_format($d['transaksi_jumlah'] * $d['produk_harga_jual'] - $d['transaksi_jumlah'] * $d['produk_harga_modal']), 1, 0, 'R');

        $pdf->Cell(10, 6, '', 0, 1);
    }
}

$pdf->Output();
