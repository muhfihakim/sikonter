<?php
session_start();
$timeout = 360; // Setting timeout dalam menit
if ($_SESSION['status'] != "login") {
    header("location:../index.php?pesan=belum_login");
}
$timeout = $timeout * 60; // menit ke detik
if (isset($_SESSION['start_session'])) {
    $elapsed_time = time() - $_SESSION['start_session'];
    if ($elapsed_time >= $timeout) {
        session_destroy();
        echo "<script type='text/javascript'>alert('Sesi telah berakhir');window.location='../index.php'</script>";
    }
}
$_SESSION['start_session'] = time();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIKONTER | Daftar Produk</title>
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- DataTables Auto Reload -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
</head>

<body class="hold-transition skin-yellow sidebar-mini">
    <div class="wrapper">
        <header class="main-header">

            <!-- Logo -->
            <a href="../index.php" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>L</b>L</span>
                <!-- logo for regular state and mobile devices -->
                <?php
                include '../koneksi.php';

                $query = "SELECT * FROM toko";
                $hasil = mysqli_query($koneksi, $query);
                $toko = mysqli_fetch_assoc($hasil);
                ?>

                <span class="logo-lg"><b><?php echo $toko['nama_toko']; ?></b></span>
            </a>

            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li>
                            <a>Selamat Datang</a>
                        </li>
                        <!-- Tasks: style can be found in dropdown.less -->
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="../dist/img/sikonter.jpg" class="user-image" alt="User Image">
                                <?php
                                session_start();
                                // Koneksi ke database
                                include '../koneksi.php';
                                // Mengambil data user yang sedang login
                                $username = $_SESSION['username'];
                                $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
                                $user = mysqli_fetch_array($query);
                                ?>
                                <span class="hidden-xs"><?php echo $user['nama']; ?></span>
                            </a>
                        </li>
                        <li class="dropdown notifications-menu">
                            <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#logoutModal">
                                <i class="glyphicon glyphicon-log-out"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="../dist/img/sikonter.jpg" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <?php
                        session_start();
                        // Koneksi ke database
                        include '../koneksi.php';
                        // Mengambil data user yang sedang login
                        $username = $_SESSION['username'];
                        $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
                        $user = mysqli_fetch_array($query);
                        ?>
                        <!-- Menampilkan nama lengkap sidebar -->
                        <p><?php echo $user['nama']; ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $user['jabatan']; ?></a>
                    </div>
                </div>
                <!-- search form -->
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MENU UTAMA</li>
                    <li>
                        <a href="../index.php">
                            <i class="fa fa-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="../pelanggan/daftar_pelanggan.php">
                            <i class="fa fa-users"></i>
                            <span>Pelanggan</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-inbox"></i>
                            <span>Produk</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="../produk/tambahjenis_produk.php"><i class="fa fa-plus-square"></i> Tambah Jenis</a></li>
                            <li><a href="../produk/daftar_produk.php"><i class="fa fa-list-alt"></i> Daftar Produk</a></li>
                        </ul>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-server"></i>
                            <span>Transaksi</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="../trx/trx_masuk.php"><i class="fa fa-download"></i> Trx Masuk</a></li>
                            <li><a href="../trx/trx_keluar.php"><i class="fa fa-upload"></i> Trx Keluar</a></li>
                        </ul>
                    </li>
                    <li class="header">LAPORAN</li>
                    <li><a href="../laptrx/"><i class="fa fa-bar-chart"></i><span> Lap. Transaksi</span></a></li>
                    <li class="header">MANAJEMEN</li>
                    <li><a href="../manajemen/toko.php"><i class="fa fa-gears"></i><span> Pengaturan Toko</span></a></li>
                    <li><a href="#"><i class="fa fa-users"></i><span> User Manager </span><span class="label label-danger">COMING</span></a></li>
                    <li><a href="../manajemen/infoaplikasi.php"><i class="fa fa-info-circle"></i><span> Informasi Aplikasi</span></a></li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?php echo $toko['nama_toko']; ?>
                    <br>
                    <small><?php echo $toko['alamat_toko']; ?></small>
                </h1>
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- TABLE: LATEST ORDERS -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><strong>Daftar Produk | </strong></h3>
                        <!-- Tombol Tambah Produk -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">
                            <i class="fa fa-plus-square"></i> Tambah Produk
                        </button>

                        <!-- Modal Tambah Produk -->
                        <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="tambahModalLabel"><strong>Tambah Produk</strong></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <div class="form-group">
                                                <label for="jenisProduk">Jenis Produk:</label>
                                                <select class="form-control" id="jenisProduk" name="jenisProduk">
                                                    <?php
                                                    // Query untuk mengambil data dari tabel jenis_produk
                                                    $jenisProdukQuery = "SELECT * FROM jenis_produk";
                                                    $jenisProdukResult = mysqli_query($koneksi, $jenisProdukQuery);

                                                    while ($jenisProduk = mysqli_fetch_assoc($jenisProdukResult)) {
                                                        echo "<option value='" . $jenisProduk['jenis'] . "'>" . $jenisProduk['jenis'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="namaProduk">Nama Produk:</label>
                                                <input type="text" class="form-control" id="namaProduk" name="namaProduk">
                                            </div>
                                            <div class="form-group">
                                                <label for="nominalProduk">Nominal Produk:</label>
                                                <input type="text" class="form-control" id="nominalProduk" name="nominalProduk">
                                            </div>
                                            <div class="form-group">
                                                <label for="hargaProduk">Harga Produk:</label>
                                                <input type="text" class="form-control" id="hargaProduk" name="hargaProduk">
                                            </div>
                                            <div class="form-group">
                                                <label for="modal">Modal:</label>
                                                <input type="text" class="form-control" id="modal" name="modal">
                                            </div>
                                            <div class="form-group">
                                                <label for="keuntungan">Keuntungan:</label>
                                                <input type="text" class="form-control" id="keuntungan" name="keuntungan" readonly>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" name="tambahProduk">Simpan</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                            </div>
                                        </form>
                                    </div>
                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                    <script>
                                        // Menggunakan AJAX untuk mengisi keuntungan secara otomatis
                                        $(document).ready(function() {
                                            function hitungKeuntungan() {
                                                const hargaProduk = parseFloat($('#hargaProduk').val()) || 0;
                                                const modal = parseFloat($('#modal').val()) || 0;

                                                $.ajax({
                                                    url: 'hitung_keuntungan.php', // Ubah dengan URL yang sesuai untuk menghitung keuntungan di sisi server
                                                    method: 'POST',
                                                    data: {
                                                        hargaProduk: hargaProduk,
                                                        modal: modal
                                                    },
                                                    success: function(response) {
                                                        $('#keuntungan').val(response);
                                                    }
                                                });
                                            }

                                            // Panggil fungsi hitungKeuntungan saat halaman pertama kali dimuat
                                            hitungKeuntungan();

                                            // Panggil fungsi hitungKeuntungan setiap 1 detik
                                            setInterval(hitungKeuntungan, 500);
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (isset($_POST['tambahProduk'])) {
                            // Ambil data dari form
                            $jenisProduk = $_POST['jenisProduk'];
                            $namaProduk = $_POST['namaProduk'];
                            $nominalProduk = $_POST['nominalProduk'];
                            $hargaProduk = $_POST['hargaProduk'];
                            $modal = $_POST['modal'];
                            $keuntungan = $_POST['keuntungan'];

                            // Proses penyimpanan data ke database
                            $queryTambahProduk = "INSERT INTO daftar_produk (jenis, nama, nominal, harga, modal, keuntungan) VALUES (?, ?, ?, ?, ?, ?)";
                            $stmtTambahProduk = mysqli_prepare($koneksi, $queryTambahProduk);
                            mysqli_stmt_bind_param($stmtTambahProduk, "ssssss", $jenisProduk, $namaProduk, $nominalProduk, $hargaProduk, $modal, $keuntungan);
                            $resultTambahProduk = mysqli_stmt_execute($stmtTambahProduk);

                            if ($resultTambahProduk) {
                                // Jika tambah produk berhasil, tampilkan alert dan refresh halaman
                                echo "<script>alert('Data Produk berhasil ditambahkan.')</script>";
                                echo "<meta http-equiv='refresh' content='0'>";
                            } else {
                                // Jika tambah produk gagal, tampilkan pesan error
                                echo "<script>alert('Gagal menambahkan data Produk.')</script>";
                            }
                        }
                        ?>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                        </div>
                        <!-- Modal Konfirmasi Logout -->
                        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="logoutModalLabel"><strong>Konfirmasi Logout</strong></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Anda yakin ingin logout?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <a href="../../logout.php" class="btn btn-danger"><i class="glyphicon glyphicon-log-out"></i> Logout!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        // Include file koneksi.php
                        include '../koneksi.php';
                        ?>
                        <div class="table-responsive">
                            <table id="daftar_produk_table" class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center; width: 3%;">No</th>
                                        <th style="text-align: center; width: 6%;">Jenis</th>
                                        <th style="text-align: center; width: 8%;">Nama</th>
                                        <th style="text-align: center; width: 6%;">Nominal</th>
                                        <th style="text-align: center; width: 4%;">Harga</th>
                                        <th style="text-align: center; width: 4%;">Modal</th>
                                        <th style="text-align: center; width: 4%;">Keuntungan</th>
                                        <th style="text-align: center; width: 4%;">Trkhr Update</th>
                                        <th style="text-align: center; width: 3%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM daftar_produk");
                                    $no = 1;
                                    while ($produk = mysqli_fetch_assoc($query)) {
                                        $keuntungan = $produk['harga'] - $produk['modal'];
                                    ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $no++; ?></td>
                                            <td style="text-align: center;"><?php echo $produk['jenis']; ?></td>
                                            <td style="text-align: center;"><?php echo $produk['nama']; ?></td>
                                            <td style="text-align: center;"><?php echo $produk['nominal']; ?></td>
                                            <td style="text-align: center;"><?php echo 'Rp ' . number_format($produk['harga'], 0, ',', '.'); ?></td>
                                            <td style="text-align: center;"><?php echo 'Rp ' . number_format($produk['modal'], 0, ',', '.'); ?></td>
                                            <td style="text-align: center;"><?php echo 'Rp ' . number_format($keuntungan, 0, ',', '.'); ?></td>
                                            <td style="text-align: center;"><?php echo date('d-m-Y', strtotime($produk['waktu'])); ?></td>
                                            <td style="text-align: center;">
                                                <!-- Tombol Edit pada Tabel -->
                                                <a href="#" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal<?php echo $produk['id']; ?>">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <!-- Tombol Hapus pada Tabel -->
                                                <a href="#" type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal2<?php echo $produk['id']; ?>">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- Modal Edit Produk-->
                                        <div class="modal fade" id="myModal<?php echo $produk['id']; ?>" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title"><strong>Update Data Produk</strong></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form role="form" action="edit_produk.php" method="get">
                                                            <?php
                                                            $id = $produk['id'];
                                                            $query_edit = mysqli_query($koneksi, "SELECT * FROM daftar_produk WHERE id='$id'");
                                                            while ($row = mysqli_fetch_array($query_edit)) {
                                                            ?>
                                                                <input type="hidden" name="id_produk" value="<?php echo $row['id']; ?>">
                                                                <div class="form-group">
                                                                    <label>Jenis Produk</label>
                                                                    <input type="text" name="jenis_produk" class="form-control" value="<?php echo $row['jenis']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Nama Produk</label>
                                                                    <input type="text" name="nama_produk" class="form-control" value="<?php echo $row['nama']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Nominal Produk</label>
                                                                    <input type="text" name="nominal_produk" class="form-control" value="<?php echo $row['nominal']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Harga Produk</label>
                                                                    <input type="text" name="harga_produk" class="form-control" value="<?php echo $row['harga']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Modal Produk</label>
                                                                    <input type="text" name="modal_produk" class="form-control" value="<?php echo $row['modal']; ?>">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-success">Update</button>
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Konfirmasi Hapus -->
                                        <div class="modal fade" id="myModal2<?php echo $produk['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $produk['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel<?php echo $produk['id']; ?>"><strong>Konfirmasi Hapus</strong></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus produk ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <a href="hapus_produk.php?id=<?php echo $produk['id']; ?>" class="btn btn-danger">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                </div>
                <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <!-- /.box-footer -->
    </div>
    </div>
    <!-- /.col -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <?php
            include '../koneksi.php';
            $query = "SELECT * FROM aplikasi";
            $hasil = mysqli_query($koneksi, $query);
            $aplikasi = mysqli_fetch_assoc($hasil);
            ?>
            <b>Versi</b> <?php echo $aplikasi['versi']; ?>
        </div>
        <strong>Copyright &copy; <a><?php echo $toko['nama_toko']; ?></a>.</strong> All rights
        reserved.
    </footer>
    <!-- Control Sidebar -->
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
    <!-- jQuery 3 -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#daftar_produk_table').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                },
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Semua"]
                ],
                "pageLength": 25, // Jumlah entri yang ditampilkan secara default
                "order": [
                    [1, "desc"]
                ] // Mengurutkan berdasarkan kolom waktu secara menurun (terbaru)
            });
        });
    </script>
</body>

</html>