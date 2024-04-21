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
    <title>Gallery Foto</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet"   type="text/css" href="style.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>
<body>



<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="index.php" >Gallery</a>
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

  <?php
  include "../koneksi.php";
$userid=$_SESSION['userid'];
$query = mysqli_query($conn, "SELECT * FROM foto 
                              INNER JOIN user ON foto.userid = user.userid 
                              INNER JOIN album ON foto.albumid = album.albumid");
while($data = mysqli_fetch_array($query)){
?>

<div class="col-md-3 mt-4">
<a type="button"  data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid']?>">
  
      <div class="card mb-2">
        <img src="../assets/gambar/<?php echo $data['lokasifile']?>" class="card-img-top" title="<?php echo $data['judulfoto']?>" style="height: 12rem;">
        <div class="card-footer text-center">
        <?php
        $fotoid = $data['fotoid'];
        $ceksuka = mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
        if (mysqli_num_rows($ceksuka) ==1 ){ ?>
        <a href="like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="batalsuka"><i class="fa fa-heart"></i></a>

        <?php }else{ ?>
        <a href="like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="suka"><i class="fa-regular fa-heart"></i></a>

        <?php }

        $like = mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
        echo mysqli_num_rows($like). 'Suka';
        ?>

        <a href="#" type="button"  data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid']?>">
        <i class="fa-regular fa-comment"></i></a>
        <?php
        $jmlkomen = mysqli_query($conn, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
        echo mysqli_num_rows($jmlkomen).'Komentar';
        ?>
      </div>
      </a>
      <!-- Modal -->
<div class="modal fade" id="komentar<?php echo $data['fotoid']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8">
          <img src="../assets/gambar/<?php echo $data['lokasifile']?>" class="card-img-top" title="<?php echo $data['judulfoto']?>">
          </div>
          <div class="col-md-4">
          <div class="m-2">
            <div class="overflow-auto" style="max-height: 400px;">
              <div class="sticky-top">
                <strong><?php echo $data['judulfoto']?></strong><br>
                <span class="badge bg-secondary"><?php echo $data['namalengkap']?></span>
                <span class="badge bg-secondary"><?php echo $data['tanggalunggah']?></span>
                <span class="badge bg-primary"><?php echo $data['namaalbum']?></span>
              </div>
              <hr>
              <p align= "left"><?php echo $data['deskripsifoto']?></p>
              <hr>
              <?php 
              $fotoid = $data['fotoid'];
              $komentar = mysqli_query($conn, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid=user.userid WHERE komentarfoto.fotoid='$fotoid'");
              while($row = mysqli_fetch_array($komentar)) {
              ?>
              <p align="left">
                <strong><?php echo $row['namalengkap'].' :'?></strong>
                <?php echo $row['isikomentar']?>
              </p>
              <?php  } ?>
              <hr>
              <div class="sticky-bottom">
                <form action="../proses_komentar.php" method="post">
                  <div class="input-group">
                    <input type="hidden" name="fotoid" value="<?php echo $data['fotoid']?>">
                    <input type="text" name="isikomentar" class="form-control" placeholder="Berikan komentar">
                    <div class="input-group-prepend">
                      <button type="submit" name="kirimkomentar" class="btn btn-outline-primary">Kirim</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>

    </div>
  </div>
  <?php } ?>
</div>
</div>

<!-- <div class="container mt-3">
  <div class="row">
    <div class="col-md-3">
      <div class="card">
        <img src="" class="card-img-top" title="" style="height: 12rem;">
        <div class="card-footer text-center">
          <a href="">10 suka</a>
          <a href="">10 komentar</a>
        </div>
      </div>
    </div>
  </div>
</div> -->

<footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
    <p>&copy; Gallery Foto</p>
</footer>

<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html> 