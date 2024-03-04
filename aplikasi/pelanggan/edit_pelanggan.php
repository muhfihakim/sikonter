<?php
// Menggunakan include untuk menghubungkan file koneksi.php
include '../koneksi.php';

// Periksa apakah ada data yang dikirim melalui metode GET
if (isset($_GET['id_pelanggan'])) {
    // Tangkap nilai ID pelanggan dari parameter GET
    $idPelanggan = $_GET['id_pelanggan'];

    // Tangkap nilai-nilai form yang dikirimkan
    $jenisPelanggan = $_GET['jenis_pelanggan'];
    $namaPelanggan = $_GET['nama_pelanggan'];
    $noPelanggan = $_GET['no_pelanggan'];
    $noHp = $_GET['no_hp'];
    $alamat = $_GET['alamat'];

    // Query untuk mengupdate data pelanggan berdasarkan ID
    $query = "UPDATE daftar_pelanggan SET jenis='$jenisPelanggan', nama='$namaPelanggan', no_pelanggan='$noPelanggan', no_hp='$noHp', alamat='$alamat' WHERE id='$idPelanggan'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Jika update berhasil, redirect ke halaman daftar_pelanggan.php dengan pesan sukses
        echo "<script>alert('Data Pelanggan Berhasil Diubah!');</script>";
        echo "<script>window.location.href = 'daftar_pelanggan.php';</script>";
        exit();
    } else {
        // Jika update gagal, tampilkan pesan error atau redirect ke halaman lain
        echo "Gagal mengupdate data pelanggan.";
    }
} else {
    // Jika tidak ada ID pelanggan, redirect ke halaman lain atau tampilkan pesan error
    echo "ID pelanggan tidak ditemukan.";
}
