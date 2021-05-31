<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "css.php";
    ?>
  <title>Tentang</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<?php
session_start();
include "connect_db.php";
if(isset($_SESSION["id"])) {
  include "user/navbar_user.php";
}else{
  include "navbar.php";
}
?>
<div class="container p-3 my-3 border bg-info text-white" style="border-radius:5px; box-shadow: 7px 7px 7px rgba(0, 0, 0, 0.3);">
  <h1 align="center">SELAMAT DATANG DI WEB FUTSAL GUIDE</h1><br>
  <h2 align="center">Junjung Tinggi Sportivitas!</h2>
  <h2 align="center">Salam Olahraga!</h2><br><br>
  
  <h2 align="center">KELOMPOK 3</h2>
  <h2 align="center">Kaffin Ahmad Mukhtasor (190411100176)</h2>       
  <h2 align="center">Bihubbil Choir Aidifta (190411100121)</h2>
  <h2 align="center">Azriel Akbar Hasananda Putra (190411100192)</h2>
  <h2 align="center">Steven Alexander (190411100131)</h2>   
  <h2 align="center">Muhammad Dicky Febriansah (190411100063)</h2>      
    
</div>
<?php
    include "footer.php";
?>
</body>
</html>
