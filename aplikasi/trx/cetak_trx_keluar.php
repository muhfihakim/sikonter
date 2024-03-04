<?php
// Konfigurasi koneksi database
include '../koneksi.php';

// Membuat koneksi ke database
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Memeriksa apakah parameter dari dan ke tanggal tersedia
if (isset($_GET['dari']) && isset($_GET['ke'])) {
    $dari = $_GET['dari'];
    $ke = $_GET['ke'];

    // Mengubah format tanggal ke format yang sesuai dengan database
    $dari = date('Y-m-d', strtotime($dari));
    $ke = date('Y-m-d', strtotime($ke));

    // Query untuk mengambil data transaksi keluar berdasarkan periode tanggal
    $query = "SELECT waktu, nominal_produk, harga_produk, keuntungan, no_tujuan FROM transaksi_keluar WHERE DATE(waktu) BETWEEN '$dari' AND '$ke' ORDER BY waktu ASC";
    $filename = 'Lap_Trx_Keluar_' . $dari . '_Ke_' . $ke . '.pdf'; // Nama file output

} else {
    // Jika parameter dari dan ke tanggal tidak tersedia, tampilkan semua data
    $query = "SELECT waktu, nominal_produk, harga_produk, keuntungan, no_tujuan FROM transaksi_keluar ORDER BY waktu ASC";
    $filename = 'Lap_Trx_Keluar_All.pdf'; // Nama file output
}

$result = mysqli_query($koneksi, $query);

// Memuat library TCPDF
require_once('tcpdf/tcpdf.php');

// Membuat objek TCPDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Set penomoran halaman
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Mengatur margin
$pdf->SetMargins(5, 8, 5);

// Menambahkan halaman
$pdf->AddPage();

// Judul halaman
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'Laporan Transaksi Keluar', 0, 1, 'C');

// Tabel header
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(40, 10, 'Waktu', 1, 0, 'C');
$pdf->Cell(40, 10, 'Nominal Produk', 1, 0, 'C');
$pdf->Cell(40, 10, 'Harga Produk', 1, 0, 'C');
$pdf->Cell(40, 10, 'Keuntungan', 1, 0, 'C');
$pdf->Cell(40, 10, 'No. Tujuan', 1, 1, 'C');

// Tampil data
$pdf->SetFont('helvetica', '', 10);
while ($row = mysqli_fetch_assoc($result)) {
    $waktu = $row['waktu'];
    $nominal_produk = $row['nominal_produk'];
    $harga_produk = formatCurrency($row['harga_produk']);
    $keuntungan = formatCurrency($row['keuntungan']);
    $no_tujuan = $row['no_tujuan'];

    $pdf->Cell(40, 7, $waktu, 1, 0, 'C');
    $pdf->Cell(40, 7, $nominal_produk, 1, 0, 'C');
    $pdf->Cell(40, 7, $harga_produk, 1, 0, 'C');
    $pdf->Cell(40, 7, $keuntungan, 1, 0, 'C');
    $pdf->Cell(40, 7, $no_tujuan, 1, 1, 'C');
}

// Fungsi untuk memformat angka menjadi mata uang Indonesia
function formatCurrency($amount)
{
    return 'Rp ' . number_format($amount, 0, ',', '.');
}

// Output file PDF
$pdf->Output($filename, 'I');

// Menutup koneksi database
mysqli_close($koneksi);
