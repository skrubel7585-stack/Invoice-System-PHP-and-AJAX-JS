<?php
include "db/conn.php";
    $id = $_GET['id'];
    $sql = mysqli_query($conn, "DELETE FROM leads WHERE id = '$id'");
    if($sql){
        echo "<script>alert('Delete Successfully')</script>";
        echo "<script>window.location.href='index.php';</script>";
    }

?>