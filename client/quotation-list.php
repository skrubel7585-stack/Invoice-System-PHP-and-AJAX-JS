<?php
    session_start();
    include "db/conn.php";
    $username = $_SESSION['username'];
    $pass = $_SESSION['pass'];
    $adminsql = mysqli_query($conn, "select * from contact_person where email = '$username' and pass = '$pass'");
    $adminfetch = mysqli_fetch_array($adminsql);
    $cliId = $adminfetch['id'];
    if($username == true & $pass == true){
?>

<?php include "inc/header.php"; ?>    
    <!-- ?PROD Only: Google Tag Manager (noscript) (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J3LMKC" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    
    <!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar  ">
  <div class="layout-container">

    <?php include "inc/side_bar.php"; ?>

    <!-- Layout container -->
    <div class="layout-page">

<?php include "inc/top_bar.php"; ?>
      <!-- Content wrapper -->
<div class="content-wrapper">

        <!-- Content -->
        
        <div class="container-xxl flex-grow-1 container-p-y">
            

            
            <!-- Product List Table -->
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">All Quotation</h5>
                <!--<div class="d-flex justify-content-between align-items-center row pt-4 gap-6 gap-md-0">-->
                <!--  <div class="col-md-4 product_status"></div>-->
                <!--  <div class="col-md-4 product_category"></div>-->
                <!--  <a href="quatation-add.php"><div class="col-md-4 product_stock btn btn-primary">Add Quotation</div></a>-->
                  
                <!--</div>-->
                <!--<div class="d-flex justify-content-between align-items-center row pt-4 gap-6 gap-md-0">-->
                <!--  <div class="col-md-4 product_status"></div>-->
                <!--  <div class="col-md-4 product_category"></div>-->
                <!--  <a href="draft_list.php"><div class="col-md-4 product_stock btn btn-primary">Draft List</div></a>-->
                  
                <!--</div>-->
              </div>
              <div class="card-datatable table-responsive">
                  <div class="d-flex justify-content-between align-items-center row pt-4 gap-6 gap-md-0">
                  <div class="col-md-4 product_status"></div>
                  <div class="col-md-4 product_category"></div>
                  <form method="POST">
                      <input type="text" name="search" placeholder="Enter Company Name">
                      <input type="submit" name="submit" value="Search">
                  </form>
                  
                </div>
                <?php
    if(isset($_POST['submit'])){ ?>
                <table class="datatables-products table">
                  <thead class="border-top">
                    <tr>
                      <th></th>
                      <th>Quotation ID</th>
                      <th>Company Name</th>
                      <th>Date</th>
                      <th>Opration</th>
                    </tr>
                  </thead>
                  <tbody>
<?php 
  $desql = mysqli_query($conn, "select * from quotationlist where quotation_gen_id = '$IDS' or cdate = '$IDS' or quotation_id = '$IDS' or Clientid = '$IDS' and status = '0' and ClienNAmeID = '$cliId'");
  $ctr = 1;
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
                        <td><?php echo $data['cdate']; ?></td>
                        <td>
                            <a href="print.php?id=<?php echo $data['quotation_id']; ?>">Print</a>
                        </td>
                    </tr>
<?php } ?>
                  </tbody>
                </table>
                
<?php    }else{
?>
<table class="datatables-products table">
                  <thead class="border-top">
                    <tr>
                      <th></th>
                      <th>Quotation ID</th>
                      <th>Company Name</th>
                      <th>Date</th>
                      <th>Opration</th>
                    </tr>
                  </thead>
                  <tbody>
<?php 
  $desql = mysqli_query($conn, "select * from quotationlist where status = '0' and ClienNAmeID = '$cliId'");
  $ctr = 1;
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
                        <td><?php echo $data['cdate']; ?></td>
                        <td>
                            <a href="print.php?id=<?php echo $data['quotation_id']; ?>">Print</a>
                        </td>
                    </tr>
<?php } ?>
                  </tbody>
                </table>
                <?php } ?>
              </div>
            </div>
            
           
                      </div>
                      <!-- / Content -->

<?php include "inc/footer.php"; ?>

<?php
    }else{
        echo "<script>window.location.href='login/';</script>";
    }
?>