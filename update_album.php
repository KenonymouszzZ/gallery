<?php
    include "koneksi.php";
    session_start();

    $albumid=$_POST['albumid'];
    $namaalbum=$_POST['namaalbum'];
    $deskripsi=$_POST['deskripsi'];

    $sql=mysqli_query($conn,"update album set namaalbum='$namaalbum',deskripsi='$deskripsi' where albumid='$albumid'");


    echo "<script>
    alert('Data Berhasil Disimpan !');
    location.href='admin/album.php'; </script>"
    // header("location:album.php");
?>