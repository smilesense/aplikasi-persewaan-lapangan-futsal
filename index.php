<html>
<head>
    <?php
    include "css.php";
    ?>
    <title>Beranda</title>
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
        }
        form {
            padding: 5%;
        }
        .footer {
            position:absolute;
            display: block;
            bottom: 0;
            width: 100%;
            height: 60px;
            line-height: 60px;
            background-color: #CCC;
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
<br>
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
    <br>

    <div class="row"  >
        <div class="col-md-4 bg-info text-black" style="border-radius:5px;">
            <form action="hasil_cari.php" method="post" class="border border-primary rounded" style="text-align:center;">
                <h2>Filter Lapangan</h2><br>
                <div class="form-group">
                    <label for="jenis_lapangan"><h4>Jenis Lapangan</h4></label>
                    <select class="form-control" id="jenis" name="jenis">
                        <option value="">Pilih Jenis Lapangan</option>
                        <option value="Sintetis">Sintetis</option>
                        <option value="Semen">Semen</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="harga"><h4>Harga</h4></label>
                    <select class="form-control" id="harga" name="harga">
                        <option value="0 and 120000">Pilih Harga</option>
                        <option value="0 and 50000">0-50000</option>
                        <option value="50000 and 100000">50000-100000</option>
                        <option value="100000 and 120000">100000-120000</option>
                    </select>
                </div>
                <script type="text/javascript"> 
                    document.getElementById('harga').onchange = function() {
                        localStorage.setItem('harga', document.getElementById('harga').value);
                    };

                    document.getElementById('jenis').onchange = function() {
                        localStorage.setItem('jenis', document.getElementById('jenis').value);
                    };
                </script>
                <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i>  Cari</button>
            </form>
        </div>
        <div class="col-md-8" >
            <?php
            $batas = 3;
            $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
            $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	

            $previous = $halaman - 1;
            $next = $halaman + 1;

            $sql = mysqli_query($koneksi,"SELECT * FROM lapangan");
            $jumlah_data = mysqli_num_rows($sql);
			$total_halaman = ceil($jumlah_data / $batas);
            $data_lapangan = mysqli_query($koneksi,"SELECT * FROM lapangan limit $halaman_awal, $batas");
			$nomor = $halaman_awal+1;
            while ( $r = mysqli_fetch_array( $data_lapangan ) ) {
            ?>
                <div class="card" style="max-width: 700px;">
                    <img class="card-img-top" src="assets/image/lapangan/<?php echo $r['foto_lapangan']; ?>" alt="gambar lapangan" style="height: 250px">
                    <div class="card-body bg-info text-white">
                        <h4 class="card-title">Lapangan&nbsp;<?php echo $r['nomer_lapangan']; ?></h4>
                        <div class="card-title">
                                <i class="fa fa-life-ring" aria-hidden="true"></i> Jenis Lapangan :&nbsp;<?php echo $r['jenis_lapangan']; ?><br><br>
                                <i class="fas fa-money-check-alt"></i> Harga Lapangan :&nbsp;<?php echo $r['harga_lapangan']; ?><br>
                                <i class="fas fa-coins"></i> Harga Lapangan (Poin) :&nbsp;<?php echo $r['harga_point']; ?><br><br>
                        </div>
                        <a href="pesanan.php?id=<?php echo $r['id_lapangan']?>" class="btn btn-primary"><i class="fa fa-tags" aria-hidden="true"></i>   Pesan</a>
                        <a href="poin.php?id=<?php echo $r['id_lapangan']?>" class="btn btn-primary"><i class="fa fa-tags" aria-hidden="true"></i>   Pesan Dengan Poin</a>
                </div><br>
            <?php
            }?>
            <div>
            <ul class="pagination justify-content-center">
				<li class="page-item">
					<a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$Previous'"; } ?>>Kembali</a>
				</li>
				<?php 
				for($x=1;$x<=$total_halaman;$x++){
					?> 
					<li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
					<?php
				}
				?>				
				<li class="page-item">
					<a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Selanjutnya</a>
				</li>
			</ul>
            </div><br>
        </div>

    </div>
    
    

</div>
<?php
    include "footer.php";
?>
</body>
</html>