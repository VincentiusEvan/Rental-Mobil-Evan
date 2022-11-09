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
    if(!empty($_POST['nama_rental']))
    {
        $data[] =  htmlspecialchars($_POST["nama_rental"]);
        $data[] =  htmlspecialchars($_POST["telp"]);
        $data[] =  htmlspecialchars($_POST["alamat"]);
        $data[] =  htmlspecialchars($_POST["email"]);
        $data[] =  htmlspecialchars($_POST["no_rek"]);
        $data[] =  1;
        $sql = "UPDATE infoweb SET nama_rental = ?, telp = ?, alamat = ?, email = ?, no_rek = ?  WHERE id = ? ";
        $row = $koneksi->prepare($sql);
        $row->execute($data);
        echo '<script>alert("Update Data Info Website Berhasil !");window.location="index.php"</script>';
        exit;
    }

    if(!empty($_POST['nama_pengguna']))
    {
        $data[] =  htmlspecialchars($_POST["nama_pengguna"]);
        $data[] =  htmlspecialchars($_POST["username"]);
        $data[] =  md5($_POST["password"]);
        $data[] =  $_SESSION['USER']['id_login'];
        $sql = "UPDATE login SET nama_pengguna = ?, username = ?, password = ? WHERE id_login = ? ";
        $row = $koneksi->prepare($sql);
        $row->execute($data);
        echo '<script>alert("Update Data Profil Berhasil !");window.location="index.php"</script>';
        exit;
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
        <div class="container-fluid">
                <div class="row g-2 mb-3">
                    <div class="col-12">
                        <div class="d-block bg-white rounded shadow p-3">
                            <center><h2>Profile Admin</h2></center>
                        </div>
                    </div>
                </div>
                <div class="row g-2 mb-3">
                    <div class="col-12">
                        <div class="d-block bg-white rounded shadow p-3">
                        <form action="" method="post">
                    <?php
                        $id =  $_SESSION["USER"]["id_login"];
                        $sql = "SELECT * FROM login WHERE id_login = ?";
                        $row = $koneksi->prepare($sql);
                        $row->execute(array($id));
                        $edit_profil = $row->fetch(PDO::FETCH_OBJ);
                    ?>
                        <div class="form-group">
                            <label for="">Nama Pengguna</label>
                            <input type="text" class="form-control" value="<?= $edit_profil->nama_pengguna;?>" name="nama_pengguna" id="nama_pengguna" placeholder=""/>
                        </div>
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" required class="form-control" value="<?= $edit_profil->username;?>" name="username" id="username" placeholder=""/>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" required class="form-control" value="" name="password" id="password" placeholder=""/>
                        </div><br>
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </form>
                        </div>
                    </div>
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