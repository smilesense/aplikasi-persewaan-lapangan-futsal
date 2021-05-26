<?php
include "connect_db.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nama =$_POST["nama"];
    $email =$_POST["email"];
    $password =$_POST["password"];
    $cek_email = mysqli_query($koneksi,"SELECT * FROM user WHERE email_user = '$email' ");
    $cek_row = mysqli_num_rows($cek_email);
    if (mysqli_num_rows($cek_email) > 0){
        echo ($cek_row);
        echo "Email telah digunakan";

    }else{
        $sql = mysqli_query($koneksi,"INSERT INTO user(nama_user, email_user, password_user, poin) VALUES ('$nama','$email','$password'. '$poin')");
        if ($sql){
            echo "Berhasil mendaftar";
        }else {
            echo "Error";
        }
    }
}
?>