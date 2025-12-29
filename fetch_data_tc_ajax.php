<?php
    include "db/conn.php";
    // $search_value = $_POST['search'];
    
    ?>
    
<?php 
// $IDS = $_POST['search'];
  $desql = mysqli_query($conn, "select * from termsandconditionlist");
  $ctr = 1;
?>

<?php
      foreach($desql as $data){
      
?>

                   <tr>
                        <td width="10%"><?php echo $data['tc_id']; ?></td>
                        <td width="40%"><?php echo $data['termANDconditionTitle']; ?></td>
                        <td width="10%">
                        <a href="edit_tc.php?id=<?php echo $data['tc_id']; ?>" class="btn btn-info btn-sm">Edit</a></td>
                       <td width="40%"> <a href="delete_tc.php?id=<?php echo $data['tc_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?')">Delete</a>
                        </td>
                    </tr>
<?php } ?>
<?php

                 
    
?>