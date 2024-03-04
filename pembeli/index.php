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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">


</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <?php
                    include '../aplikasi/koneksi.php';

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
                                    <h3 class="mb-4">Checkout!</h3>
                                </div>
                                <div class="w-100">

                                </div>
                            </div>
                            <div>
                                <form method="POST" action="">
                                    <div class="form-group">
                                        <label class="label" for="jenis">Jenis</label>
                                        <select class="form-select" aria-label="Default select example" name="jenis" id="jenis">
                                            <option value="">Pilih Jenis</option>
                                            <!-- Populate jenis options using data from database -->
                                            <?php
                                            include '../aplikasi/koneksi.php';
                                            $query = "SELECT DISTINCT jenis FROM daftar_produk";
                                            $result = mysqli_query($koneksi, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='" . $row['jenis'] . "'>" . $row['jenis'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="label" for="nama">Nama Produk</label>
                                        <select class="form-select" aria-label="Default select example" name="nama" id="nama">
                                            <option value="">Pilih Nama Produk</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="label" for="nominal">Nominal Produk</label>
                                        <select class="form-select" aria-label="Default select example" name="nominal" id="nominal">
                                            <option value="">Pilih Nominal Produk</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="label" for="harga">Harga Produk</label>
                                        <input class="form-control" type="text" name="harga" id="harga" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label class="label" for="no_tujuan">No Tujuan / ID</label>
                                        <input type="number" class="form-control" placeholder="Pastikan Diisi Dengan Benar" name="no_tujuan" id="no_tujuan">
                                    </div>
                                    </input>
                                    <div class="form-group">
                                        <button type="submit" class="form-control btn btn-primary rounded submit px-3" name="submit">Pesan!</button>

                                        <?php
                                        // koneksi ke database
                                        include '../aplikasi/koneksi.php';

                                        // memeriksa apakah tombol submit sudah ditekan
                                        if (isset($_POST['submit'])) {
                                            // mengambil nilai dari form
                                            $jenis_produk = $_POST['jenis'];
                                            $nama_produk = $_POST['nama'];
                                            $nominal_produk = $_POST['nominal'];
                                            $harga_produk = $_POST['harga'];
                                            $no_tujuan = $_POST['no_tujuan'];

                                            // query untuk mendapatkan harga dan modal dari daftar_produk berdasarkan nama_produk
                                            $query = "SELECT harga, modal FROM daftar_produk WHERE nama = '$nama_produk'";
                                            $result = mysqli_query($koneksi, $query);
                                            $row = mysqli_fetch_assoc($result);
                                            $harga = $row['harga'];
                                            $modal = $row['modal'];

                                            // menghitung keuntungan
                                            $keuntungan = $harga - $modal;

                                            // menyiapkan query untuk memasukkan data ke dalam tabel transaksi_masuk
                                            $query_insert = "INSERT INTO transaksi_masuk (jenis_produk, nama_produk, nominal_produk, harga_produk, keuntungan, no_tujuan)
                     VALUES ('$jenis_produk', '$nama_produk', '$nominal_produk', '$harga_produk', '$keuntungan', '$no_tujuan')";

                                            // mengeksekusi query dan memeriksa apakah data berhasil dimasukkan ke dalam tabel
                                            if (mysqli_query($koneksi, $query_insert)) {
                                                echo '<script>alert("Pesanan Anda sedang diproses oleh Admin :).")</script>';
                                            } else {
                                                echo "Error: " . $query_insert . "<br>" . mysqli_error($koneksi);
                                            }
                                        }

                                        mysqli_close($koneksi);
                                        ?>


                                    </div>
                                    <div class="form-group d-md-flex">
                                        <div class="w-50 text-left">
                                            <label class="checkbox-wrap checkbox-primary mb-0">Pastikan Untuk Mengisi No/ID/Tujuan Dengan Benar!
                                                <input type="checkbox" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </form>
                                <p class="text-center">Ada Masalah? <a href="https://www.instagram.com/luthfikim_">Hubungi Developer</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#jenis').change(function() {
            var jenisProduk = $(this).val();

            // Mengosongkan pilihan Nama Produk dan Nominal
            $('#nama').empty().attr('disabled', true);
            $('#nominal').empty().attr('disabled', true);
            $('#harga').val('');

            if (jenisProduk !== '') {
                // Mengambil data Nama Produk berdasarkan jenis_produk yang dipilih menggunakan AJAX
                $.ajax({
                    url: 'get_nama_produk.php',
                    type: 'post',
                    data: {
                        jenis_produk: jenisProduk
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Mengisi pilihan Nama Produk dengan hasil dari AJAX
                        $('#nama').append('<option value="">Pilih Nama Produk</option>');
                        $.each(response, function(key, value) {
                            $('#nama').append('<option value="' + value + '">' + value + '</option>');
                        });
                        $('#nama').removeAttr('disabled');
                    }
                });
            }
        });

        $('#nama').change(function() {
            var namaProduk = $(this).val();

            // Mengosongkan pilihan Nominal
            $('#nominal').empty().attr('disabled', true);
            $('#harga').val('');

            if (namaProduk !== '') {
                // Mengambil data Nominal berdasarkan nama_produk yang dipilih menggunakan AJAX
                $.ajax({
                    url: 'get_nominal.php',
                    type: 'post',
                    data: {
                        nama_produk: namaProduk
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Mengisi pilihan Nominal dengan hasil dari AJAX
                        $('#nominal').append('<option value="">Pilih Nominal</option>');
                        $.each(response, function(key, value) {
                            $('#nominal').append('<option value="' + value.nominal + '">' + value.nominal + '</option>');
                        });
                        $('#nominal').removeAttr('disabled');
                    }
                });
            }
        });

        $('#nominal').change(function() {
            var nominalProduk = $(this).val();

            // Mengosongkan nilai harga
            $('#harga').val('');

            if (nominalProduk !== '') {
                // Mengambil data harga berdasarkan nominal yang dipilih menggunakan AJAX
                $.ajax({
                    url: 'get_harga.php',
                    type: 'post',
                    data: {
                        nominal: nominalProduk
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.length > 0) {
                            var hargaProduk = response[0].harga;
                            $('#harga').val(hargaProduk);
                        }
                    }
                });
            }
        });
    });
</script>

</html>