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
if(isset($_SESSION["id"])) {
  include "user/navbar_user.php";
}else{
  header("Location:login_form.php");
}
?>
<?php
  $id_lapangan = $_GET["id"];
  $sql = mysqli_query($koneksi,"SELECT * FROM lapangan WHERE id_lapangan ='$id_lapangan'");
  $r = mysqli_fetch_array($sql);
  $total_harga =$r['harga_lapangan'];
?>
<div class="container bg-info">
  <h2>Pemesanan Lapangan</h2>
  <form action="" method="POST">
    <div class="form-group">
      <label for="nomor">Nomor Lapangan : </label>
      <input type="text" class="form-control" id="nomor" name="nomor" value="<?php echo $r['nomer_lapangan']?>" readonly>
    </div>
    <div class="form-group">
      <label for="nama">Nama Lengkap : </label>
      <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $_SESSION["name"]?>" readonly>
    </div>
    <div class="form-group">
      <label for="jenis">Jenis Lapangan : </label>
      <input type="text" class="form-control" id="jenis" name="jenis" readonly value="<?php echo $r['jenis_lapangan']?>">
    </div>
    <div class="form-group">
      <label for="poin">Poin Yang Dimiliki :</label>
      <input type="text" class="form-control" id="poin" name="poin" value="<?php echo $_SESSION["poin"]; ?>" readonly>
    </div>
    <div class="form-group">
      <label for="harga1">Harga Lapangan Per Jam : </label>
      <input type="text" class="form-control" id="harga1" name="harga1" readonly value="<?php echo $r['harga_point']?>">
    </div>
 
    <div class="form-group">
      <label for="durasi">Durasi : </label>
      <select class="form-control" id="durasi" name="durasi" onchange="totalHarga(this.value)" required>
        <option value="">Pilih Durasi Bermain</option>
        <option value="1">1 jam</option>
        <option value="2">2 jam</option>
        <option value="3">3 jam</option>
        <option value="4">4 jam</option>
      </select>
      <script>
          function totalHarga(waktu){
            b = document.getElementById("harga1").value;

            totalh1 = b * waktu;
  
            document.getElementById("total_poin").value = totalh1;
        
          }
      </script>
    </div>
    <div class="form-group">
      <label for="tanggal">Tanggal Main : </label>
      <div class="form-group">
            <input type="text"  name="tanggal" id="mydate" class="form-control datepicker" onchange="return cekTanggal()" placeholder="Pilih Tanggal" required/>
      </div>
    </div>
    <script type="text/javascript">
      $(function(){
          $(".datepicker").datepicker({
              format: 'yyyy-mm-dd',
              autoclose: true,
              todayHighlight: true,
          });
      });
    </script>
    <script type="text/javascript">
      function cekTanggal(){
        user = document.getElementById("mydate").value;
        tanggalUser = new Date(user).getFullYear();
        tanggalSekarang = new Date().getFullYear();
        if (tanggalSekarang <= tanggalUser){
          if (tanggalSekarang == tanggalUser){
            tanggalUser = new Date(user).getMonth();
            tanggalSekarang = new Date().getMonth();
            if (tanggalSekarang <= tanggalUser){
            tanggalUser = new Date(user).getDate();
            tanggalSekarang = new Date().getDate();
            if (tanggalSekarang < tanggalUser){
              document.getElementById('jam').disabled = false;
              jam = +document.getElementById("jam").value;
              durasim = +document.getElementById("durasi").value;
              cekJam2(jam,durasim);
            }else if(tanggalSekarang == tanggalUser){
              document.getElementById('jam').disabled = false;
              jam = +document.getElementById("jam").value;
              durasim = +document.getElementById("durasi").value;
              if (jam != ""){
                cekJam(jam,durasim);
              }
            }else{
              document.getElementById("mydate").value = "";
              document.getElementById('jam').value = "";
              document.getElementById('jam').disabled = true;
              alert("Tanggal yang dipilih tidak valid atau sudah kadaluarsa");
              return false;
            }
          }else{
            document.getElementById("mydate").value = "";
            document.getElementById('jam').value = "";
            document.getElementById('jam').disabled = true;
            alert("Tanggal yang dipilih tidak valid atau sudah kadaluarsa");
            return false;
          }
          }else if (tanggalSekarang < tanggalUser) {
            tanggalUser = new Date(user).getDate();
            tanggalSekarang = new Date().getDate();
          }
        }else{
          document.getElementById("mydate").value = "";
          document.getElementById('jam').value = "";
          document.getElementById('jam').disabled = true;
          alert("Tanggal yang dipilih tidak valid atau sudah kadaluarsa");
          return false;
        }
      }
      function cekJam(jam, durasim){
        jamUser = jam;
        durasimain = durasim;
        jamSekarang = new Date().getHours();
        if (jamSekarang+3 <= jamUser){
          if(jamUser+3 + durasimain > 24){
            alert("Maaf, Tidak Menerima Pemesanan Melebihi Jam 00.00 WIB ");

            document.getElementById("jam").value = "";
            return false;
          }

        }else{
          alert("Minimal Pemesanan adalah H+3 jam");
          document.getElementById("jam").value = "";
          return false;
        }
      }
      window.onload = function tanggalPesanan(){
        tanggal = new Date();
        document.getElementById("tgl_pesanan").value = tanggal;
      }
      function cekJam2(jam, durasim){
        jamUser = jam;
        durasimain = durasim;
        jamSekarang = new Date().getHours();
        if(jamUser+durasimain > 24){
          alert("Maaf, Tidak Menerima Pemesanan Melebihi Jam 00.00 WIB ");
          document.getElementById("jam").value = "";
          return false;
        }
      }
      window.onload = function tanggalPesanan(){
        tanggal = new Date();
        document.getElementById("tgl_pesanan").value = tanggal;
      }
    </script>
    <div class="form-group">
      <label for="jam">Jam Main : </label>
      <select class="form-control" id="jam" name="jam" onchange="return cekTanggal()" disabled required>
        <option value="">pilih jam</option>
        <option value="5">05:00</option>
        <option value="6">06:00</option>
        <option value="7">07:00</option>
        <option value="8">08:00</option>
        <option value="9">09:00</option>
        <option value="10">10:00</option>
        <option value="11">11:00</option>
        <option value="12">12:00</option>
        <option value="13">13:00</option>
        <option value="14">14:00</option>
        <option value="15">15:00</option>
        <option value="16">16:00</option>
        <option value="17">17:00</option>
        <option value="18">18:00</option>
        <option value="19">19:00</option>
        <option value="20">20:00</option>
        <option value="21">21:00</option>
        <option value="22">22:00</option>
        <option value="23">23:00</option>
      </select>
    </div>

    <div class="form-group">
      <label for="total1">Total Harga :</label>
      <input type="text" class="form-control" id="total_poin" name="total_poin" value="0" readonly>
    </div>
    <button type="submit" class="btn btn-primary"><i class="fa fa-tags" aria-hidden="true"></i> Pesan</button>
  </form>
  <?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nama = $_SESSION["name"];
    $id = $_SESSION["id"];
    $tgl_main = $_POST["tanggal"];
    $jam_main = $_POST["jam"];
    $jam_berakhir = $jam_main + $_POST["durasi"];
    $jam_range = $jam_main . " AND " . $jam_berakhir;
    $poin=$_SESSION["poin"];
    $total_poin = $_POST["total_poin"];
    $total_poin1 = $_POST["total_poin"];
    $cek_jam = mysqli_query($koneksi,"SELECT * FROM jadwal WHERE id_lapangan = '$id_lapangan' AND tgl_main = '$tgl_main' AND jam BETWEEN $jam_range ");
    $smile = mysqli_num_rows($cek_jam);
    if ($_SESSION["poin"]>=$total_poin){
        if ($smile > 1){
          echo "jam telah digunakan";
        }else {
          if ($sql = mysqli_query($koneksi,"INSERT INTO pesanan(nama_user, id_user, id_lapangan, tgl_pesanan, tgl_main, jam_mulai, jam_berakhir, total_harga, total_poin, status_pesanan) VALUES ('$nama', '$id', '$id_lapangan',LOCALTIME(),'$tgl_main',$jam_main,$jam_berakhir,$total_poin1,$total_poin,'pending')")){      
            $_SESSION["tgl_main"] = $tgl_main;
            $_SESSION["jam_main"] = $jam_main;
            $sql = mysqli_query($koneksi,"SELECT * FROM pesanan WHERE nama_user = '$nama' AND id_user = '$id' AND id_lapangan = '$id_lapangan' AND tgl_main = '$tgl_main' AND jam_mulai = $jam_main AND  jam_berakhir = $jam_berakhir AND total_harga = '-' AND total_poin = $total_poin");
            $r = mysqli_fetch_array( $sql );
            $id_pesanan = $r['id_pesanan'];
            for ($i= $jam_main; $i<= $jam_berakhir; $i++){
              mysqli_query($koneksi,"INSERT INTO jadwal(id_pesanan, id_lapangan, tgl_main, jam) VALUES('$id_pesanan','$id_lapangan','$tgl_main', $i)");
            }
            echo "Berhasil memesan, menunggu kofirmasi";?>
            <script type='text/javascript'> document.location = 'Konfirmasi.php'; </script>
          <?php
          }else {
              echo "error";
          }
        }
        
      }
      else{
        echo "Poin Tidak Cukup";
      }
    }
    
  ?>
</div>
<?php
    include "footer.php";
?>
</body>
</html>
