<?php
     session_start();
     require 'koneksi/koneksi.php';
     if(empty($_SESSION['USER']))
     {
         echo '<script>alert("Harap login !");window.location="index.php"</script>';
     }
     $kode_booking = $_GET['id'];
     $hasil = $koneksi->query("SELECT * FROM booking WHERE kode_booking = '$kode_booking'")->fetch();
 
     $id = $hasil['id_mobil'];
     $isi = $koneksi->query("SELECT * FROM mobil WHERE id_mobil = '$id'")->fetch();
 
     $unik  = random_int(100,999);
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RENTAL ARDI</title>
    <link rel="stylesheet" href="assets/app/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/icons/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/app/css/index.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand">Rental Ardi</a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="index.php" class="nav-item nav-link active">Home</a>
                <a href="daftarmobil.php" class="nav-item nav-link active">Daftar Mobil</a>
                <?php if(!empty($_SESSION['USER'])){?>
                <li class="nav-item active">
                    <a class="nav-link active" href="history.php">History</a>
                </li>
            <?php }?>
            </div>
            <div class="navbar-nav ms-auto">
                <a href="login.php" class="nav-item nav-link active">Login</a>
                <?php if(!empty($_SESSION['USER'])){?>
            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fa fa-user"> </i> Hallo, <?php echo $_SESSION['USER']['nama_pengguna'];?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="return confirm('Apakah anda ingin logout ?');" href="logout.php">Logout</a>
                </li>
            </ul>
            <?php }?>
            </div>
        </div>
    </div>
</nav>
  <!-- Navbar -->

  <!-- Background image -->
  <div
    class="p-5 text-center bg-image"
    style="
      background-image: url('assets/image/avanza.jpg');
      height: 370px;
      margin-top: 10px;
      background-size: cover;">
  </div>
</head><hr><br>
<body>
<div class="container">
<div class="row">
    <div class="col-sm-4">

        <div class="card">
            <div class="card-body text-center">
                <h5>Pembayaran Dapat Melalui :</h5>
                <hr/>
                <p> <?= $info_web->no_rek;?> </p>
            </div>
        </div>
        <br/>
        <div class="card">
                <div class="card-body" style="background:#ddd">
                <h5 class="card-title"><?php echo $isi['merk'];?></h5>
                </div>
                <ul class="list-group list-group-flush">

                <?php if($isi['status'] == 'Tersedia'){?>

                    <li class="list-group-item bg-primary text-white">
                        <i class="fa fa-check"></i> Tersedia
                    </li>

                <?php }else{?>

                    <li class="list-group-item bg-danger text-white">
                        <i class="fa fa-close"></i> Tidak Tersedia
                    </li>

                <?php }?>
            
                <li class="list-group-item bg-dark text-white">
                    <i class="fa fa-money"></i> Rp. <?php echo number_format($isi['harga']);?>/ hari
                </li>
                </ul>
            </div>
    </div>
    <div class="col-sm-8">
         <div class="card">
           <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Kode Booking  </td>
                            <td> :</td>
                            <td><?php echo $hasil['kode_booking'];?></td>
                        </tr>
                        <tr>
                            <td>KTP  </td>
                            <td> :</td>
                            <td><?php echo $hasil['ktp'];?></td>
                        </tr>
                        <tr>
                            <td>Nama  </td>
                            <td> :</td>
                            <td><?php echo $hasil['nama'];?></td>
                        </tr>
                        <tr>
                            <td>telepon  </td>
                            <td> :</td>
                            <td><?php echo $hasil['no_tlp'];?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Sewa </td>
                            <td> :</td>
                            <td><?php echo $hasil['tanggal'];?></td>
                        </tr>
                        <tr>
                            <td>Lama Sewa </td>
                            <td> :</td>
                            <td><?php echo $hasil['lama_sewa'];?> hari</td>
                        </tr>
                        <tr>
                            <td>Total Harga </td>
                            <td> :</td>
                            <td>Rp. <?php echo number_format($hasil['total_harga']);?></td>
                        </tr>
                        <tr>
                            <td>Status </td>
                            <td> :</td>
                            <td><?php echo $hasil['konfirmasi_pembayaran'];?></td>
                        </tr>
                    </table>

                <?php if($hasil['konfirmasi_pembayaran'] == 'Belum Bayar'){?>
                    <a href="konfirmasi.php?id=<?php echo $kode_booking;?>" 
                    class="btn btn-primary float-right">Konfirmasi Pembayaran</a>
                <?php }?>
               
           </div>
         </div> 
    </div>
</div>
</div>
</body>
<footer>
<div class="footer mt-4 bg-light text-black pt-3 pb-2">
      <div class="container">
        <center>
        <i class="fa fa-instagram" aria-hidden="true"></i>&nbsp;Rental_Ardi
        </center>
      </div>
    </div>
</footer>

    <script src="dist/js/jquery.js"></script>
    <script src="assets/app/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="dist/js/index.js"></script>

</html>