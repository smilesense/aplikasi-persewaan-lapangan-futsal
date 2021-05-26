<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "css.php";
    ?>
  <title>Register Form</title>
  <style>
    .container{
        margin-top:1%;
    }

    .col-md-5 {
      padding-top:1%;
    }
  </style>
</head>
<body>
<?php
include "navbar.php";
include "connect_db.php";
?>
<div class="container d-flex align-items-center justify-content-center">
  <div class="col-md-5 bg-info text-black text-center" style="border-radius:10px;">
    <h2 align="center">Register Form</h2>
    <form action="" method="POST" class="needs-validation" novalidate style="max-height:500px;">
      <div class="form-group">
        <label for="uname">Nama Lengkap : </label>
        <input type="text" class="form-control" id="uname" placeholder="Masukkan Nama Lengkap" name="nama" required>
        <div class="invalid-feedback">Kolom ini tidak boleh kosong.</div>
      </div>
      <div class="form-group">
        <label for="email">Email : </label>
        <input type="text" class="form-control" id="uname" placeholder="Masukkan Email" name="email" required>
        <div class="invalid-feedback">Kolom ini tidak boleh kosong.</div>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="pwd" placeholder="Masukkan Password" name="password" required>
        <div class="invalid-feedback">Kolom ini tidak boleh kosong.</div>
      </div>
    
      <button type="submit" class="btn btn-primary"><i class="fas fa-user-plus"></i>  Daftar</button><br>
      <?php
      include "connect_db.php";
      if($_SERVER["REQUEST_METHOD"] == "POST"){
          $nama =$_POST["nama"];
          $email =$_POST["email"];
          $password =$_POST["password"];
          $cek_email = mysqli_query($koneksi,"SELECT * FROM user WHERE email_user = '$email' ");
          $cek_row = mysqli_num_rows($cek_email);
          if (mysqli_num_rows($cek_email) > 0){
              echo "email telah digunakan, silakan gunakan email lain";

          }else{
              $sql = mysqli_query($koneksi,"INSERT INTO user(nama_user, email_user, password_user, poin) VALUES ('$nama','$email','$password','10')");
              if ($sql){
                  echo "Berhasil mendaftar, silakan <a href='login_form.php'>login</a>";
              }else {
                  echo "error";
              }
          }
      }
      ?>
    </form><br>
  </div>
</div>
<script>
// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
</body>
</html>
