<?php
include '../koneksi.php';

// Mengambil data dari tabel daftar_produk
$query = "SELECT jenis, nama, nominal, harga, modal FROM daftar_produk";
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
