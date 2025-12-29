<?php

    include "db/conn.php";
    $ID = $_GET['id'];
    
    $sd = mysqli_query($conn,"select * from otherfolderDoc where id  = '$ID'");
    $Ds = $sdf['rowID'];
    $sdff = mysqli_query($conn,"select * from otherfolderDoc where rowID = '$Ds'");
    $sdf = mysqli_fetch_array($sd);
    if(mysqli_num_rows($sdff) == 1){
        $D = $sdf['rowID'];
        $DeleteSql = mysqli_query($conn,"DELETE FROM otherFolder WHERE id = '$D'");
        $dELE = mysqli_query($conn,"DELETE FROM otherfolderDoc WHERE id = '$ID'");
    
        if($DeleteSql){
        if($dELE){
            echo "<script>alert('Successfully Added');</script>";
            echo '<script>window.location.href = "clientNameFolder.php";</script>';
        }
        }
    }else {
        $dELE = mysqli_query($conn,"DELETE FROM otherfolderDoc WHERE id = '$ID'");
    

        if($dELE){
            echo "<script>alert('Successfully Added');</script>";
            echo '<script>window.location.href = "clientNameFolder.php";</script>';
        }
    }
    

?>