# **🌿Sistem Informasi Konter🌿**

👨‍💻 M. L. Hakim
🌏 PHP Native
🍍 Subang - Jabar | 
Instagram : [/@luthfikim](https://www.instagram.com/luthfikim_/)
YouTube : [/@nexted](https://www.youtube.com/@nexted23)


# Konfigurasi Aplikasi

## Deskripsi

Repositori ini berisi file konfigurasi database yang digunakan dalam aplikasi ini. File `koneksi.php` digunakan untuk menghubungkan aplikasi dengan database yang diperlukan untuk menjalankan fungsi-fungsi tertentu.

## Daftar Berkas Konfigurasi

- `/aplikasi/koneksi.php`: Berkas konfigurasi database aplikasi.

## Penggunaan

Sebelum menjalankan atau menggunakan aplikasi ini, pastikan Anda telah mengkonfigurasi berkas `koneksi.php` dengan benar. Berikut adalah langkah-langkah yang perlu Anda lakukan:

1. Buka berkas `/admin/koneksi.php` untuk konfigurasi.
3. Sesuaikan informasi koneksi database, seperti host, nama pengguna, kata sandi, dan nama database.
4. Simpan perubahan yang telah Anda buat.

## Contoh Konfigurasi

Berikut adalah contoh sederhana konfigurasi dalam berkas `koneksi.php`:

```php
<?php
$koneksi = mysqli_connect("localhost","username", "password", "nama_database");

// Cek Koneksi
if(mysqli_connect_errno()){
    echo "Koneksi Database Gagal : " . mysqli_connect_errno();
}

?>

