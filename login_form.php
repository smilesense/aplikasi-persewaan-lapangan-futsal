<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "css.php";
    ?>
  <title>Login Form</title>
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
session_start();
if(isset($_SESSION["id"])) {
  header("Location:index.php");
}else{
  include "navbar.php";
}
include "connect_db.php";
?>
<div class="container d-flex align-items-center justify-content-center">
  <div class="col-md-5 bg-info text-black text-center" style="height:350px; border-radius:5px; box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.3);">
    <h2 align="center">Login Form</h2>
    <form action="" method="POST" class="needs-validation" novalidate>
      <div class="form-group">
        <label for="email">Email :</label>
        <input type="text" class="form-control" id="email" placeholder="Masukkan Email" name="email" required>
        <div class="invalid-feedback">Kolom ini tidak boleh kosong.</div>
      </div>
      <div class="form-group">
        <label for="password">Password :</label>
        <input type="password" class="form-control" id="password" placeholder="Masukkan Password" name="password" required>
        <div class="invalid-feedback">Kolom ini tidak boleh kosong.</div>
      </div>
      <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i>  Login</button><br>
      <?php
      include "connect_db.php";
      if($_SERVER["REQUEST_METHOD"] == "POST"){
          $email =$_POST["email"];
          $password =$_POST["password"];
          $cek_login = mysqli_query($koneksi,"SELECT * FROM user WHERE email_user = '$email' AND password_user = '$password' ");
          $cek_login_admin = mysqli_query($koneksi,"SELECT * FROM admins WHERE email_admin = '$email' AND password_admin = '$password' ");
          if (mysqli_num_rows($cek_login) ==  1){
              $row = mysqli_fetch_array($cek_login);
              unset($_SESSION["id_admin"]);
              $_SESSION["id"] = $row['id_user'];
              $_SESSION["name"] = $row['nama_user'];
              $_SESSION["email"] = $row['email_user'];
              $_SESSION["poin"] = $row['poin'];
              ?>
              <script type='text/javascript'> 
              document.location = 'index.php';
              </script>;<?php
          }if (mysqli_num_rows($cek_login_admin) ==  1){
              $row = mysqli_fetch_array($cek_login_admin);
              unset($_SESSION["id"]);
              $_SESSION["id_admin"] = $row['id_admin'];
              $_SESSION["name"] = $row['nama_admin'];
              $_SESSION["email"] = $row['email_admin'];
              ?>
              <script type='text/javascript'> 
              document.location = 'admin/index.php';
              </script>;<?php
          }else{
              echo "Username atau password yang anda masukkan salah";
          }
      }
      ?>
    </form>
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
