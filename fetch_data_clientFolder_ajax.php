<?php
    include "db/conn.php";
    // $search_value = $_POST['search'];
    
    ?>
    
<?php 
// $IDS = $_POST['search'];
  $desql = mysqli_query($conn, "SELECT * FROM clientlist ORDER BY date DESC");

if (!$desql) {
    die("Query failed: " . mysqli_error($conn));
}
  $ctr = 1;
?>

<?php
      foreach($desql as $SQLData){
      if($ctr <= 5){
?>


    <tr>
        <td width="3%" style="background:green;color:#fff;"><?php echo $ctr++; ?></td>
        <td  style="background:green;color:#fff;"><a href="folderSubFolderView.php?id=<?php echo $SQLData['cid'] ?>"><p style="color:#000;"><?php echo $SQLData['companyName']; ?></p></a></td>
    </tr>

<?php }else { ?>
    <tr>
        <td width="3%" ><?php echo $ctr++; ?></td>
        <td><a href="folderSubFolderView.php?id=<?php echo $SQLData['cid'] ?>"><p style="color:#000;"><?php echo $SQLData['companyName']; ?></p></a></td>
    </tr>
<?php }

} ?>
<?php

                 
    
?>