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
    <title>SIKONTER</title>
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
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
    <script src="bower_components/jquery/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
</head>

<body class="hold-transition skin-yellow sidebar-mini">
    <div class="wrapper">

        <header class="main-header">

            <!-- Logo -->
            <a href="index.php" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>L</b>L</span>
                <!-- logo for regular state and mobile devices -->
                <?php
                include 'koneksi.php';

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
                                <img src="dist/img/sikonter.jpg" class="user-image" alt="User Image">
                                <?php
                                session_start();

                                // Koneksi ke database
                                include 'koneksi.php';

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
                        <img src="dist/img/sikonter.jpg" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <?php
                        session_start();

                        // Koneksi ke database
                        include 'koneksi.php';

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
                        <a href="index.php">
                            <i class="fa fa-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="pelanggan/daftar_pelanggan.php">
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
                            <li><a href="produk/tambahjenis_produk.php"><i class="fa fa-plus-square"></i> Tambah Jenis</a></li>
                            <li><a href="produk/daftar_produk.php"><i class="fa fa-list-alt"></i> Daftar Produk</a></li>
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
                            <li><a href="trx/trx_masuk.php"><i class="fa fa-download"></i> Trx Masuk</a></li>
                            <li><a href="trx/trx_keluar.php"><i class="fa fa-upload"></i> Trx Keluar</a></li>
                        </ul>
                    </li>
                    <li class="header">LAPORAN</li>
                    <li><a href="laptrx/"><i class="fa fa-bar-chart"></i><span> Lap. Transaksi</span></a></li>
                    <li class="header">MANAJEMEN</li>
                    <li><a href="manajemen/toko.php"><i class="fa fa-gears"></i><span> Pengaturan Toko</span></a></li>
                    <li><a href="#"><i class="fa fa-users"></i><span> User Manager </span><span class="label label-danger">COMING</span></a></li>
                    <li><a href="manajemen/infoaplikasi.php"><i class="fa fa-info-circle"></i><span> Informasi Aplikasi</span></a></li>
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
            <section class="content">
                <!-- BOX 1 -->
                <!-- =========================================================== -->

                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-aqua">
                            <span class="info-box-icon"><i class="fa fa-mobile-phone"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">PELANGGAN HP</span>
                                <?php
                                // Sertakan file koneksi
                                include 'koneksi.php';

                                // Query untuk menghitung total data
                                $query = "SELECT COUNT(*) AS total FROM daftar_pelanggan WHERE jenis = 'Pelanggan HP'";
                                $result = $koneksi->query($query);

                                if ($result->num_rows > 0)
                                    $row = $result->fetch_assoc();
                                $totalDataPelangganHP = $row['total'];

                                ?>
                                <span class="info-box-number"><? echo $totalDataPelangganHP ?></span>
                                <?php
                                // Sertakan file koneksi
                                include 'koneksi.php';

                                // Query untuk menghitung total data
                                $query = "SELECT COUNT(*) AS total FROM daftar_pelanggan WHERE jenis = 'Pelanggan HP'";
                                $result = $koneksi->query($query);

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $totalData = $row['total'];

                                    // Hitung persentase lebar bar
                                    $percentage = ($totalData / 100) * 100;

                                    echo '<div class="progress">';
                                    echo '<div class="progress-bar" style="width: ' . $percentage . '%"></div>';
                                    echo '</div>';
                                } else {
                                    echo "Tidak ada data Pelanggan HP.";
                                }

                                // Tutup koneksi
                                $koneksi->close();
                                ?>

                                <span class="progress-description">
                                    Total Data Pelanggan HP
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-green">
                            <span class="info-box-icon"><i class="fa fa-bolt"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">PELANGGAN LISTRIK</span>
                                <?php
                                // Sertakan file koneksi
                                include 'koneksi.php';

                                // Query untuk menghitung total data
                                $query = "SELECT COUNT(*) AS total FROM daftar_pelanggan WHERE jenis = 'Pelanggan Pascabayar'";
                                $result = $koneksi->query($query);

                                if ($result->num_rows > 0)
                                    $row = $result->fetch_assoc();
                                $totalDataPelangganPascabayar = $row['total'];

                                ?>
                                <span class="info-box-number"><? echo $totalDataPelangganPascabayar ?></span>
                                <?php
                                // Sertakan file koneksi
                                include 'koneksi.php';

                                // Query untuk menghitung total data
                                $query = "SELECT COUNT(*) AS total FROM daftar_pelanggan WHERE jenis = 'Pelanggan Pascabayar'";
                                $result = $koneksi->query($query);

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $totalData = $row['total'];

                                    // Hitung persentase lebar bar
                                    $percentage = ($totalData / 100) * 100;

                                    echo '<div class="progress">';
                                    echo '<div class="progress-bar" style="width: ' . $percentage . '%"></div>';
                                    echo '</div>';
                                } else {
                                    echo "Tidak ada data Pelanggan Pascabayar.";
                                }

                                // Tutup koneksi
                                $koneksi->close();
                                ?>

                                <span class="progress-description">
                                    Total Data Pelanggan Pascabayar
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-yellow">
                            <span class="info-box-icon"><i class="fa fa-bolt"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">PELANGGAN LISTRIK</span>
                                <?php
                                // Sertakan file koneksi
                                include 'koneksi.php';

                                // Query untuk menghitung total data
                                $query = "SELECT COUNT(*) AS total FROM daftar_pelanggan WHERE jenis = 'Pelanggan Prabayar'";
                                $result = $koneksi->query($query);

                                if ($result->num_rows > 0)
                                    $row = $result->fetch_assoc();
                                $totalDataPelangganPrabayar = $row['total'];

                                ?>
                                <span class="info-box-number"><? echo $totalDataPelangganPrabayar ?></span>
                                <?php
                                // Sertakan file koneksi
                                include 'koneksi.php';

                                // Query untuk menghitung total data
                                $query = "SELECT COUNT(*) AS total FROM daftar_pelanggan WHERE jenis = 'Pelanggan Prabayar'";
                                $result = $koneksi->query($query);

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $totalData = $row['total'];

                                    // Hitung persentase lebar bar
                                    $percentage = ($totalData / 100) * 100;

                                    echo '<div class="progress">';
                                    echo '<div class="progress-bar" style="width: ' . $percentage . '%"></div>';
                                    echo '</div>';
                                } else {
                                    echo "Tidak ada data Pelanggan Prabayar.";
                                }

                                // Tutup koneksi
                                $koneksi->close();
                                ?>

                                <span class="progress-description">
                                    Total Data Pelanggan Prabayar
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-red">
                            <span class="info-box-icon"><i class="fa fa-inbox"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">PRODUK TERDAFTAR</span>
                                <?php
                                // Sertakan file koneksi
                                include 'koneksi.php';

                                // Query untuk menghitung total data
                                $query = "SELECT COUNT(*) AS total FROM daftar_produk";
                                $result = $koneksi->query($query);

                                if ($result && $result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $totalDataProduk = $row['total'];

                                    echo '<span class="info-box-number">' . $totalDataProduk . '</span>';
                                } else {
                                    echo '<span class="info-box-number">0</span>';
                                }

                                // Tutup koneksi
                                $koneksi->close();
                                ?>
                                <?php
                                // Sertakan file koneksi
                                include 'koneksi.php';

                                // Query untuk menghitung total data
                                $query = "SELECT COUNT(*) AS total FROM daftar_produk";
                                $result = $koneksi->query($query);

                                if ($result && $result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $totalData = $row['total'];

                                    // Hitung persentase lebar bar
                                    $percentage = ($totalData / 100) * 100;


                                    echo '<div class="progress">';
                                    echo '<div class="progress-bar" style="width: ' . $percentage . '%"></div>';
                                    echo '</div>';
                                } else {
                                    echo "Tidak ada data Produk.";
                                }

                                // Tutup koneksi
                                $koneksi->close();
                                ?>
                                <span class="progress-description">
                                    Total Data Produk Digital
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->


                <!-- TABLE: LATEST ORDERS -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Transaksi Masuk</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="dataTabel" class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Waktu</th>
                                        <th class="text-center">Nominal Produk</th>
                                        <th class="text-center">Harga Produk</th>
                                        <th class="text-center">Keuntungan</th>
                                        <th class="text-center">No. Tujuan/ID</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <script>
                                $(document).ready(function() {
                                    var dataTable = $('#dataTabel').DataTable({
                                        "ajax": {
                                            "url": "getData.php",
                                            "dataSrc": ""
                                        },
                                        "order": [
                                            [0, "desc"]
                                        ],
                                        "columns": [{
                                                "data": "waktu"
                                            },
                                            {
                                                "data": "nominal_produk"
                                            },
                                            {
                                                "data": "harga_produk",
                                                "render": function(data, type, row) {
                                                    var formattedHarga = parseInt(data).toLocaleString("id-ID", {
                                                        style: "currency",
                                                        currency: "IDR",
                                                        minimumFractionDigits: 0
                                                    });
                                                    return formattedHarga;
                                                }
                                            },
                                            {
                                                "data": "keuntungan",
                                                "render": function(data, type, row) {
                                                    var formattedKeuntungan = parseInt(data).toLocaleString("id-ID", {
                                                        style: "currency",
                                                        currency: "IDR",
                                                        minimumFractionDigits: 0
                                                    });
                                                    return formattedKeuntungan;
                                                }
                                            },
                                            {
                                                "data": "no_tujuan"
                                            },
                                            {
                                                "data": null,
                                                "render": function(data, type, row) {
                                                    return '<button class="moveBtn btn btn-info" data-id="' + row.id + '">Proses</button>';
                                                }
                                            }
                                        ],
                                        "language": {
                                            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json"
                                        },
                                        "lengthMenu": [5, 10, 25], // Menentukan opsi jumlah entri yang ditampilkan
                                        "columnDefs": [{
                                            "className": "dt-center",
                                            "targets": "_all"
                                        }]
                                    });

                                    // Auto-reload every 1 second
                                    setInterval(function() {
                                        dataTable.ajax.reload(null, false);
                                    }, 1000);

                                    // Memindahkan item ke tabel transaksi_keluar
                                    $('#dataTabel').on('click', '.moveBtn', function() {
                                        var id = $(this).data('id');
                                        $.ajax({
                                            url: 'moveData.php',
                                            method: 'POST',
                                            data: {
                                                id: id
                                            },
                                            success: function(response) {
                                                dataTable.ajax.reload(null, false);
                                                alert("Berhasil Diproses");
                                            }
                                        });
                                    });
                                });
                            </script>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
                <!-- TABLE: LATEST ORDERS -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Transaksi Keluar</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="dataTabel2" class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Waktu</th>
                                        <th>Nominal Produk</th>
                                        <th>Harga Produk</th>
                                        <th>Keuntungan</th>
                                        <th>No. Tujuan/ID</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <script>
                                $(document).ready(function() {
                                    var dataTable = $('#dataTabel2').DataTable({
                                        "ajax": {
                                            "url": "getData2.php",
                                            "dataSrc": ""
                                        },
                                        "order": [
                                            [0, "desc"]
                                        ],
                                        "columns": [{
                                                "data": "waktu"
                                            },
                                            {
                                                "data": "nominal_produk"
                                            },
                                            {
                                                "data": "harga_produk",
                                                "render": function(data, type, row) {
                                                    var formattedHarga = parseInt(data).toLocaleString("id-ID", {
                                                        style: "currency",
                                                        currency: "IDR"
                                                    });
                                                    return formattedHarga.split(",")[0]; // Menghapus angka 0 setelah koma
                                                }
                                            },
                                            {
                                                "data": "keuntungan",
                                                "render": function(data, type, row) {
                                                    var formattedKeuntungan = parseInt(data).toLocaleString("id-ID", {
                                                        style: "currency",
                                                        currency: "IDR"
                                                    });
                                                    return formattedKeuntungan.split(",")[0]; // Menghapus angka 0 setelah koma
                                                }
                                            },
                                            {
                                                "data": "no_tujuan"
                                            },
                                            {
                                                "data": null,
                                                "render": function(data, type, row) {
                                                    return '<button class="btn btn-success disabled" data-id="' + row.id + '">Sedang Diproses</button>';
                                                }
                                            }
                                        ],
                                        "language": {
                                            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json"
                                        },
                                        "lengthMenu": [5, 10, 25], // Menentukan opsi jumlah entri yang ditampilkan
                                        "columnDefs": [{
                                            "className": "dt-center",
                                            "targets": "_all"
                                        }]
                                    });

                                    // Auto-reload every 2 seconds
                                    setInterval(function() {
                                        dataTable.ajax.reload(null, false);
                                    }, 2000);
                                });
                            </script>
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
            include 'koneksi.php';
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
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- page script -->
</body>

</html>