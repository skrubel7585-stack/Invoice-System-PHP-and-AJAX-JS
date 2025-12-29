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



    

    
    
    <!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar  ">
  <div class="layout-container">

    <?php include "inc/side_bar.php"; ?>

    <!-- Layout container -->
    <div class="layout-page">
    <script>
    $(document).ready(function() {
        // Initialize Chosen ONLY for product dropdowns (progLang2)
        // Removed .progLang1 (which was #myDropdown)
        $(".progLang2").chosen({ tags: true });

        // ======= Tom Select Integration: Step 3 - Activate Tom Select =======
        new TomSelect("#myDropdown", {
            placeholder: "Choose a Company...",
            allowEmptyOption: true,
            maxOptions: 1000 // Adjust if needed
            // Tom Select has many other options: create, plugins, render, etc.
        });
        // ==================================================================

        // Existing AJAX call when a company is selected
        // Standard 'change' event usually works fine with Tom Select
        $("#myDropdown, #tcdropdown").on("change", function() {
            var selectedValue = $(this).val();
            // Ensure selectedValue is not empty if allowEmptyOption is true
            if (!selectedValue) {
                $("#result").html(''); // Clear result if empty option selected
                 $("#tcdropdownList").html(''); // Clear TC result if empty TC selected
                return; // Stop if no value is selected
            }

            var url = $(this).attr('id') === "myDropdown" ? "process2.php" : "process3.php";
            var resultDiv = $(this).attr('id') === "myDropdown" ? "#result" : "#tcdropdownList";

            $.ajax({
                url: url,
                type: "POST",
                data: { value: selectedValue },
                success: function(response) {
                    $(resultDiv).html(response);
                },
                error: function(xhr, status, error) {
                    $(resultDiv).html("An error occurred: " + error);
                }
            });
        });

        // ======= Tom Select Integration: Step 2 - Remove Redundant Search Code =======
        // Removed the $("#myDropdown").on("keyup", ...) AJAX search block.
        // Tom Select handles the searching internally.
        // =========================================================================
    });
</script>
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
                      <h5 class="card-tile mb-0">Quatation Add</h5>
                    </div>
                    <div class="card-body">
                      <div class="mb-6">
                        <label class="form-label" for="ecommerce-product-name">Company Name</label>
                        <select class="progLang2 form-control" data-placeholder="Choose a Company..." id="myDropdown" name="Clientid" required>
                          <option>Select Company</option>
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
                        <input type="text" class="form-control" id="ecommerce-product-name" placeholder="Subject" name="Subject" aria-label="Product title">
                      </div>
                      

                      <div class="mb-6">
                        <label class="form-label" for="ecommerce-product-name">Reference</label>
                        <input type="text" class="form-control" id="ecommerce-product-name" placeholder="Reference" name="Reference" aria-label="Product title">
                      </div>

                      <div class="mb-6">
        <label class="form-label" for="ecommerce-product-name">Product Name</label>
        <select type="text" class="form-control anyname" name="productid[]" aria-label="Product title" required>
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
        <label class="form-label" for="product-price">Product Price (Please Put the Price)</label>
        <input type="text" name="product_price[]" class="form-control" placeholder="Price" required> 
    </div>
    <div class="mb-6">
        <label class="form-label" for="product-price">Product Quantity</label>
        <input type="text" name="quantity[]" class="form-control" placeholder="Quantity" required>
    </div>
        <div class="mb-6">
        <label class="form-label" >Discount Amount</label>
        <input type="text" name="discountPrice[]" class="form-control" placeholder="Discount Amount" value="0">
    </div>
    <div class="mb-6">
        <label class="form-label" for="product-price">Product description (Optional)</label>
        <input type="text" name="description[]" class="form-control" placeholder="description" >
    </div>
<br>
                      
                        <div id="show_partner"></div>
                        <button class="btn-add-input add_item_btn" style="border:none;background:#008CBA;border-radius:7px;padding:10px;color:#fff;">Add Product</button>
                        <button class="btn-add-input remove_item_btn" style="border:none;background:#008CBA;border-radius:7px;padding:10px;color:#fff;">Remove Last Product</button>
                        <br><br>
                      
                       <div class="mb-6">
                        <label class="form-label" for="ecommerce-product-name">Term & Condition Heading</label>
                        <select type="text" class="form-control anyname" id="tcdropdown" placeholder="Company Name" name="termC[]" aria-label="Product title" required>
                          <option>Select Term & Condition Heading</option>
                          <?php
                            $codsql = mysqli_query($conn, "select * from termsandconditionlist");
                            foreach($codsql as $coddata){
                          ?>
                          <option value="<?php echo $coddata['tc_id'] ?>"><a href="?action=edit&Id=<?php echo $coddata['tc_id'] ?>"><?php echo $coddata['termANDconditionTitle'] ?></a></option>
                          <?php } ?>
                        </select>
                      </div>
                      
                      <!--<div id="tcdropdownList"></div>-->
             
                <!-- <div class="mb-6">
                        <label class="form-label" for="ecommerce-product-name">Term & Condition Details</label>
                        <input type="text" class="form-control" id="" placeholder="Enter Term & Condition Details" name="termCD[]" aria-label="Product title">
                      </div> -->
                      
                     <div id="show_partnller"></div>
                        <button class="btn-add-input add_item_btln" style="border:none;background:#008CBA;border-radius:7px;padding:10px;color:#fff;">Add T&C</button><br><br>
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
        <input type="text" name="discountPrice[]" class="form-control" placeholder="Discount Amount" value="0">
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
            <script src="chosen/js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="chosen/js/chosen.jquery.js" type="text/javascript"></script>


    <script>
        $(".anyname").chosen();
    </script>
    
<?php include "inc/footer.php"; ?>

<?php
  if(isset($_POST['submit'])){
    $Clientid = $_POST['Clientid'];
    $SiTeAddress = $_POST['SiTeAddress'];
    $Subject = $_POST['Subject'];
    $Reference = $_POST['Reference'];
    $termC = $_POST['termC'];
    $CompanyNameLL = $_POST['CompanyNameLL'];

    $qsql = mysqli_query($conn, "insert into quotationlist (Clientid,ClienNAmeID,Subject,Reference,SiTeAddress,tc,status) values ('$Clientid' , '$CompanyNameLL' , '$Subject' , '$Reference' , '$SiTeAddress' , '$termC' , '0')");
    if($qsql){
      $last_id = $conn->insert_id;
      $genid = rand(00000,99999).$last_id;
      $qsqlupdate = mysqli_query($conn, "update quotationlist set quotation_gen_id = '$genid' where quotation_id = '$last_id'");
      if($qsqlupdate){
        foreach ($_POST['productid'] as $key => $val) {
          $product_price = $_POST['product_price'][$key];
          $quantity = $_POST['quantity'][$key];
          $discountPrice = $_POST['discountPrice'][$key];
          $description = $_POST['description'][$key];
          
          $productsql = mysqli_query($conn, "insert into quotationlistproduct (quotation_id,prodcut_id,product_price,quantity,description,discountPrice,status) values ('$last_id' , '$val' , '$product_price' , '$quantity' , '$description' , '$discountPrice' , '0')");
        }
        foreach ($_POST['termC'] as $key => $val) {
          
          $productsql = mysqli_query($conn, "insert into quotationlisttc (quotation_id,tc_id,status) values ('$last_id' , '$val' , '0')");
        }

        

        echo "<script>alert('Successfully Add on Database')</script>";
      }
    }
  }
?>

<?php
    }else{
        echo "<script>window.location.href='login/';</script>";
    }
?>