<?php
    session_start();
    if(!isset($_SESSION['userid'])){
        header("location:login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <title>Halaman Foto</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="index.php">Gallery</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup" style="padding-left: 397px;">
      <div class="navbar-nav me-auto">
      <a href="home.php" class="nav-link">Home</a>
        <a href="foto.php" class="nav-link">Foto</a>
        <a href="album.php" class="nav-link">Album</a>
      </div>
      <a href="../logout.php" class="btn btn-outline-danger m-1">Keluar</a>
    </div>
  </div>
</nav>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-2">
                    <div class="card-header">Edit Album</div>
                    <div class="card-body">
                        <form action="../update_album.php" method="post">
                            <?php 
                             include "../koneksi.php";
                             $albumid=$_GET['albumid'];
                             $sql=mysqli_query($conn,"select * from album where albumid='$albumid'");
                             while($data=mysqli_fetch_array($sql)){
                            ?>
                        <input type="text" name="albumid" value="<?=$data['albumid']?>" hidden>
                        <label class="form-label" style="padding-right: 0px;padding-left: 6px;"> Nama Album</label>
                        <input type="text" name="namaalbum" value="<?=$data['namaalbum']?>" class="form-control">

                        <label class="form-label mt-2" style="padding-right: 0px;padding-left: 6px;">Deskripsi</label>
                        <input type="text" name="deskripsi" value="<?=$data['deskripsi']?>" class="form-control">

                        <input type="submit" value="Ubah" class="form-control btn btn-primary mt-3">
                        <?php
                            }
                         ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    
</body>
</html>