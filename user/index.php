<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="../assets/image/lapangan/bola.png" type="image/gif" sizes="16x16">
    <?php
    include "../css.php";
    ?>

  <title>User</title>
  <style>
    .col-md-8, .col-md-4 {
        padding-top:1%;
    }

    .col-md-8{
        padding-right:5%;
    }
    .row{
        padding-left:5%;
    }

  </style>
</head>
<body>
<?php
session_start();
include "../connect_db.php";
if(isset($_SESSION["id"])) {
    if(isset($_GET["cancel_id_pesanan"])){
        $id_pesanan = $_GET["cancel_id_pesanan"];
        $update = mysqli_query($koneksi,"UPDATE pesanan SET status_pesanan = 'Dibatalkan' WHERE id_pesanan = $id_pesanan ");
        $delete = mysqli_query($koneksi,"DELETE FROM bayar WHERE id_pesanan = $id_pesanan ");
        unset($_GET["cancel_id_pesanan"]);?>
        <script type='text/javascript'> 
        document.location = 'index.php';
        alert("Hapus pesanan berhasil ;)")
        </script>;
        <?php
    }
    include "navbar_user.php";
}else{
    header("Location:/");
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-6 col-md-4">
            <div class="card bg-info" style="width:400px">
                <img class="card-img-top" src="../assets/image/lapangan/avatar.jpg" alt="Card image" style="width:100%">
                <div class="card-body">
                <h4 class="card-title"><i class="fa fa-user-circle" aria-hidden="true"></i> Nama :&nbsp;<?php echo $_SESSION["name"]; ?><h4>
                <p class="card-text"><i class="fas fa-pen-square"></i> Role : (User)</p>
                <p class="card-text"><i class="fas fa-envelope"></i> Email : <?php echo $_SESSION["email"]; ?></p>
                <p class="card-text"><i class="fas fa-coins"></i> Poin : <?php echo $_SESSION["poin"]; ?></p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
                    <h2 align="center">Riwayat Pesanan</h2>
                    <div class="table-responsive">
                        <table class="table table-info table-striped table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>ID Lapangan</th>
                            <th>Tanggal Pesanan</th>
                            <th>Tanggal Main</th>
                            <th>Jam Main</th>
                            <th>Jam Selesai</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Metode Pembayaran</th>
                            <th>Tindakan</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        
                        ?>
                        <?php
                        $id_user = $_SESSION["id"];
                        $sql = mysqli_query($koneksi,"SELECT * FROM pesanan WHERE id_user = $id_user AND status_pesanan = 'Terkonfirmasi' ");
                        while ( $r = mysqli_fetch_array( $sql )){
                            $id_pesanan = $r['id_pesanan'];
                            $sql1 = mysqli_query($koneksi,"SELECT * FROM bayar WHERE id_pesanan = $id_pesanan AND status_pesanan = 'Terkonfirmasi' ");
                            $s = mysqli_fetch_array( $sql1 );
                        ?>
                        <tr>
                            <td><?php echo $r['id_lapangan']?></td>
                            <td><?php echo $r['tgl_pesanan']?></td>
                            <td><?php echo $r['tgl_main']?></td>
                            <td><?php echo $r['jam_mulai']?></td>
                            <td><?php echo $r['jam_berakhir']?></td>
                            <td><?php echo $r['total_harga']?></td>
                            <td><?php echo $r['status_pesanan']?></td>
                            <td><?php echo $S['bayar']?></td>
                        </tr>
                        <?php
                        }
                        $sql = mysqli_query($koneksi,"SELECT * FROM pesanan WHERE id_user = $id_user AND status_pesanan = 'pending' ");
                        while ( $r = mysqli_fetch_array( $sql )){
                            $id_pesanan = $r['id_pesanan'];
                            $sql1 = mysqli_query($koneksi,"SELECT * FROM bayar WHERE id_pesanan = $id_pesanan AND status_pesanan = 'pending' ");
                            $s = mysqli_fetch_array( $sql1 );
                        ?>
                        <tr>
                            <td><?php echo $r['id_lapangan']?></td>
                            <td><?php echo $r['tgl_pesanan']?></td>
                            <td><?php echo $r['tgl_main']?></td>
                            <td><?php echo $r['jam_mulai']?></td>
                            <td><?php echo $r['jam_berakhir']?></td>
                            <td><?php echo $r['total_harga']?></td>
                            <td><?php echo $r['status_pesanan']?></td>
                            <td class="cell expand-table"><?php echo $s['bayar']?></td>
                            <td><a href="index.php?cancel_id_pesanan=<?php echo $r['id_pesanan']?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Batal Pesan</a></td>
                        </tr>
                        <?php
                        }?>
                        
                        </tbody>
                        </table>
                    </div>
        </div>    
    </div>    
</div>
<?php
    include "../footer.php";
?>
</body>
</html>
