<?php
    include "../koneksi.php";
    session_start();

    $albumid=$_GET['albumid'];

    $sql=mysqli_query($conn,"delete from album where albumid='$albumid'");


    echo "<script>
    alert('Data Berhasil DiHapus !');
    location.href='album.php'; </script>"
    // header("location:album.php");
?>