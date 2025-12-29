<?php
    include "db/conn.php";
    // $search_value = $_POST['search'];
    
    ?>
    
<?php 
// $IDS = $_POST['search'];
  $desql = mysqli_query($conn, "SELECT * FROM productlist");
  $count = 1;
?>

<?php
      foreach($desql as $data){
?>

                    <tr>
                        <td><?php echo $data['product_id']; ?></td>
                        <td><?php echo $data['productName']; ?></td>
                        <td><?php echo $data['note']; ?></td>
                        <td><?php echo $data['hsnSACNumber']; ?></td>
                        <td><?php echo $data['unit']; ?></td>
                        <td><?php echo $data['productRate']; ?></td>
                        <td><?php echo $data['gstamount']/2; ?></td>
                        <td><?php echo $data['gstamount']/2; ?></td>
                        <td><a href="delete_product.php?id=<?php echo $data['product_id']; ?>"  style="margin:0 5px;" class="btn btn-primary ml-3">Delete</a></td><td><a href="edit_product.php?id=<?php echo $data['product_id']; ?>"  style="margin:0 5px;" class="btn btn-primary ml-3">Edit</a></td>
                    </tr>
<?php } ?>
<?php

                 
    
?>