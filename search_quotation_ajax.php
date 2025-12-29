<?php
    include "db/conn.php";
    $search_value = $_POST['search'];
    
 
// $IDS = $_POST['search'];
$desql = mysqli_query($conn, "SELECT * FROM quotationlist AS inv INNER JOIN clientlist AS ot ON inv.Clientid = ot.cid WHERE (inv.quotation_gen_id LIKE '%{$search_value}%' OR ot.companyName LIKE '%{$search_value}%' ) AND inv.status = '0'");

  $count = 1;
  if(mysqli_num_rows($desql) > 0){ ?>

  <?php
      foreach($desql as $data){
?>

                    <tr>
                        <td><?php echo $ctr++ ?></td>
                        <td><?php echo $data['quotation_gen_id']; ?></td>
                        <td>
                          <?php
                            $cliid = $data['Clientid'];
                            $dsjl = mysqli_query($conn, "select * from clientlist where cid = '$cliid'");
                            $ddkjfetch = mysqli_fetch_array($dsjl);
                            $clid = $ddkjfetch['companyName'];
                            echo $clid;
                          ?>
                        </td>
                        <td>
                          <?php
                          $Iddd = $data['quotation_id'];
                            $sprodusql = mysqli_query($conn, "SELECT * FROM quotationlistproduct WHERE quotation_id = '$Iddd'");
$counter = 1;
$towigst = 0;
$togs = 0;
foreach($sprodusql as $sprodusqlfetch) {
    $prossl = $sprodusqlfetch['prodcut_id'];  // Corrected product_id reference
    $proQuanty = $sprodusqlfetch['quantity'];
    $poPric = $sprodusqlfetch['product_price'];
    $discountPric = $sprodusqlfetch['discountPrice'];
    $totalWithoutgst = $poPric * $proQuanty;
    $discountPrice = $totalWithoutgst - $discountPric;

    $totalGSTs = ($discountPrice * 18) / 100;
    $towigst = $towigst + $discountPrice;
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
    $djh = $discountPrice + $totalGSTs;

}
$gs = ($towigst * 18) / 100;
$thdk = $towigst + $gs;
$csgst = $gs / 2;
echo $thdk;
                          ?>
                        </td>
                        <td><?php echo $data['cdate']; ?></td>
                        <td>
                            <a href="print.php?id=<?php echo $data['quotation_id']; ?>" class="btn btn-primary">Print</a></td>
                            <td><a href="quotation_edit.php?id=<?php echo $data['quotation_id']; ?>" class="btn btn-primary ml-3">Edit</a></td>
                           <td><a href="draft.php?id=<?php echo $data['quotation_id']; ?>&code=quotation" class="btn btn-primary ml-3">Draft</a>
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