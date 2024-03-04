<?php
if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "gagal") {
        echo "<script> alert('Akun Yang Anda Masukkan Salah!'); </script>";
    } else if ($_GET['pesan'] == "logout") {
        echo "<script> alert('Anda Berhasil Logout'); </script>";
    } else if ($_GET['pesan'] == "belum_login") {
        echo "<script> alert('Anda Belum Login!'); </script>";
    }
}
?>

<!doctype html>

<html lang="en">

<head>
    <title>SIKONTER</title>
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <?php
                    include './aplikasi/koneksi.php';

                    $query = "SELECT * FROM toko";
                    $hasil = mysqli_query($koneksi, $query);
                    $toko = mysqli_fetch_assoc($hasil);
                    ?>
                    <h2 class="heading-section"><?php echo $toko['nama_toko']; ?></h2>
                    <div>Pulsa, Kuota, Voucher, Top-Up, PPOB dan Produk Digital Lainnya</div>
                    <script>
                        function display_time() {
                            var time = new Date();
                            var hours = time.getHours();
                            var minutes = time.getMinutes();
                            var seconds = time.getSeconds();
                            var ampm = hours >= 24 ? '' : '';
                            hours = hours % 24;
                            hours = hours ? hours : 24;
                            minutes = minutes < 10 ? '0' + minutes : minutes;
                            seconds = seconds < 10 ? '0' + seconds : seconds;
                            var currentTime = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
                            document.getElementById('time').innerHTML = currentTime;
                            setTimeout(display_time, 1000);
                        }
                    </script>
                    <small><?php echo $toko['alamat_toko']; ?></small>
                    <div id="time"></div>
                    <script>
                        display_time();
                    </script>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img" style="background-image: url(images/bg-1.png);">
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Login Aplikasi</h3>
                                </div>
                                <div class="w-100">
                                </div>
                            </div>
                            <form action="cek_login.php" class="signin-form" method="POST">
                                <div class="form-group mb-3">
                                    <label class="label" for="username">Username</label>
                                    <input type="text" class="form-control" placeholder="Username" name="username" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Password</label>
                                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3" name="submit">Login</button>
                                </div>
                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-left">
                                        <label class="checkbox-wrap checkbox-primary mb-0">Ingat Saya
                                            <input type="checkbox" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="w-50 text-md-right">
                                        <?php
                                        include './aplikasi/koneksi.php';
                                        $query = "SELECT * FROM aplikasi";
                                        $hasil = mysqli_query($koneksi, $query);
                                        $aplikasi = mysqli_fetch_assoc($hasil);
                                        ?>
                                        <a href="#">Versi <?php echo $aplikasi['versi']; ?></a>
                                    </div>
                                </div>
                            </form>
                            <p class="text-center">Bukan Member? <a href="https://www.instagram.com/luthfikim_">Hubungi Developer</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>