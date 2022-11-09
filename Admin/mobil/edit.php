<?php

require '../koneksi/koneksi.php';
session_start();
    if(!empty($_SESSION['USER']['level'] == 'admin')){ 

    }else{ 
        echo '<script>alert("Login Khusus Admin !");window.location="../../index.php";</script>';
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
    <link rel="stylesheet" href="../assets/app/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/icons/css/font-awesome.min.css">
    <link rel="stylesheet" href="../dist/css/index.css">
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
                            <img src="../images/user/user.png" alt="user" class="img-user">
                        </a>
                        <div class="dropdown-menu mt-2 pt-0" aria-labelledby="navbarDropdown">
                            <div class="d-flex p-3 border-bottom mb-2">
                                <img src="../images/user/user.png" alt="user" class="img-user me-2">
                                <div class="d-block">
                                    <p class="fw-bold m-0 lh-1"> Selamat Datang , <?php echo $_SESSION['USER']['nama_pengguna'];?></p>
                                </div>
                            </div>
                            <a class="dropdown-item" href="../logout.php">
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
                    <img src="../images/user/user.png" alt="user" class="slider-img-user mb-2">
                    <p class="fw-bold mb-0 lh-1 text-white"> Selamat Datang , <?php echo $_SESSION['USER']['nama_pengguna'];?></p>
                </div>
            </div>
            <div class="slider-body px-1">
                <nav class="nav flex-column">
                    <a class="nav-link px-3 active" a href="../index.php">
                        <i class="fa fa-home fa-lg box-icon" aria-hidden="true"></i>Home
                    </a>
                    <a class="nav-link px-3" a href="../profile">
                        <i class="fa fa-user fa-lg box-icon" aria-hidden="true"></i>Profile Admin
                    </a>
                    <hr class="soft my-1 bg-white">
                    <a class="nav-link px-3" a href="daftarpengguna.php">
                        <i class="fa fa-users fa-lg box-icon" aria-hidden="true"></i>Daftar Pengguna
                    </a>
                    <a class="nav-link px-3" a href="../mobil.php">
                        <i class="fa fa-car fa-lg box-icon" aria-hidden="true"></i>Daftar Mobil
                    </a>
                    <a class="nav-link px-3" a href="../booking/booking.php">
                        <i class="fa fa-book fa-lg box-icon" aria-hidden="true"></i>Daftar Transaksi
                    </a>
                    <hr class="soft my-1 bg-white">
                    <a class="nav-link px-3" a href="../logout.php">
                        <i class="fa fa-sign-out fa-lg box-icon" aria-hidden="true"></i>LogOut
                    </a>
                </nav>
            </div>
        </div>

        <div class="main-pages">
<?php
require '../koneksi/koneksi.php';
$title_web = 'Edit Mobil';
if(empty($_SESSION['USER']))
{
    session_start();
}
$id = $_GET['id'];

$sql = "SELECT * FROM mobil WHERE id_mobil =  ?";
$row = $koneksi->prepare($sql);
$row->execute(array($id));

$hasil = $row->fetch();
?>


<br>
<div class="container">
<div class="card">
    <div class="card-header text-white bg-primary">
        <h4 class="card-title">
            Edit Mobil - <?= $hasil['merk'];?>
        </h4>
    </div>
            <div class="row g-2 mb-3">
            <div class="col-12">
            <div class="d-block bg-white rounded shadow p-3">
            <form method="post" action="proses.php?aksi=edit&id=<?= $id;?>" enctype="multipart/form-data">
                <div class="row">


                        <div class="form-group row">
                            <label class="col-sm-3">No Plat</label>
                            <input type="text" class="form-control col-sm-9" value="<?= $hasil['no_plat'];?>" name="no_plat" placeholder="Isi No Plat">
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Merek</label>
                            <input type="text" class="form-control col-sm-9"  value="<?= $hasil['merk'];?>" name="merk" placeholder="Isi Merk">
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Harga</label>
                            <input type="text" class="form-control col-sm-9"  value="<?= $hasil['harga'];?>" name="harga" placeholder="Isi Harga">
                        </div>



                        <div class="form-group row">
                            <label class="col-sm-3">Deskripsi</label>
                            <input type="text" class="form-control col-sm-9"  value="<?= $hasil['deskripsi'];?>" name="deskripsi" placeholder="Isi Deskripsi">
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Status</label>
                            <select class="form-control col-sm-9" name="status">
                                <option value="" disabled selected>Pilih Status</option>
                                <option <?php if($hasil['status'] == 'Tersedia'){ echo 'selected';}?>>Tersedia</option>
                                <option  <?php if($hasil['status'] == 'Tidak Tersedia'){ echo 'selected';}?>>Tidak Tersedia</option>
                            </select>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Gambar</label>
                            <input type="file" accept="image/*" class="form-control col-sm-9" value="<?= $hasil['gambar'];?>" name="gambar" placeholder="Isi Gambar">
                           
                        </div>
                        <br><br><br>
                        <div class="form-group row">
                            <label class="col-sm-3">Preview :</label>
                            <img src="../assets/image/<?php echo $hasil['gambar'];?>" class="img-fluid" style="width:200px;">                               
                        </div>
                        <input type="hidden" value="<?= $hasil['gambar'];?>" name="gambar_cek">
                </div>
                <hr>
                <div class="float-right">
                    <button class="btn btn-primary" role="button" type="submit">
                        Simpan
                    </button>
                </div>
            </form>       
        </div>
    </div>
</div>
</div>

    <div class="slider-background" id="sliders-background"></div>
    <script src="../dist/js/jquery.js"></script>
    <script src="../assets/app/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script src="../dist/js/index.js"></script>

</body>

</html>