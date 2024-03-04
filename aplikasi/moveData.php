<?php
// Menghubungkan ke database
require_once 'koneksi.php';

// Mendapatkan ID item yang akan dipindahkan
$id = $_POST['id'];

// Mendapatkan data item yang akan dipindahkan
$sql = "SELECT waktu, jenis_produk, nama_produk, nominal_produk, harga_produk, keuntungan, no_tujuan FROM transaksi_masuk WHERE id = '$id'";
$result = mysqli_query($koneksi, $sql);
$row = mysqli_fetch_assoc($result);

$waktu = $row['waktu'];
$jenis_produk = $row['jenis_produk'];
$nama_produk = $row['nama_produk'];
$nominal_produk = $row['nominal_produk'];
$harga_produk = $row['harga_produk'];
$keuntungan = $row['keuntungan'];
$no_tujuan = $row['no_tujuan'];

// Memasukkan data item ke tabel transaksi_keluar
$sql = "INSERT INTO transaksi_keluar (waktu, jenis_produk, nama_produk, nominal_produk, harga_produk, keuntungan, no_tujuan) VALUES ('$waktu', '$jenis_produk', '$nama_produk', '$nominal_produk', '$harga_produk', '$keuntungan', '$no_tujuan')";
if (mysqli_query($koneksi, $sql)) {
    // Menghapus item dari tabel transaksi_masuk
    $sql = "DELETE FROM transaksi_masuk WHERE id = '$id'";
    if (mysqli_query($koneksi, $sql)) {
        echo "Data berhasil dipindahkan.";
    } else {
        echo "Terjadi kesalahan saat menghapus data: " . mysqli_error($koneksi);
    }
} else {
    echo "Terjadi kesalahan saat memindahkan data: " . mysqli_error($koneksi);
}

// Menutup koneksi database
mysqli_close($koneksi);
