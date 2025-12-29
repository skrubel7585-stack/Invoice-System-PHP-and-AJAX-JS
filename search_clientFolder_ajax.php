<?php
    include "db/conn.php";
    $search_value = $_POST['search'];
    
 
// $IDS = $_POST['search'];
  $desql = mysqli_query($conn, "SELECT * FROM clientlist WHERE companyName LIKE '%{$search_value}%'");


  $count = 1;
  if(mysqli_num_rows($desql) > 0){ ?>

  <?php
      foreach($desql as $SQLData){
?>

                    <tr>
        <td width="3%"><?php echo $ctr++; ?></td>
        <td><a href="folderSubFolderView.php?id=<?php echo $SQLData['cid'] ?>"><p style="color:#000;"><?php echo $SQLData['companyName']; ?></p></a></td>
    </tr>
<?php } ?>
<?php
  }else{
      ?>
      <tr>
                        <td colspan="9"><h4>No Data Found</h4></td>
                        
                    </tr>
      <?php
  }
                 
    
?>