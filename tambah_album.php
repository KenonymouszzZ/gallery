<?php
    include "koneksi.php";
    session_start();

    $namaalbum=$_POST['namaalbum'];
    $deskripsi=$_POST['deskripsi'];
    $tanggaldibuat=date("Y-m-d");
    $userid=$_SESSION['userid'];

    $sql=mysqli_query($conn,"insert into album values('','$namaalbum','$deskripsi','$tanggaldibuat','$userid')");


    echo "<script>
    alert('Data Berhasil Disimpan !');
    location.href='admin/album.php'; </script>"
    // header("location:album.php");
?>