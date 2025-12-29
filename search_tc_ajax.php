<?php
    include "db/conn.php";
    $search_value = $_POST['search'];
    
 
// $IDS = $_POST['search'];
  $desql = mysqli_query($conn, "SELECT * FROM termsandconditionlist WHERE termANDconditionTitle LIKE '%{$search_value}%'");

  $count = 1;
  if(mysqli_num_rows($desql) > 0){ ?>

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
  }else{
      ?>
      <tr>
                        <td colspan="9"><h4>No Data Found</h4></td>
                        
                    </tr>
      <?php
  }
                 
    
?>