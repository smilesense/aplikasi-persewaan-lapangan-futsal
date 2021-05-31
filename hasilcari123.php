<html>
<head>
    <?php
    include "css.php";
    ?>
    <title>Web Futsal</title>
    <style>
        body {
            background-color: white;
        }
        .carousel-inner img {
            width: 100%;
            height: 100%;
            max-height: 500px
        }
        .container {
            max-height: 500px;
        }
        .col-md-8, .col-md-4 {
            padding-top:1%;
            max-height: 500px;
            min-height: 300px;

        }
        .col-md-4 {
            margin-top:1%;
            max-height: 500px;
        }

        .col-md-8 {
            padding-left: 4%;
        }
        .row {
            padding-left: 1%;

        form {
            padding: 5%;
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
  include "navbar.php";
}
?>
<div class="container-fluid">
    <div id="carouselControls" class="carousel slide" data-ride="carousel">
    <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
            <li data-target="#demo" data-slide-to="3"></li>
            <li data-target="#demo" data-slide-to="4"></li>
        </ul>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://rumus.web.id/wp-content/uploads/2018/09/9.-Luas-Lapangan-Futsal-Lengkap-Dengan-Seluk-Beluknya.jpg" alt="Lapangan 1">
            </div>
            <div class="carousel-item">
                <img src="https://larbitre.files.wordpress.com/2013/10/fieldofplay.png" alt="Lapangan 2">
            </div>
            <div class="carousel-item">
                <img src="https://percepat.com/wp-content/uploads/2019/05/Ukuran-Lapangan-Futsal-Standar-Nasional.jpg" alt="Lapangan 3">
            </div>
            <div class="carousel-item">
                <img src="https://www.karyatukang.com/wp-content/uploads/2020/04/biaya-pembuatan-lapangan-futsal.jpg" alt="Lapangan 4">
            </div>
            <div class="carousel-item">
                <img src="https://faktabanten.co.id/wp-content/uploads/2018/05/IMG-20180509-WA0018.jpg" alt="Lapangan 4">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="row">
        <div class="col-md-4 bg-info text-black">
            <form action="hasil_cari.php" method="post" class="border border-primary rounded" style="text-align:center;">
                <h2>Filter Lapangan</h2><br>
                <div class="form-group">
                    <label for="jenis_lapangan"><h4>Jenis Lapangan</h4></label>
                    <select class="form-control" id="jenis" name="jenis">
                        <option id="" value="">Pilih Jenis Lapangan</option>
                        <option id="Sintetis" value="Sintetis">Sintetis</option>
                        <option id="Semen" value="Semen">Semen</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="harga"><h4>Harga</h4></label>
                    <select class="form-control" id="harga" name="harga">
                        <option id="0 and 120000" value="0 and 120000">Pilih Harga</option>
                        <option id="0 and 50000" value="0 and 50000">0-50000</option>
                        <option id="50000 and 100000" value="50000 and 100000">50000-100000</option>
                        <option id="100000 and 120000" value="100000 and 120000">100000-120000</option>
                    </select>
                </div>
                <script type="text/javascript"> 
                    document.getElementById('harga').onchange = function() {
                        localStorage.setItem('harga', document.getElementById('harga').value);
                    };

                    document.getElementById('jenis').onchange = function() {
                        localStorage.setItem('jenis', document.getElementById('jenis').value);
                    };

                    if (localStorage.getItem('harga')) {
                        document.getElementById(localStorage.getItem('harga')).selected = true;
                    } 
                    if (localStorage.getItem('jenis')) {
                        document.getElementById(localStorage.getItem('jenis')).selected = true;
                    } 
                </script>
                <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i>  Cari</button>
            </form>
            
        </div>
        <div class="col-md-8">
            <?php
            $cari_jenis =$_POST["jenis"];
            $cari_harga =$_POST["harga"];
            $sql = mysqli_query($koneksi,"SELECT * FROM lapangan WHERE jenis_lapangan LIKE '%$cari_jenis%' AND harga_lapangan BETWEEN $cari_harga ");
            while ( $r = mysqli_fetch_array( $sql ) ) {
            ?>
                <div class="card" style="max-width: 700px;">
                    <img class="card-img-top" src="assets/image/lapangan/<?php echo $r['foto_lapangan']; ?>" alt="gambar lapangan" style="height: 250px">
                    <div class="card-body bg-info text-white">
                        <h4 class="card-title">Lapangan&nbsp;<?php echo $r['nomer_lapangan']; ?></h4>
                        <div class="card-title">
                                <i class="fa fa-life-ring" aria-hidden="true"></i> Jenis Lapangan :&nbsp;<?php echo $r['jenis_lapangan']; ?><br><br>
        
                                <i class="fas fa-money-check-alt fa-fw mr-2"></i>Harga Lapangan :&nbsp;<?php echo $r['harga_lapangan']; ?><br>
                                <i class="fas fa-coins fa-fw mr-2"></i>Harga Lapangan (Poin) :&nbsp;<?php echo $r['harga_point']; ?><br>
                        </div>
                        <a href="pesanan.php?id=<?php echo $r['id_lapangan']?>" class="btn btn-primary"><i class="fa fa-tags fa-fw mr-1" aria-hidden="true"></i>   Pesan</a>
                        <a href="poin.php?id=<?php echo $r['id_lapangan']?>" class="btn btn-primary"><i class="fa fa-tags fa-fw mr-1" aria-hidden="true"></i>   Pesan Dengan Poin</a>
                </div><br>
            <?php
            }?>
        </div>
    </div>

    </div>
</div>

</body>
</html>