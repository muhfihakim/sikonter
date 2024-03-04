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
    <title>SIKONTER | Daftar Pelanggan</title>
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
                        <a href="daftar_pelanggan.php">
                            <i class="fa fa-users"></i>
                            <span>Pelanggan</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="tambah_pelanggan.php"><i class="fa fa-user-plus"></i> Tambah Pelanggan</a></li>
                            <li><a href="daftar_pelanggan.php"><i class="fa fa-user"></i> Daftar Pelanggan HP</a></li>
                        </ul>
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
                <!-- TABLE: LATEST ORDERS -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><strong>Daftar Pelanggan | </strong></h3>
                        <!-- Tombol Tambah -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal"><i class="fa fa-plus-square"></i> Tambah Pelanggan</button>
                        <!-- Modal Tambah Pelanggan -->
                        <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="tambahModalLabel"><strong>Tambah Pelanggan</strong></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="tambahForm" method="post">
                                            <div class="form-group">
                                                <label for="jenisPelanggan">Jenis Pelanggan:</label>
                                                <select class="form-control" id="jenisPelanggan" name="jenis_pelanggan">
                                                    <?php
                                                    // Query untuk mengambil data dari tabel jenis_pelanggan
                                                    $jenisQuery = "SELECT * FROM jenis_pelanggan";
                                                    $jenisResult = mysqli_query($koneksi, $jenisQuery);

                                                    while ($jenis = mysqli_fetch_assoc($jenisResult)) {
                                                        echo "<option value='" . $jenis['jenis'] . "'>" . $jenis['jenis'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="namaPelanggan">Nama Pelanggan:</label>
                                                <input type="text" class="form-control" id="namaPelanggan" name="nama_pelanggan">
                                            </div>
                                            <div class="form-group">
                                                <label for="nomorPelanggan">Nomor Pelanggan:</label>
                                                <input type="text" class="form-control" id="nomorPelanggan" name="nomor_pelanggan">
                                            </div>
                                            <div class="form-group">
                                                <label for="nomorHP">Nomor HP:</label>
                                                <input type="text" class="form-control" id="nomorHP" name="nomor_hp">
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat:</label>
                                                <input type="text" class="form-control" id="alamat" name="alamat">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" form="tambahForm" class="btn btn-primary">Simpan</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        // Proses penambahan pelanggan
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $jenisPelanggan = $_POST['jenis_pelanggan'];
                            $namaPelanggan = $_POST['nama_pelanggan'];
                            $nomorPelanggan = $_POST['nomor_pelanggan'];
                            $nomorHP = $_POST['nomor_hp'];
                            $alamat = $_POST['alamat'];

                            // Query untuk menambah data ke tabel daftar_pelanggan
                            $queryTambah = "INSERT INTO daftar_pelanggan (jenis, nama, no_pelanggan, no_hp, alamat) 
                    VALUES ('$jenisPelanggan', '$namaPelanggan', '$nomorPelanggan', '$nomorHP', '$alamat')";
                            $resultTambah = mysqli_query($koneksi, $queryTambah);

                            if ($resultTambah) {
                                // Jika penambahan berhasil, refresh halaman
                                echo '<script>alert("Data Pelanggan Berhasil Ditambahkan!"); window.location.href = "daftar_pelanggan.php";</script>';
                                exit();
                            } else {
                                // Jika penambahan gagal, tampilkan pesan error
                                echo "Gagal menambahkan data pelanggan.";
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
                            <table id="pelanggan-table" class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">No.</th>
                                        <th style="text-align: center">Jenis Pelanggan</th>
                                        <th style="text-align: center">Nama Pelanggan</th>
                                        <th style="text-align: center">Nomor Pelanggan</th>
                                        <th style="text-align: center">Nomor HP</th>
                                        <th style="text-align: center">Alamat</th>
                                        <th style="text-align: center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center;">
                                    <?php
                                    // Memasukkan file koneksi.php
                                    include '../koneksi.php';

                                    // Query untuk mengambil data dari tabel daftar_pelanggan
                                    $query = "SELECT * FROM daftar_pelanggan";
                                    $result = mysqli_query($koneksi, $query);

                                    $no = 1; // Variabel counter untuk nomor urutan

                                    while ($pelanggan = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $pelanggan['jenis']; ?></td>
                                            <td><?php echo $pelanggan['nama']; ?></td>
                                            <td><?php echo $pelanggan['no_pelanggan']; ?></td>
                                            <td><?php echo $pelanggan['no_hp']; ?></td>
                                            <td><?php echo $pelanggan['alamat']; ?></td>
                                            <td>
                                                <!-- Tombol Edit pada Tabel -->
                                                <a href="#" type="button" class="btn btn-success" data-toggle="modal" data-target="#editModal<?php echo $pelanggan['id']; ?>">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <!-- Tombol Hapus pada Tabel -->
                                                <a href="#" type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusModal<?php echo $pelanggan['id']; ?>">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- Modal Edit Pelanggan-->
                                        <div class="modal fade" id="editModal<?php echo $pelanggan['id']; ?>" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title"><strong>Update Data Pelanggan</strong></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form role="form" action="edit_pelanggan.php" method="get">
                                                            <?php
                                                            $id = $pelanggan['id'];
                                                            $query_edit = mysqli_query($koneksi, "SELECT * FROM daftar_pelanggan WHERE id='$id'");
                                                            while ($row = mysqli_fetch_array($query_edit)) {
                                                            ?>
                                                                <input type="hidden" name="id_pelanggan" value="<?php echo $row['id']; ?>">
                                                                <div class="form-group">
                                                                    <label>Jenis Pelanggan</label>
                                                                    <select name="jenis_pelanggan" class="form-control">
                                                                        <?php
                                                                        // Query untuk mengambil data dari tabel jenis_pelanggan
                                                                        $jenisQuery = "SELECT * FROM jenis_pelanggan";
                                                                        $jenisResult = mysqli_query($koneksi, $jenisQuery);

                                                                        while ($jenis = mysqli_fetch_assoc($jenisResult)) {
                                                                            $selected = ($row['jenis'] == $jenis['jenis']) ? 'selected' : '';
                                                                            echo "<option value='" . $jenis['jenis'] . "' $selected>" . $jenis['jenis'] . "</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Nama Pelanggan</label>
                                                                    <input type="text" name="nama_pelanggan" class="form-control" value="<?php echo $row['nama']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Nomor Pelanggan</label>
                                                                    <input type="text" name="no_pelanggan" class="form-control" value="<?php echo $row['no_pelanggan']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Nomor HP</label>
                                                                    <input type="text" name="no_hp" class="form-control" value="<?php echo $row['no_hp']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Alamat</label>
                                                                    <input type="text" name="alamat" class="form-control" value="<?php echo $row['alamat']; ?>">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-success">Update</button>
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        $no++; // Increment counter untuk nomor urutan
                                    }
                                    ?>
                                </tbody>
                            </table>
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

    <script>
        $(document).ready(function() {
            $('#pelanggan-table').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                },
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Semua"]
                ],
                "pageLength": 25
            });
        });
    </script>

</body>

</html>