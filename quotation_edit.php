<?php
    session_start();
    include "db/conn.php";
    $username = $_SESSION['username'];
    $pass = $_SESSION['pass'];
    $adminsql = mysqli_query($conn, "select * from user where email = '$username' and pass = '$pass'");
    $adminfetch = mysqli_fetch_array($adminsql);
    if($username == true & $pass == true){
        $Id = $_GET['id'];
?>

<?php include "inc/header.php"; ?>    
    <!-- ?PROD Only: Google Tag Manager (noscript) (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J3LMKC" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Event listener for the dropdown change
            $("#myDropdown").on("change", function() {
                var selectedValue = $(this).val(); // Get the selected value
                
                $.ajax({
                    url: "process2.php", // The PHP script to handle the AJAX request
                    type: "POST",
                    data: { value: selectedValue }, // Send the selected value
                    success: function(response) {
                        // Handle the response from the PHP script
                        $("#result").html(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle any errors that occur
                        $("#result").html("An error occurred: " + error);
                    }
                });
            });
            $("#tcdropdown").on("change", function() {
                var selectedValue = $(this).val(); // Get the selected value
                
                $.ajax({
                    url: "process3.php", // The PHP script to handle the AJAX request
                    type: "POST",
                    data: { value: selectedValue }, // Send the selected value
                    success: function(response) {
                        // Handle the response from the PHP script
                        $("#tcdropdownList").html(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle any errors that occur
                        $("#tcdropdownList").html("An error occurred: " + error);
                    }
                });
            });
        });
    </script>
    
    
    
    
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
            
<?php
    $clientSql = mysqli_query($conn, "select * from quotationlist where quotation_id = '$Id'");
    $Clientfetch = mysqli_fetch_array($clientSql);
    
?>
            
              <div class="row">
            
                <!-- First column-->
                <div class="col-12 col-lg-12">
                  <!-- Product Information -->
                  <div class="card mb-6">
                    <div class="card-header">
                      <h5 class="card-tile mb-0">Quatation Add</h5>
                    </div>
                    <div class="card-body">
                      <div class="mb-6">
                        <label class="form-label" for="ecommerce-product-name">Company Name</label>
                        <select type="text" class="form-control" id="myDropdown" placeholder="Company Name" value="<?php echo $Clientfetch['Clientid'] ?>" name="Clientid" aria-label="Product title" required>
                          <option value="<?php echo $Clientfetch['Clientid'] ?>">
                          <?php $clientId = $Clientfetch['Clientid'];
                          $csql = mysqli_query($conn, "select * from clientlist where cid = '$clientId'");
                          $cfetch = mysqli_fetch_array($csql);
                          echo $cfetch['companyName'];
                          ?>
                          </option>
                          <?php
                            $codsql = mysqli_query($conn, "select * from clientlist");
                            foreach($codsql as $coddata){
                          ?>
                          <option value="<?php echo $coddata['cid'] ?>"><?php
                          $CiD = $coddata['cid'];
                          $fgd = mysqli_query($conn,"select * from contact_person where clientlistID = '$CiD'");
                          $fgdh = mysqli_fetch_array($fgd);
                          echo $coddata['companyName'];
                          
                          ?></option>
                          <?php } ?>
                        </select>
                                            </div>
                        <div id="result" class="row mb-6"></div>      
<br>

                    
                      <div class="mb-6">
                        <label class="form-label" for="ecommerce-product-name">Subject</label>
                        <input type="text" class="form-control" id="ecommerce-product-name" placeholder="Subject" value="<?php echo $Clientfetch['Subject'] ?>" name="Subject" aria-label="Product title" required>
                      </div>
                      

                      <div class="mb-6">
                        <label class="form-label" for="ecommerce-product-name">Reference</label>
                        <input type="text" class="form-control" id="ecommerce-product-name" placeholder="Reference" value="<?php echo $Clientfetch['Reference'] ?>" name="Reference" aria-label="Product title">
                      </div>
<?php
    $proSql = mysqli_query($conn,"select * from quotationlistproduct where quotation_id = '$Id'");
    foreach($proSql as $proQFetch){
        $proId = $proQFetch['prodcut_id'];
        $mysqli_Prosql = mysqli_query($conn,"select * from productlist where product_id = '$proId'");
        $mysqli_ProNamefetch = mysqli_fetch_array($mysqli_Prosql);
        ?>
        <div class="mb-6">
            <label class="form-label" for="product-price">Product Name</label>
            <select type="text" name="productid[]" class="form-control" value="<?php echo $proId; ?>" required>
                <option value="<?php echo $mysqli_ProNamefetch['product_id'] ?>">Name : <?php echo $mysqli_ProNamefetch['productName'] ?></option>
                <?php
                $codsql = mysqli_query($conn, "select * from productlist");
                foreach($codsql as $coddata){
            ?>
            <option value="<?php echo $coddata['product_id'] ?>">Name : <?php echo $coddata['productName'] ?> and Price : <?php echo $coddata['productRate'] ?></option>
            <?php } ?>
            </select>
        </div>
        <div class="mb-6">
            <label class="form-label" for="product-price">Product Price (Please Put the Price)</label>
            <input type="text" name="product_price[]" class="form-control" value="<?php echo $proQFetch['product_price'] ?>" placeholder="Price"  required>
        </div>
        <div class="mb-6">
            <label class="form-label" for="product-price">Product Quantity</label>
            <input type="text" name="quantity[]" class="form-control" value="<?php echo $proQFetch['quantity'] ?>" placeholder="Quantity" required>
         </div>
        <div class="mb-6">
            <label class="form-label" for="product-price">Discount Amount</label>
            <input type="text" name="discountPrice[]" class="form-control" value="<?php echo $proQFetch['discountPrice'] ?>" placeholder="Discount Amount">
        </div>
        <div class="mb-6">
            <label class="form-label" for="product-price">Product description (Optional)</label>
            <input type="text" name="description[]" class="form-control" value="<?php echo $proQFetch['description'] ?>" placeholder="description" >
        </div>
        <?php
    }
?>
                      
<br>
                      
                      <!-- Dynamic Product Fields -->
                        <div id="show_partner"></div>
                        <button class="btn-add-input add_item_btn" style="border:none;background:#008CBA;border-radius:7px;padding:10px;color:#fff;">Add Product</button>
                        <button class="btn-add-input remove_item_btn" style="border:none;background:#008CBA;border-radius:7px;padding:10px;color:#fff;">Remove Last Product</button>
                        <br><br>
                        <!-- T&C Fields -->
                      

<?php
    $QtcSql = mysqli_query($conn, "select * from quotationlisttc where quotation_id = '$Id'");
    foreach($QtcSql as $QtcFetch){
        $QtcnameId = $QtcFetch['tc_id'];
        $QtcSqL = mysqli_query($conn,"select * from termsandconditionlist where tc_id = '$QtcnameId'");
        $QtcFetchH = mysqli_fetch_array($QtcSqL);
        ?>
                <div class="mb-6">
            <label class="form-label" for="product-price">Term & Condition Heading</label>
            <select type="text" name="termC[]" class="form-control" value="<?php echo $QtcFetch['tc_id'] ?>" placeholder="description" >
                <option value="<?php echo $QtcFetchH['tc_id'] ?>"><a href="?action=edit&Id=<?php echo $coddata['tc_id'] ?>"><?php echo $QtcFetchH['termANDconditionTitle'] ?></a></option>
                <?php
                            $codsql = mysqli_query($conn, "select * from termsandconditionlist");
                            foreach($codsql as $coddata){
                          ?>
                          <option value="<?php echo $coddata['tc_id'] ?>"><a href="?action=edit&Id=<?php echo $coddata['tc_id'] ?>"><?php echo $coddata['termANDconditionTitle'] ?></a></option>
                          <?php } ?>
            </select>
        </div>
        <?php
    }
?>

                      
                     <div id="show_partnller"></div>
                        <button class="btn-add-input add_item_btln" style="border:none;background:#008CBA;border-radius:7px;padding:10px;color:#fff;">Add T&C</button>
                        <button class="btn-add-input remove_item_btnk" style="border:none;background:#008CBA;border-radius:7px;padding:10px;color:#fff;">Remove Last T&C</button>
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




        <!-- / Content -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
           <script>
                $(document).ready(function () {
                     var inputCounter = 0; // Counter for product fields
        var inputCountert = 0; // Counter for T&C fields
                    // alert("hello");
                    $(".add_item_btn").click(function (e) {
                        e.preventDefault();
                        inputCounter++; // Increment counter
                        $("#show_partner").append(`<div class="mb-6 product-item">
                        <div class="mb-6">
        <label class="form-label" for="product-name-${inputCounter}">Product Name</label>
        <select type="text" class="form-control" name="productid[]" aria-label="Product title" required>
            <option>Select Product</option>
            <?php
                $codsql = mysqli_query($conn, "select * from productlist");
                foreach($codsql as $coddata){
            ?>
            <option value="<?php echo $coddata['product_id'] ?>">Name : <?php echo $coddata['productName'] ?> and Price : <?php echo $coddata['productRate'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-6">
        <label class="form-label" for="product-name-${inputCounter}">Product Price (Please Put the Price)</label>
        <input type="text" name="product_price[]" class="form-control" placeholder="Price" required>
    </div>
    <div class="mb-6">
        <label class="form-label" for="product-name-${inputCounter}">Product Quantity</label>
        <input type="text" name="quantity[]" class="form-control" placeholder="Quantity" >
    </div>
    <div class="mb-6">
        <label class="form-label" for="product-name-${inputCounter}">Discount Amount</label>
        <input type="text" name="discountPrice[]" class="form-control" placeholder="Discount Amount">
    </div>
    <div class="mb-6">
        <label class="form-label" for="product-name-${inputCounter}">Product description (Optional)</label>
        <input type="text" name="description[]" class="form-control" placeholder="description" >
    </div>
    </div>`);
                    });
                    $(".add_item_btln").click(function (e) {
                        e.preventDefault();
                        inputCountert++;
                        $("#show_partnller").append(`<div class="mb-6 term-item">
                        <label class="form-label" for="tc-${inputCountert}" for="ecommerce-product-name">T&C</label>
                        <select type="text" class="form-control" id="" placeholder="Company Name" name="termC[]" aria-label="Product title" required>
                          <option>Select T&C</option>
                          <?php
                            $codsql = mysqli_query($conn, "select * from termsandconditionlist");
                            foreach($codsql as $coddata){
                          ?>
                          <option value="<?php echo $coddata['tc_id'] ?>"><?php echo $coddata['termANDconditionTitle'] ?></option>
                          <?php } ?>
                        </select>
                      </div>`);
                    });
                    
                    // Remove Last Product Field
        $(".remove_item_btn").click(function (e) {
            e.preventDefault();
            if (inputCounter > 0) {
                $(".product-item").last().remove();
                inputCounter--; // Decrease counter after removal
            } else {
                alert("No items to remove!");
            }
        });

        // Remove Last T&C Field
        $(".remove_item_btnk").click(function (e) {
            e.preventDefault();
            if (inputCountert > 0) {
                $(".term-item").last().remove();
                inputCountert--; // Decrease counter after removal
            } else {
                alert("No items to remove!");
            }
        });
                });
            </script>
<?php include "inc/footer.php"; ?>

<?php
if (isset($_POST['submit'])) {
    $Clientid = $_POST['Clientid'];
    $SiTeAddress = $_POST['SiTeAddress'];
    $Subject = $_POST['Subject'];
    $Reference = $_POST['Reference'];
    $termC = $_POST['termC'];
    $CompanyNameLL = $_POST['CompanyNameLL'];
    $quotation_id = $_GET['id']; // Assuming you're passing quotation_id in the URL

    // Update the main quotation record
    $qsql = mysqli_query($conn, "UPDATE quotationlist SET Clientid = '$Clientid', Subject = '$Subject', Reference = '$Reference',  tc = '$termC' WHERE quotation_id = '$quotation_id'");

    if ($qsql) {
        // Update or insert quotation products
        // First, delete the existing products
        $deleteProductsSql = mysqli_query($conn, "DELETE FROM quotationlistproduct WHERE quotation_id = '$quotation_id'");
        
        // Now, insert the updated products
        foreach ($_POST['productid'] as $key => $val) {
            $product_price = $_POST['product_price'][$key];
            $quantity = $_POST['quantity'][$key];
            $description = $_POST['description'][$key];
            $discountPrice = $_POST['discountPrice'][$key];

            $productsql = mysqli_query($conn, "INSERT INTO quotationlistproduct (quotation_id, prodcut_id, product_price, quantity, description,discountPrice, status) VALUES ('$quotation_id', '$val', '$product_price', '$quantity', '$description', '$discountPrice' , '0')");
        }

        // Update or insert the terms and conditions
        // First, delete the existing terms
        $deleteTermsSql = mysqli_query($conn, "DELETE FROM quotationlisttc WHERE quotation_id = '$quotation_id'");

        // Now, insert the updated terms
        foreach ($_POST['termC'] as $key => $val) {
            $productsql = mysqli_query($conn, "INSERT INTO quotationlisttc (quotation_id, tc_id, status) VALUES ('$quotation_id', '$val', '0')");
        }

        echo "<script>alert('Quotation updated successfully')</script>";
        echo "<script>window.location.href='quotation-list.php';</script>";
    } else {
        echo "<script>alert('Error updating quotation')</script>";
    }
}
?>


<?php
    }else{
        echo "<script>window.location.href='login/';</script>";
    }
?>