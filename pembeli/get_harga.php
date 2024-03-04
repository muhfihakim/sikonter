<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "hakimbet_llcell", "llcell", "hakimbet_llcell");

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Gagal terhubung ke MySQL: " . mysqli_connect_error();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nominalProduk = $_POST['nominal'];

    // Query untuk mendapatkan harga berdasarkan nominal yang dipilih
    $query = "SELECT harga FROM daftar_produk WHERE nominal = '$nominalProduk'";
    $result = mysqli_query($koneksi, $query);

    $hargaProduk = array();

    // Menyimpan hasil query dalam bentuk array
    while ($row = mysqli_fetch_assoc($result)) {
        $hargaProduk[] = $row;
    }

    // Mengembalikan data dalam format JSON
    echo json_encode($hargaProduk);
}

// Tutup koneksi
mysqli_close($koneksi);
