<?php
    include "../koneksi.php";
    session_start();

    $fotoid=$_GET['fotoid'];

    $sql=mysqli_query($conn,"delete from foto where fotoid='$fotoid'");


    echo "<script>
    alert('Data Berhasil DiHapus !');
    location.href='foto.php'; </script>"
    // header("location:foto.php");
?>