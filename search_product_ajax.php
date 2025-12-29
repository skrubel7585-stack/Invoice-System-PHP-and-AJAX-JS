<?php
    include "db/conn.php";
    $search_value = $_POST['search'];
    
    ?>
    
<?php 
// $IDS = $_POST['search'];
  $desql = mysqli_query($conn, "SELECT * FROM productlist WHERE productName LIKE '%{$search_value}%' OR product_id LIKE '%{$search_value}%' OR hsnSACNumber LIKE '%{$search_value}%' OR productRate LIKE '%{$search_value}%'");
  $count = 1;
  if(mysqli_num_rows($desql) > 0){ ?>

  <?php
      foreach($desql as $data){
      $ICVID = $data['cid'];
      $clientSql = mysqli_query($conn, "select * from contact_person where clientlistID = '$ICVID'");
      $clientFetch = mysqli_fetch_array($clientSql);
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
  }else{
      ?>
      <tr>
                        <td colspan="9"><h4>No Data Found</h4></td>
                        
                    </tr>
      <?php
  }
                 
    
?>