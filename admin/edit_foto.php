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

<div class="container" style="padding-left: 120px;">
    <div class="row">
        <div class="col-md-11">
            <div class="card mt-4">
                <div class="card-header">Edit Foto</div>
                <div class="card-body">
                    <form action="../update_foto.php" method="post" enctype="multipart/form-data">
                    <?php
                    include "../koneksi.php";
                    $fotoid=$_GET['fotoid'];
                    $sql=mysqli_query($conn,"select * from foto where fotoid='$fotoid'");
                    while($data=mysqli_fetch_array($sql)){
                ?>
                <input type="text" name="fotoid" value="<?=$data['fotoid']?>" hidden>
                <label class="form-label mt-2" style="padding-right: 0px;padding-left: 6px;">Judul Foto</label>
                <input type="text" name="judulfoto" value="<?=$data['judulfoto']?>" class="form-control">
                <label class="form-label mt-2">Deskripsi</label>
                <input type="text" name="deskripsifoto" value="<?=$data['deskripsifoto']?>" class="form-control">
                <label class="form-label mt-2" style="padding-right: 0px;padding-left: 6px;">Lokasi File</label>
                <input type="file" name="lokasifile" class="form-control">
                <label class="form-label mt-2" style="padding-right: 0px;padding-left: 6px;">Album</label>
                <select class="form-control" name="albumid">
                    <?php
                        $userid=$_SESSION['userid'];
                        $sql2=mysqli_query($conn,"select * from album where userid='$userid'");
                        while($data2=mysqli_fetch_array($sql2)){
                    ?>
                            <option value="<?=$data2['albumid']?>" <?php if($data2['albumid']==$data['albumid']){echo 'selected';}?>><?=$data2['namaalbum']?></option>
                    <?php
                        }
                    ?>
                    </select>
                    <input type="submit" value="Ubah" class="form-control btn btn-primary mt-2">
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