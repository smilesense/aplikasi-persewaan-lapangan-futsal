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
      <label for="pesan">Id :</label>
      <input type="text" class="form-control" id="id" name="id" value="<?php echo $_SESSION["id"]; ?>" readonly>
    </div>
    <div class="form-group">
      <label for="pesan">Nama :</label>
      <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $_SESSION["name"]; ?>" readonly>
    </div>
    <div class="form-group">
      <label for="pesan">Poin Yang Dimiliki :</label>
      <input type="text" class="form-control" id="poin" name="poin" value="<?php echo $_SESSION["poin"]; ?>" readonly>
    </div>
    <div class="form-group">
    <label for="wallet">Tujuan : </label>
      <select class="form-control" id="wallet" name="wallet" required>
        <option value="Poin">Poin</option>
      </select>
    </div>
    <div class="form-group">
      <label for="pesan">Poin yang Harus Dibayar :</label>
      <input type="text" class="form-control" id="total" name="total" value="<?php echo $r["total_poin"]; ?>" readonly>
    </div>
 
    <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-money-check-alt"></i> Bayar</button>
  </form>
  <?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $id_pesanan = $_POST["pesan"];
    $id=$_POST['id'];
    $nama=$_POST["nama"];
    $poin=$_POST["poin"];
    $total_poin = $_POST["total"];
    $total_poin1 = $total_poin;
    $bayar = $_POST["wallet"];
    $totals=$_POST["poin"]-$_POST["total"];
    if($total_poin>=$poin){
      echo "Poin Tidak Cukup";
    }
    else{
      if (isset($_POST['submit'])){
          
          $sql_update = mysqli_query($koneksi,"UPDATE user SET poin= $totals WHERE id_user=$id");
          $update = mysqli_query($koneksi, $sql_update);
          if($sql_update){
              echo json_encode(array('message'=>'Data successfully Edit.'));
            }else{
              echo json_encode(array('message'=>'Data failed to Edit.'));
            }

          if ($sql = mysqli_query($koneksi,"INSERT INTO bayar(id_pesanan, id_user, rekening, total_harga,  bayar, status_pesanan,total_poin) VALUES ($id_pesanan, $id, '-', $total_poin1, 'Poin','pending', '$total_poin')")){
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
      }else {
          echo "error";
      }
    }
  }
  ?>
  <?php
  ?>
</div>
</body>
<footer class="text-center text-white fixed-bottom" style="background-color: #007BFF;">
  <!-- Grid container -->
  <div class="container p-0"></div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-1" >
    © 2021 Copyright Futsal Guide
  </div>
  <!-- Copyright -->
</footer>
</html>
