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
    <title>SIKONTER | Lap. Transaksi</title>
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
                        <!-- Notifications: style can be found in dropdown.less -->
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
                        <!-- Control Sidebar Toggle Button -->

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
            <!-- Main content -->
            <section class="content">
                <!-- =========================================================== -->

                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <?php
                            // Include file koneksi.php
                            include '../koneksi.php';

                            // Query untuk menghitung total data transaksi keluar per bulan ini
                            $query = "SELECT COUNT(*) AS total_transaksi FROM transaksi_masuk WHERE MONTH(waktu) = MONTH(CURRENT_DATE())";

                            $result = $koneksi->query($query);

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $total_transaksi = $row["total_transaksi"];
                            } else {
                                echo "Data tidak ditemukan";
                            }

                            // Menutup koneksi ke database (jika menggunakan file koneksi.php)
                            $koneksi->close();
                            ?>

                            <div class="inner">
                                <h4><strong><?php echo $total_transaksi ?></strong></h4>

                                <p>Trx Masuk Bulan Ini</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                Lebih Lanjut <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <?php
                            // Include file koneksi.php
                            include '../koneksi.php';

                            // Query untuk menghitung total data transaksi keluar per bulan ini
                            $query = "SELECT COUNT(*) AS total_transaksi FROM transaksi_keluar WHERE MONTH(waktu) = MONTH(CURRENT_DATE())";

                            $result = $koneksi->query($query);

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $total_transaksi = $row["total_transaksi"];
                            } else {
                                echo "Data tidak ditemukan";
                            }

                            // Menutup koneksi ke database (jika menggunakan file koneksi.php)
                            $koneksi->close();
                            ?>

                            <div class="inner">
                                <h4><strong><?php echo $total_transaksi ?></strong></h4>

                                <p>Trx Keluar Bulan Ini</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                Lebih Lanjut <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <?php
                            // Include file koneksi.php
                            include '../koneksi.php';

                            // Query untuk menghitung total keuntungan bulan ini
                            $query = "SELECT SUM(keuntungan) AS total_keuntungan FROM transaksi_keluar WHERE DATE(waktu) = CURDATE()";

                            $result = $koneksi->query($query);

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $total_keuntungan = $row["total_keuntungan"];
                            } else {
                                echo "Data tidak ditemukan";
                            }

                            // Menutup koneksi ke database (jika menggunakan file koneksi.php)
                            $koneksi->close();
                            ?>
                            <div class="inner">
                                <h4><strong>Rp<?php echo $total_keuntungan ?></strong></h4>

                                <p>Keuntungan Hari Ini</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                Lebih Lanjut <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <?php
                            // Include file koneksi.php
                            include '../koneksi.php';

                            // Query untuk menghitung total keuntungan bulan ini
                            $query = "SELECT SUM(keuntungan) AS total_keuntungan FROM transaksi_keluar WHERE MONTH(waktu) = MONTH(CURRENT_DATE())";

                            $result = $koneksi->query($query);

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $total_keuntungan = $row["total_keuntungan"];
                            } else {
                                echo "Data tidak ditemukan";
                            }

                            // Menutup koneksi ke database (jika menggunakan file koneksi.php)
                            $koneksi->close();
                            ?>

                            <div class="inner">
                                <h4><strong>Rp<?php echo $total_keuntungan ?></strong></h4>
                                <p>Keuntungan Bulan Ini</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                Lebih Lanjut <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->

                <!-- =========================================================== -->
            </section>
            <!-- /.content -->
        </div>
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
    <!-- page script -->
</body>

</html>