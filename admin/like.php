<?php
    include "../koneksi.php";
    session_start();

    if(!isset($_SESSION['userid'])){
        //Untuk bisa like harus login dulu
        header("location:index.php");
    }else{
        $fotoid=$_GET['fotoid'];
        $userid=$_SESSION['userid'];
        $ceksuka = mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");

        if (mysqli_num_rows($ceksuka) ==1){
            while($row = mysqli_fetch_array($ceksuka)){
                $likeid = $row['likeid'];
                $query = mysqli_query($conn, "DELETE FROM likefoto WHERE likeid='$likeid'");
                echo "<script>
                location.href='index.php';
                </script>";
            }
        }else{
            $tanggallike=date("Y-m-d");
            mysqli_query($conn,"insert into likefoto values('','$fotoid','$userid','$tanggallike')");
            // header("location:home.php");
            echo "<script>
                location.href='index.php';
                </script>";
        }

        //Cek apakah user sudah pernah like foto ini apa belum

        // $sql=mysqli_query($conn,"select * from likefoto where fotoid='$fotoid' and userid='$userid'");

    //     if(mysqli_num_rows($sql)==1){
    //         //User sudah pernah like foto ini
    //         header("location:home.php");
        // }else{
        //     $tanggallike=date("Y-m-d");
        //     mysqli_query($conn,"insert into likefoto values('','$fotoid','$userid','$tanggallike')");
        //     header("location:home.php");
        // }
     }

    
?>