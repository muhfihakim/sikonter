<!-- form_tambah_pelanggan.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Form Tambah Pelanggan</title>
</head>

<body>
    <h2>Form Tambah Pelanggan</h2>
    <?php
    include '../koneksi.php';

    // Fungsi untuk menyimpan data pelanggan
    function simpanDataPelanggan($koneksi)
    {
        $jenis_pelanggan = $_POST['jenis_pelanggan'];
        $nama_pelanggan = $_POST['nama_pelanggan'];
        $no_pelanggan = $_POST['no_pelanggan'];
        $no_hp = $_POST['no_hp'];
        $alamat = $_POST['alamat'];

        // Pengecekan apakah data sudah ada di database
        $query_cek = "SELECT * FROM daftar_pelanggan WHERE nama = '$nama_pelanggan'";
        $result_cek = mysqli_query($koneksi, $query_cek);

        if (mysqli_num_rows($result_cek) > 0) {
            echo "<script>alert('Data sudah tersedia di database.');</script>";
        } else {
            // Simpan data jika belum ada di database
            $query = "INSERT INTO daftar_pelanggan (jenis, nama, no_pelanggan, no_hp, alamat)
                      VALUES ('$jenis_pelanggan', '$nama_pelanggan', '$no_pelanggan', '$no_hp', '$alamat')";
            $result = mysqli_query($koneksi, $query);

            if ($result) {
                echo "<script>alert('Data pelanggan berhasil disimpan.');</script>";
            } else {
                echo "<script>alert('Terjadi kesalahan saat menyimpan data pelanggan: " . mysqli_error($koneksi) . "');</script>";
            }
        }
    }

    // Memeriksa apakah tombol Submit telah diklik
    if (isset($_POST['submit'])) {
        simpanDataPelanggan($koneksi);
    }
    ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="jenis_pelanggan">Jenis Pelanggan:</label>
        <select name="jenis_pelanggan" id="jenis_pelanggan">
            <?php
            // Mengambil jenis pelanggan dari database
            $query = "SELECT * FROM jenis_pelanggan";
            $result = mysqli_query($koneksi, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row['jenis'] . '">' . $row['jenis'] . '</option>';
            }
            ?>
        </select>
        <br><br>
        <label for="nama_pelanggan">Nama Pelanggan:</label>
        <input type="text" name="nama_pelanggan" id="nama_pelanggan">
        <br><br>
        <label for="no_pelanggan">No Pelanggan/ID/IDPEL:</label>
        <input type="text" name="no_pelanggan" id="no_pelanggan">
        <br><br>
        <label for="no_hp">No HP:</label>
        <input type="text" name="no_hp" id="no_hp">
        <br><br>
        <label for="alamat">Alamat:</label>
        <textarea name="alamat" id="alamat"></textarea>
        <br><br>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>

</html>