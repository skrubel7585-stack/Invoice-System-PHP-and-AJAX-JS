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
                      <h5 class="card-tile mb-0">Client Add</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-6">
                        <label class="form-label" for="ecommerce-product-name">Company</label>
                        <textarea type="text" class="form-control" id="ecommerce-product-name" placeholder="Company" name="companyName" aria-label="Product title" required></textarea>
                      </div>
                      <div class="row mb-6">
                        <div class="col"><label class="form-label" for="ecommerce-product-sku"> GST</label>
                          <input type="text" class="form-control" id="ecommerce-product-sku" placeholder=" GST" name="clientGst" required></div>
                        <div class="col"><label class="form-label" for="ecommerce-product-barcode" >PAN</label>
                          <input type="text" class="form-control" id="ecommerce-product-barcode" placeholder="Pan Number" name="panNumber" required></div>
                      </div>
                      <div class="mb-6">
                        <label class="form-label" for="ecommerce-product-name">Contact Person</label>
                        <input type="text" class="form-control" id="ecommerce-product-name" placeholder="Name" name="clientName[]" aria-label="Product title" required>
                      </div>
                      
                      
<div class="mb-6">
                        <label class="form-label" for="ecommerce-product-name">Contact Person Password</label>
                        <input type="password" class="form-control" id="ecommerce-product-name" placeholder=" *********" name="pass[]" aria-label="Product title" required>
                      </div>
                    <div class="row mb-6">
                        <div class="col"><label class="form-label" for="ecommerce-product-sku">Phone Number</label>
                          <input type="text" class="form-control" id="ecommerce-product-sku" placeholder="Phone Number" name="phoneNumber[]" required></div>
                        <div class="col"><label class="form-label" for="ecommerce-product-barcode">Email</label>
                          <input type="text" class="form-control" id="ecommerce-product-barcode" placeholder="Email Address" name="email[]" required></div>
                      </div>
                      <div id="show_partnllerll"></div>
                      <button class="form-group row btn-add-input add_item_btlnll"  style="border:none;background:#008CBA;border-radius:7px;padding:10px;color:#fff;">Add Contact Person</button>
                      <br>
                       <button class="form-group row btn-add-input remove_item_btn"  style="border:none;background:#008CBA;border-radius:7px;padding:10px;color:#fff;">Remove Contact Person</button><br>
                      <div class="mb-6">
                        <label class="form-label" for="ecommerce-product-name">Bill Address</label>
                        <textarea type="text" class="form-control" id="ecommerce-product-name" placeholder="Address" name="Address" aria-label="Product title" required></textarea>
                      </div>
                      <div class="mb-6">
                        <label class="form-label" for="ecommerce-product-name">Additional Note</label>
                        <textarea type="text" class="form-control" id="ecommerce-product-name" placeholder="Note" name="Note" aria-label="Product title"></textarea>
                      </div>

<div id="show_partnller"></div>
                      <button class="form-group row btn-add-input add_item_btln"  style="border:none;background:#008CBA;border-radius:7px;padding:10px;color:#fff;">Add Site Address</button>
                      <br>
                       <button class="form-group row btn-add-input remove_item_btnk"  style="border:none;background:#008CBA;border-radius:7px;padding:10px;color:#fff;">Remove Last Site Address</button>
                      
                      
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function () {
    var inputCounter = 0; // Counter for site address fields
    var inputCountert = 0; // Counter for contact person fields

    // Add Site Address
    $(".add_item_btln").click(function (e) {
        e.preventDefault();
        inputCounter++; // Increment counter

        // Append new site address field with unique ID
        $("#show_partnller").append(`
            <div class="mb-6" id="site_${inputCounter}">
                <label class="form-label" for="site-address-${inputCounter}">Site Address</label>
                <textarea type="text" class="form-control" id="site-address-${inputCounter}" placeholder="Site Address" name="SiteAddress[]" aria-label="Site Address" required></textarea>
            </div>
        `);
    });

    // Add Contact Person
    $(".add_item_btlnll").click(function (e) {
        e.preventDefault();
        inputCountert++; // Increment counter

        // Append new contact person fields with unique IDs
        $("#show_partnllerll").append(`
            <div class="mb-6" id="contact_person_${inputCountert}">
                <label class="form-label" for="contact-name-${inputCountert}">Contact Person</label>
                <input type="text" class="form-control" id="contact-name-${inputCountert}" placeholder="Name" name="clientName[]" aria-label="Contact Name" required>
            </div>
            <div class="mb-6">
                <label class="form-label" for="contact-pass-${inputCountert}">Contact Person Password</label>
                <input type="password" class="form-control" id="contact-pass-${inputCountert}" placeholder="*********" name="pass[]" aria-label="Contact Password" required>
            </div>
            <div class="row mb-6">
                <div class="col"><label class="form-label" for="contact-phone-${inputCountert}">Phone</label>
                    <input type="text" class="form-control" id="contact-phone-${inputCountert}" placeholder="Phone" name="phoneNumber[]" required></div>
                <div class="col"><label class="form-label" for="contact-email-${inputCountert}">Email</label>
                    <input type="text" class="form-control" id="contact-email-${inputCountert}" placeholder="Email Address" name="email[]" required></div>
            </div>
        `);
    });

    // Remove Last Site Address
    $(".remove_item_btnk").click(function (e) {
        e.preventDefault();
        if (inputCounter > 0) {
            // Remove the last site address field dynamically
            $("#site_" + inputCounter).remove();
            inputCounter--; // Decrease counter after removal
        } else {
            alert("No items to remove!");
        }
    });

    // Remove Last Contact Person
    $(".remove_item_btn").click(function (e) {
        e.preventDefault();
        if (inputCountert > 0) {
            // Remove the last contact person fields dynamically
            $("#contact_person_" + inputCountert).remove();
            inputCountert--; // Decrease counter after removal
        } else {
            alert("No items to remove!");
        }
    });
});

</script>
          <?php

include "db/conn.php";

    if (isset($_POST['submit'])) {
        $companyName = $_POST['companyName'];
        $clientGst = $_POST['clientGst'];
        $panNumber = $_POST['panNumber'];
        $Address = $_POST['Address'];
         $Note = $_POST['Note'];
        

        $sdsql = mysqli_query($conn,"insert into clientlist (companyName,clientGst,panNumber,Address,note,status) values ('$companyName' , '$clientGst' , '$panNumber' , '$Address' , '$Note' , '0')");

        if($sdsql){
            $last_id = $conn->insert_id;
          echo "<script>alert('Successfully Add')</script>";
          foreach ($_POST['SiteAddress'] as $key => $val) {
          $tcsql = mysqli_query($conn, "insert into siteAdress (client_id,address) values ('$last_id' , '$val')");
        }
        foreach ($_POST['clientName'] as $key => $val) {
            $phoneNumber = $_POST['phoneNumber'][$key];
            $email = $_POST['email'][$key];
            $pass = $_POST['pass'][$key];
          $tcsql = mysqli_query($conn, "insert into contact_person (clientlistID,name,phone,email,pass) values ('$last_id' , '$val' , '$phoneNumber' , '$email' , '$pass')");
        }
        }
    }

?>


        <!-- / Content -->
        
<?php include "inc/footer.php"; ?>

<?php
    }else{
        echo "<script>window.location.href='login/';</script>";
    }
?>