<?php
// Ambil nilai harga produk dan modal dari data yang dikirim melalui AJAX
$hargaProduk = $_POST['hargaProduk'];
$modal = $_POST['modal'];

// Hitung keuntungan
$keuntungan = ($hargaProduk - $modal);

// Mengembalikan nilai keuntungan sebagai respons AJAX
echo $keuntungan;
