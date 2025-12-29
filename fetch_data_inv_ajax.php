<?php
    include "db/conn.php";
    // $search_value = $_POST['search'];
    
    ?>
    
<?php 
// $IDS = $_POST['search'];
  $desql = mysqli_query($conn, "select * from invList where status = '0'");
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
                            $dsjl = mysqli_query($conn, "select * from clientlist where cid = '$cliid' and status = '0'");
                            $ddkjfetch = mysqli_fetch_array($dsjl);
                            $clid = $ddkjfetch['companyName'];
                            echo $clid;
                          ?>
                        </td>
                        <td>
                          <?php
                            $invidd = $data['invid'];
$sprodusql = mysqli_query($conn, "SELECT * FROM invProduct WHERE inv_ID = '$invidd'");
$counter = 1;
$towigst = 0;
$togs = 0;
foreach($sprodusql as $sprodusqlfetch) {
    $prossl = $sprodusqlfetch['product_ID'];  // Corrected product_id reference
    $proQuanty = $sprodusqlfetch['quantity'];
    $poPric = $sprodusqlfetch['product_Price'];
    $discount = $sprodusqlfetch['discountPrice'];
    $totalWithoutgst = $poPric * $proQuanty;
    
    $discountA = $totalWithoutgst - $discount;
    

    $totalGSTs = ($discountA * 18) / 100;
    $towigst = $towigst + $discountA;
    $prosq = mysqli_query($conn, "SELECT * FROM productlist WHERE product_id = '$prossl'");
    $profetch = mysqli_fetch_array($prosq);

	$prName = $profetch['productName'];
	$prNameDse = $profetch['note'];
	$hsnSACNumber = $profetch['hsnSACNumber'];
	$unit = $profetch['unit'];
	$productRate = $profetch['productRate'];
	$gstamount = $profetch['gstamount'];
	$note = $sprodusqlfetch['description'];
	$Totalamount = $productRate + $gstamount;


}
$gs = ($towigst * 18) / 100;
$thdk = $towigst + $gs;
$csgst = $gs / 2;
                            
                            echo $thdk;
                          ?>
                        </td>
                        <td><?php echo $data['invdate']; ?></td>
                        <td>
                            <a href="invprint.php?id=<?php echo $data['invid']; ?>" class="btn btn-primary ml-3">Print</a></td>
                            <td><a href="inv_edit.php?id=<?php echo $data['invid']; ?>" class="btn btn-primary ml-3">Edit</a>
                        </td>
                         <td><a href="draft.php?id=<?php echo $data['invid']; ?>&code=invoice" class="btn btn-primary ml-3">Draft</a>
                        </td>
                    </tr>
<?php } ?>
<?php

                 
    
?>