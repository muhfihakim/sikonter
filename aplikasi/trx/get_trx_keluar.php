<?php
// Menggunakan file koneksi.php
include '../koneksi.php';

// Mengambil data dari tabel transaksi_keluar
$query = "SELECT waktu, nama_produk, nominal_produk, harga_produk, keuntungan, no_tujuan FROM transaksi_keluar";
$result = mysqli_query($koneksi, $query);

// Menyusun data dalam format JSON
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Mengembalikan data dalam format JSON
echo json_encode(array('data' => $data));

// Menutup koneksi database
mysqli_close($koneksi);
