<?php

require 'koneksi/koneksi.php';
session_start();
    if(!empty($_SESSION['USER']['level'] == 'admin')){ 

    }else{ 
        echo '<script>alert("Login Khusus Admin !");window.location="../index.php";</script>';
    }
    if(empty($_SESSION['USER']))
    {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RENTAL ARDI</title>
    <link rel="stylesheet" href="./assets/app/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/icons/css/font-awesome.min.css">
    <link rel="stylesheet" href="./dist/css/index.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
</head>

<body>

    <div class="wrapper">
        <nav class="navbar navbar-expand-md navbar-light bg-light py-1">
            <div class="container-fluid">
                <button class="btn btn-default" id="btn-slider" type="button">
                    <i class="fa fa-bars fa-lg" aria-hidden="true"></i>
                </button>
                <a class="navbar-brand me-auto text-danger" href="#">Dash<span class="text-warning">Board</span></a>
                <ul class="nav ms-auto">
                    <li class="nav-item dropstart">
                    <li class="nav-item dropstart">
                        <a class="nav-link text-dark ps-3 pe-1" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown">
                            <img src="./images/user/user.png" alt="user" class="img-user">
                        </a>
                        <div class="dropdown-menu mt-2 pt-0" aria-labelledby="navbarDropdown">
                            <div class="d-flex p-3 border-bottom mb-2">
                                <img src="./images/user/user.png" alt="user" class="img-user me-2">
                                <div class="d-block">
                                    <p class="fw-bold m-0 lh-1"> Selamat Datang , <?php echo $_SESSION['USER']['nama_pengguna'];?></p>
                                </div>
                            </div>
                            <a class="dropdown-item" href="logout.php">
                                <i class="fa fa-sign-out fa-lg me-2" aria-hidden="true"></i>LogOut
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="slider" id="sliders">
            <div class="slider-head">
                <div class="d-block pt-4 pb-3 px-3">
                    <img src="./images/user/user.png" alt="user" class="slider-img-user mb-2">
                    <p class="fw-bold mb-0 lh-1 text-white"> Selamat Datang , <?php echo $_SESSION['USER']['nama_pengguna'];?></p>
                </div>
            </div>
            <div class="slider-body px-1">
                <nav class="nav flex-column">
                    <a class="nav-link px-3 active" a href="index.php">
                        <i class="fa fa-home fa-lg box-icon" aria-hidden="true"></i>Home
                    </a>
                    <a class="nav-link px-3" a href="profile.php">
                        <i class="fa fa-user fa-lg box-icon" aria-hidden="true"></i>Profile Admin
                    </a>
                    <hr class="soft my-1 bg-white">
                    <a class="nav-link px-3" a href="daftarpengguna.php">
                        <i class="fa fa-users fa-lg box-icon" aria-hidden="true"></i>Daftar Pengguna
                    </a>
                    <a class="nav-link px-3" a href="mobil.php">
                        <i class="fa fa-car fa-lg box-icon" aria-hidden="true"></i>Daftar Mobil
                    </a>
                    <a class="nav-link px-3" a href="booking/booking.php">
                        <i class="fa fa-book fa-lg box-icon" aria-hidden="true"></i>Daftar Transaksi
                    </a>
                    <hr class="soft my-1 bg-white">
                    <a class="nav-link px-3" a href="logout.php">
                        <i class="fa fa-sign-out fa-lg box-icon" aria-hidden="true"></i>LogOut
                    </a>
                </nav>
            </div>
        </div>

        <div class="main-pages">
        <?php

    require 'koneksi/koneksi.php';
    $title_web = 'Daftar Mobil';
    if(empty($_SESSION['USER']))
    {
        session_start();
    }
?>

<div class="container-fluid">
                <div class="row g-2 mb-3">
                    <div class="col-12">
                        <div class="d-block bg-white rounded shadow p-3">
                            <center><h2>Daftar Mobil</h2></center>
                        </div>
                    </div>
                </div>

                <div class="row g-2 mb-3">
                <div class="col-12">
                <div class="d-block bg-white rounded shadow p-3">
                <a class="btn btn-success" href="mobil/tambah.php" role="button">Tambah</a>
                <br><br>

                <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Gambar</th>
                            <th>Merk Mobil</th>
                            <th>No Plat</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT *FROM mobil ORDER BY id_mobil ASC";
                            $row = $koneksi->prepare($sql);
                            $row->execute();
                            $hasil = $row->fetchAll();
                            $no = 1;

                            foreach($hasil as $isi)
                            {
                        ?>
                        <tr>
                            <td><?php echo $no;?></td>
                            <td><img src="assets/image/<?php echo $isi['gambar'];?>" class="img-fluid" style="width:200px;"></td>
                            <td><?php echo $isi['merk'];?></td>
                            <td><?php echo $isi['no_plat'];?></td>
                            <td><?php echo $isi['harga'];?></td>
                            <td><?php echo $isi['status'];?></td>
                            <td><?php echo $isi['deskripsi'];?></td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="mobil/edit.php?id=<?php echo $isi['id_mobil'];?>" role="button">Edit</a>  
                                <a class="btn btn-danger  btn-sm" href="mobil/proses.php?aksi=hapus&id=<?= $isi['id_mobil'];?>&gambar=<?= $isi['gambar'];?>" role="button">Hapus</a>  
                            </td>
                        </tr>
                        <?php $no++; }?>
                    </tbody>
                </table>
            </div>
        </div>    
    </div>
</div>

    <div class="slider-background" id="sliders-background"></div>
    <script src="./dist/js/jquery.js"></script>
    <script src="./assets/app/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script src="./dist/js/index.js"></script>

</body>

</html>