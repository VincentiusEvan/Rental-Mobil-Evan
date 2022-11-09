<?php

require 'koneksi/koneksi.php';
if(empty($_SESSION['USER']))
{
    session_start();
}
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
</head>
<body>
<section class="vh-80" style="margin-top:15px">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="assets/image/login.webp"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
      <form method="post" action="koneksi/proses.php?id=daftar">
                    <center><h5 class="card-title">Daftar</h5></center>
                    <div class="form-group">
                    <label for="">Nama Pengguna</label>
                    <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="user" id="" class="form-control"  required placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="pass" id="" class="form-control" required placeholder="" aria-describedby="helpId">
                    </div><br>
                    <button type="submit" class="btn btn-primary">Daftar</button>
                    </form>
          </div>
      </div>
    </div>
  </div>
  <div>
   
  </div>
</section>
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