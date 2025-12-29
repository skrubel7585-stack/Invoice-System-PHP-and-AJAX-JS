<?php
    include "db/conn.php";
    $search_value = $_POST['search'];
    
    ?>
    
<?php 
// $IDS = $_POST['search'];
  $desql = mysqli_query($conn, "SELECT * FROM clientlist WHERE companyName LIKE '%{$search_value}%' OR cid LIKE '%{$search_value}%' OR panNumber LIKE '%{$search_value}%'");
  $count = 1;
  if(mysqli_num_rows($desql) > 0){ ?>

  <?php
      foreach($desql as $data){
      $ICVID = $data['cid'];
      $clientSql = mysqli_query($conn, "select * from contact_person where clientlistID = '$ICVID'");
      $clientFetch = mysqli_fetch_array($clientSql);
?>

                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php
                        
                        echo $clientFetch['name']; 
                        ?></td>
                        <td><?php echo $data['companyName']; ?></td>
                        <td><?php echo $clientFetch['email']; ?></td>
                        <td><?php echo $clientFetch['phone']; ?></td>
                        <td><?php echo $data['clientGst']; ?></td>
                        <td><?php echo $data['Address']; ?></td>
                        <td><?php echo $data['panNumber']; ?></td>
                        <td><?php echo $data['note']; ?></td>
                        <td><a href="delete_client.php?id=<?php echo $data['cid']; ?>" style="margin:0 5px;" class="btn btn-primary ml-3">Delete</a></td><td><a href="client_edit.php?id=<?php echo $data['cid']; ?>"  style="margin:0 5px;" class="btn btn-primary ml-3">Edit</a></td>
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