<?php
$koneksi = mysqli_connect("localhost","hakimbet_llcell", "llcell", "hakimbet_llcell");

// Cek Koneksi
if(mysqli_connect_errno()){
    echo "Koneksi Database Gagal : " . mysqli_connect_errno();
}

?>