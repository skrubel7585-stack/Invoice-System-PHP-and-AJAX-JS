<?php
include "db/conn.php";
$id = $_GET['id'];
$code = $_GET['code'];
if($code == 'quotation'){
    $desql = mysqli_query($conn, "update quotationlist set status = '1' where quotation_id = '$id'");
    if($desql){
        echo "<script>alert('Successfully Add on Draft')</script>";
        echo "<script>window.location.href = 'quotation-list.php';</script>";
    }
}elseif ($code == 'invoice') {
    $desql = mysqli_query($conn, "update invList set status = '1' where invid = '$id'");
    if($desql){
        echo "<script>alert('Successfully Add on Draft')</script>";
        echo "<script>window.location.href = 'inv_list.php';</script>";
}
}

?>