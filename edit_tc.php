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
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J3LMKC" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
    
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <?php include "inc/side_bar.php"; ?>
    <div class="layout-page">
        <?php include "inc/top_bar.php"; ?>
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="app-ecommerce">
                    <form method="POST">
                        <div class="card mb-6">
                            <div class="card-header">
                                <h5 class="card-tile mb-0">Edit Terms & Conditions</h5>
                            </div>
                            <div class="card-body">
                                <?php
                                if(isset($_GET['id'])) {
                                    $tc_id = $_GET['id'];
                                    $edit_query = mysqli_query($conn, "SELECT * FROM termsandconditionlist WHERE tc_id = '$tc_id'");
                                    $edit_data = mysqli_fetch_array($edit_query);
                                    
                                    // Get associated terms
                                    $terms_query = mysqli_query($conn, "SELECT * FROM terms WHERE tc_idd = '$tc_id'");
                                ?>
                                <input type="hidden" name="tc_id" value="<?php echo $tc_id; ?>">
                                
                                <div class="mb-6">
                                    <label class="form-label">Term & Condition Heading</label>
                                    <input type="text" class="form-control" name="termANDconditionTitle" 
                                           value="<?php echo $edit_data['termANDconditionTitle']; ?>">
                                </div>
                                
                                <?php while($term = mysqli_fetch_array($terms_query)) { ?>
                                    <div class="mb-6">
                                        <label class="form-label">Term & Condition Details</label>
                                        <input type="text" class="form-control" name="termANDcondition[]" 
                                               value="<?php echo $term['tc']; ?>">
                                    </div>
                                <?php } ?>
                                
                                <div id="show_partner"></div>
                      <button class="form-group row btn-add-input add_item_btn"  style="border:none;background:#008CBA;border-radius:7px;padding:10px;color:#fff;">Add T&C</button> <br>
                       <button class="form-group row btn-add-input remove_item_btn"  style="border:none;background:#008CBA;border-radius:7px;padding:10px;color:#fff;">Remove Last T&C</button>
                      <br>
                                <!-- Button to Remove Product -->
    <!--<button id="removeProductBtn" onclick="removeProduct()">Remove Last Product</button>-->
                                
                                <div class="mt-4" style="color:rgb(255, 255, 255); background:none; ">
                                    <button type="submit" class="btn btn-primary" name="update" value="Update">
                                        Update
                                    </button>    
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <?php
            if(isset($_POST['update'])) {
                $tc_id = $_POST['tc_id'];
                $termANDconditionTitle = $_POST['termANDconditionTitle'];
                
                // Update main title
                $update_main = mysqli_query($conn, "UPDATE termsandconditionlist SET 
                    termANDconditionTitle = '$termANDconditionTitle' 
                    WHERE tc_id = '$tc_id'");
                
                // Delete existing terms
                mysqli_query($conn, "DELETE FROM terms WHERE tc_idd = '$tc_id'");
                
                // Insert updated terms
                if(isset($_POST['termANDcondition'])) {
                    foreach($_POST['termANDcondition'] as $term) {
                        mysqli_query($conn, "INSERT INTO terms (tc_idd, tc) VALUES ('$tc_id', '$term')");
                    }
                }
                
                if($update_main) {
                    echo "<script>alert('Updated Successfully'); window.location.href='terms-and-condition-list.php';</script>";
                } else {
                    echo "<script>alert('Error Updating Terms & Conditions');</script>";
                }
            }
            ?>
        </div>
        <?php include "inc/footer.php"; ?>
    </div>
  </div>
</div>

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

<?php
    } else {
        echo "<script>window.location.href='login/';</script>";
    }
?>