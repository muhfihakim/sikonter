<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "hakimbet_llcell", "llcell", "hakimbet_llcell");

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Gagal terhubung ke MySQL: " . mysqli_connect_error();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $namaProduk = $_POST['nama_produk'];

    // Query untuk mendapatkan nominal dan harga berdasarkan nama_produk yang dipilih
    $query = "SELECT nominal, harga FROM daftar_produk WHERE nama = '$namaProduk'";
    $result = mysqli_query($koneksi, $query);

    $nominalProduk = array();

    // Menyimpan hasil query dalam bentuk array
    while ($row = mysqli_fetch_assoc($result)) {
        $nominalProduk[] = $row;
    }

    // Mengembalikan data dalam format JSON
    echo json_encode($nominalProduk);
}

// Tutup koneksi
mysqli_close($koneksi);
