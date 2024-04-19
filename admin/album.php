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
    <title>Halaman Album</title>
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
            <div class="col-md-4">
                <div class="card mt-5">
                    <div class="card-header">Tambah Album</div>
                    <div class="card-body">
                    <form action="../tambah_album.php" method="post">
                    <label class="form-label">Nama Album</label>
                    <input type="text" name="namaalbum" class="form-control">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi"></textarea>
                    <button type="submit" class="btn btn-primary mt-2" name="tambah">Tambah data</button>
                    </form>
                    <!-- <table>
                        <tr>
                            <td>Nama Album</td>
                            <td><input type="text" name="namaalbum"></td>
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td><input type="text" name="deskripsi"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="Tambah"></td>
                        </tr>
                    </table> -->
                
                    </div>
                </div>
            </div>
        
    

        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header">Data Album</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Tanggal dibuat</th>
                        <th>Aksi</th>
                        </thead>
                        <tbody>
                        <?php
                        include "../koneksi.php";
                        $userid=$_SESSION['userid'];
                        $sql=mysqli_query($conn,"select * from album where userid='$userid'");
                        while($data=mysqli_fetch_array($sql)){
                        ?>
                        <tr>
                        <td><?=$data['albumid']?></td>
                        <td><?=$data['namaalbum']?></td>
                        <td><?=$data['deskripsi']?></td>
                        <td><?=$data['tanggaldibuat']?></td>
                        <td>
                        <button type="button" class="btn btn-danger" onclick="window.location.href='../hapus_album.php?albumid=<?=$data['albumid']?>'">Hapus</button>
                        <button type="button" class="btn btn-primary" onclick="window.location.href='../admin/edit_album.php?albumid=<?=$data['albumid']?>'">Edit</button>
            
                        </td>
                        </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</body>
</html>