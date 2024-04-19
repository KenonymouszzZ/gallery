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
            <div class="col-md-4">
                <div class="card mt-5">
                    <div class="card-header">Tambah Foto</div>
                    <div class="card-body">
                    <form action="../tambah_foto.php" method="post" enctype="multipart/form-data">
                    <label class="form-label" style="padding-right: 0px;padding-left: 5px;">Judul Foto</label>
                    <input type="text" name="judulfoto" class="form-control">
                    <label class="form-label" style="padding-right: 0px;padding-left: 5px;">Deskripsi</label>
                    <textarea class="form-control" name="deskripsifoto" required></textarea>
                    <label class="form-label" style="padding-right: 0px;padding-left: 5px;">Album</label>
                    <select class="form-control" name="albumid">
                    <?php
                        include "../koneksi.php";
                        $userid=$_SESSION['userid'];
                        $sql=mysqli_query($conn,"select * from album where userid='$userid'");
                        while($data=mysqli_fetch_array($sql)){
                    ?>
                            <option value="<?=$data['albumid']?>"><?=$data['namaalbum']?></option>
                    <?php
                        }
                    ?>
                    </select>
                    <label class="form-label">File</label>
                    <input type="file" class="form-control" name="lokasifile" required>
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
                <div class="card-header">Data Foto</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Tanggal Unggah</th>
                        <th>Lokasi File</th>
                        <th>Album</th>
                        <th>Disukai</th>
                        <th>Aksi</th>
                        </thead>
                        <tbody>
                        <?php
                        include "../koneksi.php";
                        $userid=$_SESSION['userid'];
                        $sql=mysqli_query($conn,"select * from foto,album where foto.userid='$userid' and foto.albumid=album.albumid");
                        while($data=mysqli_fetch_array($sql)){
                        ?>
                         <tr>
                        <td><?=$data['fotoid']?></td>
                        <td><?=$data['judulfoto']?></td>
                        <td><?=$data['deskripsifoto']?></td>
                        <td><?=$data['tanggalunggah']?></td>
                        <td>
                            <img src="../assets/gambar/<?=$data['lokasifile']?>" width="70px">
                        </td>
                        <td><?=$data['namaalbum']?></td>
                        <td>
                        <?php
                            $fotoid=$data['fotoid'];
                            $sql2=mysqli_query($conn,"select * from likefoto where fotoid='$fotoid'");
                            echo mysqli_num_rows($sql2);
                        ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger" onclick="window.location.href='../admin/hapus_foto.php?fotoid=<?=$data['fotoid']?>'">Hapus</button>
                        <button type="button" class="btn btn-primary" onclick="window.location.href='../admin/edit_foto.php?fotoid=<?=$data['fotoid']?>'">Edit</button>
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