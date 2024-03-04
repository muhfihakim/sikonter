<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $namaProduk = $_POST['nama'];

    // Query database untuk mendapatkan data nominal dan harga produk
    $query = "SELECT nominal, harga FROM daftar_produk WHERE nama = '$namaProduk'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Menyusun data dalam bentuk array
            $data = array(
                'nominal' => $row['nominal'],
                'harga' => $row['harga']
            );

            // Mengembalikan data dalam bentuk JSON
            echo json_encode($data);
        } else {
            // Jika tidak ada data yang cocok, mengembalikan pesan kosong
            echo '';
        }
    } else {
        // Jika terjadi error dalam eksekusi query, mengembalikan pesan kosong
        echo '';
    }
}
