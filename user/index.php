<?php
    session_start();
    include "../db/conn.php";
    $username = $_SESSION['username'];
    $pass = $_SESSION['pass'];
    $adminsql = mysqli_query($conn, "select * from user where email = '$username' and pass = '$pass'");
    $adminfetch = mysqli_fetch_array($adminsql);
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
                <h5 class="card-title">All Lead</h5>
                <div class="d-flex justify-content-between align-items-center row pt-4 gap-6 gap-md-0">
                  <div class="col-md-4 product_status"></div>
                  <div class="col-md-4 product_category"></div>
                  <a href="add_new_lead.php"><div class="col-md-4 product_stock btn btn-primary">Add New Inquery</div></a>
                </div>
              </div>
              <div class="card-datatable table-responsive">
                <table class="datatables-products table">
                  <thead class="border-top">
                    <tr>
                      <th></th>
                      <th>Client Name</th>
                      <th>Number</th>
                      <th>Enquery Details</th>
                      <th>Note</th>
                      <th>Follow Up Date</th>
                      <th>actions</th>
                    </tr>
                  </thead>
                  <tbody>
<?php 
$userid = $adminfetch['id'];
  $desql = mysqli_query($conn, "select * from leads where assign = '$userid'");
  foreach($desql as $data){
?>
                    <tr>
                        <td><?php echo $data['id']; ?></td>
                        <td><?php echo $data['clientname']; ?></td>
                        <td><?php echo $data['number']; ?></td>
                        <td><?php echo $data['enquerydetails']; ?></td>
                        <td><?php echo $data['note']; ?></td>
                        <td><?php echo $data['followupdate']; ?></td>
                        <td><a href="edit.php?id=<?php echo $data['id']; ?>">Edit</a></td>
                    </tr>
<?php } ?>
                  </tbody>
                </table>
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