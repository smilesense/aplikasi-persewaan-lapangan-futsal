<html>
<head>
    <?php
    include "../css.php";
    ?>
    <title>Futsal Guide</title>
    <style>
        body {
            background-color: white;
        }
        #menu {
            padding-top: 5px;
            margin-bottom: 10px;
            background-color: cyan;
            width : 90%;
            height : 40px;
        }
        .row {
            height : 100%;
        }
        
    </style>
</head>


<body>
<?php
session_start();
include "../connect_db.php";
if(isset($_SESSION["id_admin"])) {
    include "navbar_admin.php";
}else{
    header("Location:/");
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
            <h2 align="center">Profile Admin</h2>
            
        </div>
        
    </div>
</div>

<div class="footer">
    <div class="footer" text-center>
        <span>&copy; Copyright 2020</span>
</div>

</body>
</html>