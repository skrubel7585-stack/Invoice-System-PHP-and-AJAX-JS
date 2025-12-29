<?php
    include "db/conn.php";
    // $search_value = $_POST['search'];
    
    ?>
    
<?php 
// $IDS = $_POST['search'];
  $desql = mysqli_query($conn, "select * from clientlist");
  $ctr = 1;
?>

<?php
      foreach($desql as $data){
      
?>

                    <tr>
                        <td><?php echo $ctr++ ?></td>
                        <td><?php echo $data['inv_genId']; ?></td>
                        <td>
                          <?php
                            $cliid = $data['clientid'];
                            $dsjl = mysqli_query($conn, "select * from clientlist where cid = '$cliid'");
                            $ddkjfetch = mysqli_fetch_array($dsjl);
                            $clid = $ddkjfetch['companyName'];
                            echo $clid;
                          ?>
                        </td>
                        <td><?php echo $data['invdate']; ?></td>
                        <td>
                            <a href="invprint.php?id=<?php echo $data['invid']; ?>" class="btn btn-primary ml-3">Print</a></td>
                            <td><a href="inv_edit.php?id=<?php echo $data['invid']; ?>" class="btn btn-primary ml-3">Edit</a>
                        </td>
                    </tr>
<?php } ?>
<?php

                 
    
?>