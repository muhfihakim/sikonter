<?php
// Menghubungkan ke database
require_once 'koneksi.php';

// Mengambil data dari tabel transaksi_masuk dan mengurutkannya berdasarkan waktu terbaru
$sql = "SELECT waktu, jenis_produk, nama_produk, nominal_produk, harga_produk, keuntungan, no_tujuan, id FROM transaksi_keluar ORDER BY waktu DESC";
$result = mysqli_query($koneksi, $sql);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Mengembalikan data dalam format JSON
echo json_encode($data);

// Menutup koneksi database
mysqli_close($koneksi);
