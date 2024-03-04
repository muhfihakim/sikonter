<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "hakimbet_llcell", "llcell", "hakimbet_llcell");

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Gagal terhubung ke MySQL: " . mysqli_connect_error();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jenisProduk = $_POST['jenis_produk'];

    // Query untuk mendapatkan daftar nama_produk berdasarkan jenis_produk yang dipilih
    $query = "SELECT DISTINCT nama FROM daftar_produk WHERE jenis = '$jenisProduk'";
    $result = mysqli_query($koneksi, $query);

    $namaProduk = array();

    // Menyimpan hasil query dalam bentuk array
    while ($row = mysqli_fetch_assoc($result)) {
        $namaProduk[] = $row['nama'];
    }

    // Mengembalikan data dalam format JSON
    echo json_encode($namaProduk);
}

// Tutup koneksi
mysqli_close($koneksi);
