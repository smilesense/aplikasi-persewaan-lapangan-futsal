<html>
<head>
    <?php
    include "../css.php";
    ?>
    <link rel="icon" href="../assets/image/lapangan/bola.png" type="image/gif" sizes="16x16">
    <title>Futsal Guide</title>
    <style>
        body {
            background-color: white;
        }
        #menu {
            padding-top: 5px;
            margin-bottom: 10px;
            background-color: #007BFF;
            width : 90%;
            height : 40px;
        }
        .row {
            height : 500px;
        }
        
    </style>
</head>


<body>
<?php
session_start();
include "../connect_db.php";
if(isset($_SESSION["id_admin"])) {
  include "../navbar_user.php";
}else{
  include "../navbar.php";
}
?>
<div class="container-fluid text-center">
    <div class="row" style="padding-left: 0;">
        <div class="col-sm-3" style="background-color: blue;padding-top: 10px;">
            <div style="background-color:;width : 95%;padding-top:10px;">
                <h2>
                    <a href="../admin"><i id="menu" class="fas fa-user-astronaut rounded" > Profile</i></a><br>
                    <a href="../admin/list_pesanan.php"><i id="menu" class="fas fa-file-alt rounded"> List Pesanan</i></a><br>
                    <a href="../admin/list_user.php"><i id="menu" class="fas fa-address-book rounded"> List User</i></a><br>
                </h2>
            </div>
        
        </div>
        <div class="col-sm-9">
            <h2 align="center">List User</h2>
            <table class="table table-info table-striped table-hover table-bordered">
                <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Tindakan</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = mysqli_query($koneksi,"SELECT * FROM user");
                while ( $r = mysqli_fetch_array( $sql ) ) {
                ?>
                <tr>
                    <td><?php echo $r['nama_user']?></td>
                    <td><?php echo $r['email_user']?></td>
                    <td><?php echo $r['password_user']?></td>
                    <td><a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete </a></td>
                </tr>
                <?php
                }?>  
                
                </tbody>
            </table>
        </div>
        
    </div>
</div>

<div class="footer">
    <div class="footer" text-center>
        <span>&copy; Copyright 2020</span>
</div>

</body>
</html>