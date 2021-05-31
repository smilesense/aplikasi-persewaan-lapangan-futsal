<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="../assets/image/lapangan/bola.png" type="image/gif" sizes="16x16">
    <style>
        .container {
            margin-top:1%;
        }
    </style>
    <title>Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" rel="stylesheet">

    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>

<body>
<?php
session_start();
include "../connect_db.php";
if(isset($_SESSION["id_admin"])) {
    if(isset($_GET["delete_id_pesanan"])){
        $id_pesanan = $_GET["delete_id_pesanan"];
        $delete = mysqli_query($koneksi,"DELETE FROM pesanan WHERE id_pesanan = $id_pesanan ");
        $delete_unconfirm = mysqli_query($koneksi,"DELETE FROM bayar WHERE id_pesanan = $id_pesanan ");
        $delete_jadwal = mysqli_query($koneksi,"DELETE FROM jadwal WHERE id_pesanan = $id_pesanan ");
        unset($_GET["delete_id_pesanan"]);?>
        <script type='text/javascript'> 
        document.location = 'data_pesanan.php';
        alert("Hapus pesanan berhasil ;)")
        </script>;
        <?php
    }
}else{
    header("Location:/");
}
?>
    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Futsal Guide</h3>
            </div>

            <ul class="list-unstyled components">
                <p>Selamat Datang, Admin <?php echo $_SESSION["name"]; ?></p>
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">DATA</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="index.php">DATA ADMIN</a>
                        </li>
                        <li>
                            <a href="data_user.php">DATA USER</a>
                        </li>
                        <li>
                            <a href="data_lapangan.php">DATA LAPANGAN</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="data_pesanan.php">DATA PESANAN</a>
                </li>
                <li>
                    <a href="konfirmasi_pesanan.php">KONFIRMASI PEMBAYARAN</a>
                </li>
            </ul>
        </nav>
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span></span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link bg-danger" href="../logout.php"><i class="fas fa-sign-out-alt"></i>  LOGOUT</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container">
            <h2 align="center">Data Pesanan</h2>
                <div class="table-responsive">
                    <table class="table table-info table-striped table-hover table-bordered" style="border-radius:5px; box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.3);">
                    <thead>
                      <tr>
                        <th>ID Pesanan</th>
                        <th>Nama Lengkap</th>
                        <th>ID User</th>
                        <th>ID Lapangan</th>
                        <th>Tanggal Pesanan</th>
                        <th>Tanggal Main</th>
                        <th>Jam Main</th>
                        <th>Jam Selesai</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $sql = mysqli_query($koneksi,"SELECT * FROM pesanan");
                      while ( $r = mysqli_fetch_array( $sql ) ) {
                    ?>
                      <tr>
                        <td><?php echo $r['id_pesanan']?></td>
                        <td><?php echo $r['nama_user']?></td>
                        <td><?php echo $r['id_user']?></td>
                        <td><?php echo $r['id_lapangan']?></td>
                        <td><?php echo $r['tgl_pesanan']?></td>
                        <td><?php echo $r['tgl_main']?></td>
                        <td><?php echo $r['jam_mulai']?></td>
                        <td><?php echo $r['jam_berakhir']?></td>
                        <td><?php echo $r['total_harga']?></td>
                        <td><?php echo $r['status_pesanan']?></td>
                        <td><a href="data_pesanan.php?delete_id_pesanan=<?php echo $r['id_pesanan']?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus </a></td>
                      </tr>
                    <?php
                    }?>
                    
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>