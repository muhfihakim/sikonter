
    <?php
    include('../koneksi.php');
    $id = $_GET['id_produk'];
    $jenis = $_GET['jenis_produk'];
    $nama = $_GET['nama_produk'];
    $nominal = $_GET['nominal_produk'];
    $harga = $_GET['harga_produk'];
    $modal = $_GET['modal_produk'];
    //query update
    $query = "UPDATE daftar_produk SET jenis='$jenis', nama='$nama', nominal='$nominal', harga='$harga', modal='$modal' WHERE id='$id'";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Produk Berhasil Diubah!');
                window.location.href = 'daftar_produk.php';
              </script>";
    } else {
        echo "ERROR, data gagal diupdate" . mysqli_error($koneksi);
    }
    ?>
