<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "css.php";
    ?>
  <title>Pemesanan Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <link rel="stylesheet" href="css/datepicker.css">
  <style>
    .container{
        margin-top:1%;
        margin-bottom:1%;
        padding-top:1%;
        padding-bottom:1%;
    }
  </style>
</head>
<body>
<?php
session_start();
include "connect_db.php";
if(isset($_SESSION["id"]) && isset($_SESSION["tgl_main"])) {
  include "user/navbar_user.php";
}else{
  header("Location:login_form.php");
}
?>
<?php
  $tgl_main = $_SESSION["tgl_main"];
  $jam_main = $_SESSION["jam_main"];
  $id = $_SESSION["id"];
  $sql = mysqli_query($koneksi,"SELECT * FROM pesanan WHERE id_user = $id AND tgl_main = '$tgl_main' AND jam_mulai = $jam_main ");
  if ( $r = mysqli_fetch_array( $sql ) ) {
?>
<div class="container bg-info" style="max-width: 500px;">
  <h2>Pembayaran</h2>
  <form action="" method="POST">
    <div class="form-group">
      <label for="pesan">ID Pesanan :</label>
      <input type="text" class="form-control" id="pesan" name="pesan" value="<?php echo $r['id_pesanan']?>" readonly>
    </div>
  <?php
  }?>
    <div class="form-group">
        <label for="no">Nomor Anda : </label>
        <input type="text" class="form-control" id="no" name="no" value="" placeholder="Masukkan Nomor"required>
    </div>
    <div class="form-group">
    <label for="wallet">Tujuan : </label>
      <select class="form-control" id="wallet" name="wallet" required>
        <option value="">Pilih E-Wallet</option>
        <option value="GoPay : 085229519070" style="background-image:url(https://data.world/api/datadotworld-apps/dataset/python/file/raw/logo.png)">GoPay : 085229519070</option>
        <option value="DANA : 085229519070">DANA : 085229519070</option>
        <option value="OVO : 085229519070">OVO : 085229519070</option>
      </select>
    </div>
    <div class="form-group">
      
      <label for="total">Total yang harus dibayar:</label>
      <input type="text" class="form-control" id="total" name="total" value="<?php echo $r['total_harga']?>" readonly>
    </div>
    <div class="form-group">
      
      <label for="total">Bonus Poin :</label>
      <input type="text" class="form-control" id="poin" name="poin" value="<?php echo $r['total_poin']?>" readonly>
    </div>
    <button type="submit" class="btn btn-primary"><i class="fas fa-money-check-alt"></i> Bayar</button>
  </form>
  <?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id_pesanan = $_POST["pesan"];
    $rekening = $_POST["no"];
    $total_harga = $_POST["total"];
    $poin_lapangan = $_POST["poin"];
    $bonus=$_SESSION["poin"]+$_POST["poin"];
    $bayar = $_POST["wallet"];
    $sql_update = mysqli_query($koneksi,"UPDATE user SET poin= $bonus WHERE id_user=$id");
    $update = mysqli_query($koneksi, $sql_update);
    if ($sql = mysqli_query($koneksi,"INSERT INTO bayar(id_pesanan, id_user, rekening, total_harga,  bayar, status_pesanan,total_poin) VALUES ($id_pesanan, $id, $rekening, $total_harga, '$bayar','pending', '$total_poin')")){
        unset($_SESSION["tgl_main"]);
        unset($_SESSION["jam_main"]);
        echo "Berhasil memesan, menunggu kofirmasi";?>
        <script type='text/javascript'> 
        document.location = 'index.php';
        alert("Silakan Lakukan Pembayaran agar pesanan dapat diproses ;)")
        </script>;
    <?php
    }else {
        echo "error";
    }
  }
  ?>
</div>
<?php
    include "footer.php";
?>
</body>
</html>
