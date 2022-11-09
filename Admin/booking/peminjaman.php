<?php

require '../koneksi/koneksi.php';
if(empty($_SESSION['USER']))
{
    session_start();
}
if(!empty($_GET['id'])){
    $kode_booking = $_GET['id'];
    
    $hasil = $koneksi->query("SELECT * FROM booking WHERE kode_booking = '$kode_booking'")->fetch();

    $id_booking = $hasil['id_booking'];
    if(!isset($id_booking))
    {
        echo '<script>alert("Tidak Ada Data !");window.location="peminjaman.php"</script>';
    }
    $hsl = $koneksi->query("SELECT * FROM pembayaran WHERE id_booking = '$id_booking'")->fetch();


    $id = $hasil['id_mobil'];
    $isi = $koneksi->query("SELECT * FROM mobil WHERE id_mobil = '$id'")->fetch();
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
                    <img src="../images/user/user.png" alt="user" class="slider-img-user mb-2">
                    <p class="fw-bold mb-0 lh-1 text-white"> Selamat Datang , <?php echo $_SESSION['USER']['nama_pengguna'];?></p>
                </div>
            </div>
            <div class="slider-body px-1">
                <nav class="nav flex-column">
                    <a class="nav-link px-3 active" a href="../index.php">
                        <i class="fa fa-home fa-lg box-icon" aria-hidden="true"></i>Home
                    </a>
                    <a class="nav-link px-3" a href="../profile.php">
                        <i class="fa fa-user fa-lg box-icon" aria-hidden="true"></i>Profile Admin
                    </a>
                    <hr class="soft my-1 bg-white">
                    <a class="nav-link px-3" a href="../daftarpengguna.php">
                        <i class="fa fa-users fa-lg box-icon" aria-hidden="true"></i>Daftar Pengguna
                    </a>
                    <a class="nav-link px-3" a href="../mobil.php">
                        <i class="fa fa-car fa-lg box-icon" aria-hidden="true"></i>Daftar Mobil
                    </a>
                    <a class="nav-link px-3" a href="booking.php">
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
        <div class="container-fluid">
                <div class="row g-2 mb-3">
                    <div class="col-12">
                        <div class="d-block bg-white rounded shadow p-3">
                            <center><h2>Daftar Transaksi</h2></center>
                        </div>
                    </div>
                </div>
                <div class="container">
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5> Cari Booking</h5>
            </div>
            <div class="card-body">
                <form method="get" action="peminjaman.php">
                    <input type="text" class="form-control" 
                    value="<?php if(!empty($_GET['id'])){ echo $_GET['id']; }?>" name="id" placeholder="Tulis Kode Booking [ ENTER ]">
                </form>
            </div>
        </div>
        <br>
    </div>
    <?php if(!empty($_GET['id'])){?>
    <div class="col-sm-4">
        <div class="card">
            <div class="card-header">
                <h5> Detail Pembayaran</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <td>No Rekening</td>
                        <td> :</td>
                        <td><?= $hsl['no_rekening'];?></td>
                    </tr>
                    <tr>
                        <td>Atas Nama </td>
                        <td> :</td>
                        <td><?= $hsl['nama_rekening'];?></td>
                    </tr>
                    <tr>
                        <td>Nominal  </td>
                        <td> :</td>
                        <td>Rp. <?= number_format($hsl['nominal']);?></td>
                    </tr>
                    <tr>
                        <td>Tgl  Transfer</td>
                        <td> :</td>
                        <td><?= $hsl['tanggal'];?></td>
                    </tr>
                </table>
            </div>
        </div>
        <br/>
        <div class="card">
            <div class="card-header">
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
            <div class="card-header">
                <h5 class="card-title">Detail Booking & Status Mobil</h5>
            </div>
           <div class="card-body">
               <form method="post" action="proses.php?id=konfirmasi2">
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
                            <td>Status Mobil</td>
                            <td> :</td>
                            <td>
                                <select class="form-control" name="status">
                                    <option <?php if($isi['status'] == 'Tersedia'){echo 'selected';}?> value="Tersedia">
                                        Tersedia ( Kembali )
                                    </option>
                                    <option <?php if($isi['status'] == 'Tidak Tersedia'){echo 'selected';}?> value="Tidak Tersedia">
                                        Tidak Tersedia ( Pinjam )
                                    </option>
                                </select>    
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="id_mobil" value="<?php echo $isi['id_mobil'];?>">
                    <button type="submit" class="btn btn-primary float-right">
                        Ubah Status
                    </button>
            </form>
               
           </div>
         </div> 
    </div>
    <?php }?>
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