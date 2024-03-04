<?php
include('../koneksi.php');

$id = $_GET['id'];

// Query hapus produk
$query = "DELETE FROM daftar_produk WHERE id='$id'";

if (mysqli_query($koneksi, $query)) {
    // Produk berhasil dihapus
    echo "<script>
            alert('Produk Berhasil Dihapus!');
            window.location.href = 'daftar_produk.php';
          </script>";
    exit();
} else {
    echo "ERROR, data gagal dihapus" . mysqli_error($koneksi);
}
