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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

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


<div class="container mt-3">
    
    <?php
    include "../koneksi.php";
    $userid=$_SESSION['userid'];
    $album = mysqli_query($conn, "SELECT * FROM album WHERE userid='$userid'");
    while($row = mysqli_fetch_array($album)){ ?>
    <a href="home.php?albumid=<?php echo $row['albumid']?>" class="btn btn-light"> 
    <?php echo $row['namaalbum']?></a>



   <?php } ?>



  <div class="row">

    <?php
    if (isset($_GET['albumid'])) {
    $albumid = $_GET['albumid'];
    $query = mysqli_query($conn, "SELECT * FROM foto WHERE userid='$userid' AND albumid='$albumid'");
    while($data = mysqli_fetch_array($query)) { ?>
    <div class="col-md-3 mt-4">
        
        <div class="card">
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

        <i class="fa-regular fa-comment"></i></a>
        <?php
        $jmlkomen = mysqli_query($conn, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
        echo mysqli_num_rows($jmlkomen).'Komentar';
        ?>
        </div>
      </div>

    <?php } }else{  



include "../koneksi.php";
$userid=$_SESSION['userid'];
$query = mysqli_query($conn,"SELECT * FROM foto where userid='$userid'");
while($data = mysqli_fetch_array($query)){
?>

<div class="col-md-3 mt-4">
    
      <div class="card">
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

        <i class="fa-regular fa-comment"></i></a>
        <?php
        $jmlkomen = mysqli_query($conn, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
        echo mysqli_num_rows($jmlkomen).'Komentar';
        ?>
      </div>
    </div>
</div>
<?php } } ?>
</div>
</div>



<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html> 