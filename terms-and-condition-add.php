<?php
    session_start();
    include "db/conn.php";
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
            
            
            <div class="app-ecommerce">
            <form method="POST">
              <!-- Add Product -->
              <div class=" flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
            
              
            
              <div class="row">
            
                <!-- First column-->
                <div class="col-12 col-lg-12">
                  <!-- Product Information -->
                  <div class="card mb-6">
                    <div class="card-header">
                      <h5 class="card-tile mb-0">T&C Add</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-6">
                        <label class="form-label" for="ecommerce-product-name">Term & Condition Heading</label>
                        <input type="text" class="form-control" id="ecommerce-product-name" placeholder="Enter Heading" name="termANDconditionTitle" aria-label="Product title">
                      </div>
                      <div class="mb-6">
                        <label class="form-label" for="ecommerce-product-name">Term & Condition Details</label>
                        <input type="text" class="form-control" id="ecommerce-product-name" placeholder="Enter Details" name="termANDcondition[]" aria-label="Product title" required>
                      </div>
                      
                      <!-- Description -->
                      <div id="show_partner"></div>
                      <button class="form-group row btn-add-input add_item_btn"  style="border:none;background:#008CBA;border-radius:7px;padding:10px;color:#fff;">Add T&C</button> <br>
                       <button class="form-group row btn-add-input remove_item_btn"  style="border:none;background:#008CBA;border-radius:7px;padding:10px;color:#fff;">Remove Last T&C</button>
                      <br>
                      
                      <br><br>
                      <div class="col" >
                          <input type="submit" class="btn btn-primary" value="Submit"  name="submit" style="background:#7367f0;border-radius:40px;boder:none;">
                      </div>
                    </div>
                  </div>
                  <!-- /Product Information -->

                </div>
                <!-- /Second column -->
            
                
              </div>
            </div>
            </form>
          </div>
<?php
  if(isset($_POST['submit'])){
    $termANDconditionTitle = $_POST['termANDconditionTitle'];

    $inssql = mysqli_query($conn, "insert into termsandconditionlist (termANDconditionTitle,status) values ('$termANDconditionTitle' , '0')");
    if($inssql){
        $last_id = $conn->insert_id;
      
      foreach ($_POST['termANDcondition'] as $key => $val) {
          
          $productsql = mysqli_query($conn, "insert into terms (tc_idd,tc) values ('$last_id' , '$val')");
        }
      echo "<script>alert('Successfully Add')</script>";
    }
  }
?>
        <!-- / Content -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        var inputCounter = 0; // Counter to generate unique IDs for the inputs
        
        // Click event to add new product fields
        $(".add_item_btn").click(function (e) {
            e.preventDefault();
            inputCounter++; // Increment counter on each click

            // Append new product and term & condition fields
            $("#show_partner").append(`
                <div class="mb-6" id="product_${inputCounter}">
                    <div class="mb-6">
                        <label class="form-label" for="product-name-${inputCounter}">Term & Condition Details</label>
                        <input type="text" class="form-control" id="product-name-${inputCounter}" placeholder="Term & Condition Details" name="termANDcondition[]" aria-label="Term & Condition Details" required>
                    </div
                </div>
            `);
        });

        // Click event to remove the last added product
        $(".remove_item_btn").click(function (e) {
            e.preventDefault();

            if (inputCounter > 0) {
                // Remove the last product and term & condition fields by targeting the last added product div
                $("#product_" + inputCounter).remove();
                inputCounter--; // Decrease counter after removal
            } else {
                alert("No items to remove!");
            }
        });
    });
</script>
<?php include "inc/footer.php"; ?>

<?php
    }else{
        echo "<script>window.location.href='login/';</script>";
    }
?>