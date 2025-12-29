<?php
session_start();
include "db/conn.php";

// Verify user credentials
if (isset($_SESSION['username']) && isset($_SESSION['pass'])) {
    $username = $_SESSION['username'];
    $pass = $_SESSION['pass'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ? AND pass = ?");
    $stmt->bind_param("ss", $username, $pass);
    $stmt->execute();
    $adminfetch = $stmt->get_result()->fetch_array();

    if ($adminfetch) {
        include "inc/header.php"; 
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" />

<script>
    $(document).ready(function() {
        $(".progLang2, .progLang1").chosen({ tags: true });

        $("#myDropdown, #tcdropdown").on("change", function() {
            var selectedValue = $(this).val();
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

        // Search functionality for company
        $("#myDropdown").on("keyup", function () {
            var search_item = $(this).val();

            $.ajax({
                url: "search_company_ajax.php",
                type: "POST",
                data: { search: search_item },
                success: function (data) {
                    $("#clientListBody").html(data);
                }
            });
        });
    });
</script>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php
        //  include "inc/side_bar.php"; 
        ?>
        <div class="layout-page">
            <?php include "inc/top_bar.php"; ?>
            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="app-ecommerce">
                        <form method="POST">
                            <div class="flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
                                <div class="row">
                                    <div class="col-12 col-lg-12">
                                        <div class="card mb-6">
                                            <div class="card-header">
                                                <h5 class="card-tile mb-0">Invoice Add</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-6">
                                                    <label class="form-label" for="ecommerce-product-name">Company Name</label>
                                                    <select class="progLang1 form-control" data-placeholder="Choose a Company..." name="Clientid" id="myDropdown" required>
                                                        <option>Select Company</option>
                                                        <?php
                                                            $codsql = mysqli_query($conn, "SELECT * FROM clientlist");
                                                            while ($coddata = mysqli_fetch_array($codsql)) {
                                                                echo "<option value='".$coddata['cid']."'>".$coddata['companyName']."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div id="result"></div>

                                                <div class="mb-6">
                                                    <label class="form-label" for="subject">Subject</label>
                                                    <input type="text" class="form-control" placeholder="Subject" name="Subject" required>
                                                </div>

                                                <div class="mb-6">
                                                    <label class="form-label" for="reference">Reference</label>
                                                    <input type="text" class="form-control" placeholder="Reference" name="Reference">
                                                </div>

                                                <div class="mb-6">
                                                    <label class="form-label" for="product-name">Product Name</label>
                                                    <select class="progLang2 form-control" data-placeholder="Choose a Product..." name="productid[]" required>
                                                        <option>Select Product</option>
                                                        <?php
                                                            $codsql = mysqli_query($conn, "SELECT * FROM productlist");
                                                            while ($coddata = mysqli_fetch_array($codsql)) {
                                                                echo "<option value='".$coddata['product_id']."'>".$coddata['productName']." - Price: ".$coddata['productRate']."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="mb-6">
                                                    <label class="form-label" for="product-price">Product Price</label>
                                                    <input type="text" name="product_price[]" class="form-control" placeholder="Price" required>
                                                </div>

                                                <div class="mb-6">
                                                    <label class="form-label" for="discount-price">Discount Price</label>
                                                    <input type="text" name="discount_price[]" class="form-control" placeholder="Discount Price">
                                                </div>

                                                <div class="mb-6">
                                                    <label class="form-label" for="quantity">Product Quantity</label>
                                                    <input type="text" name="quantity[]" class="form-control" placeholder="Quantity" required>
                                                </div>

                                                <div class="mb-6">
                                                    <label class="form-label" for="description">Product Description</label>
                                                    <input type="text" name="description[]" class="form-control" placeholder="Description (Optional)">
                                                </div>

                                                <div id="show_partner"></div>
                                                <button class="btn-add-input add_item_btlnll" style="background:#008CBA;border-radius:7px;padding:10px;color:#fff;">Add Product</button>
                                                <br><br><br>
                                                <button class="btn-add-input remove_item_btn" style="background:#008CBA;border-radius:7px;padding:10px;color:#fff;">Remove Last Product</button>

                                                <div class="col">
                                                    <input type="submit" class="btn btn-primary" value="Submit" name="submit" style="background:#7367f0;border-radius:40px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var inputCounter = 0;

        // Add Product Field
        $(".add_item_btlnll").click(function (e) {
            e.preventDefault();
            inputCounter++;
            $("#show_partner").append(`<div class="mb-6 product-item">
                <label class="form-label" for="product-name-${inputCounter}">Product Name</label>
                <select class="progLang2 form-control" name="productid[]" required>
                    <option>Select Product</option>
                    <?php
                        $codsql = mysqli_query($conn, "SELECT * FROM productlist");
                        while($coddata = mysqli_fetch_array($codsql)) {
                    ?>
                        <option value="<?php echo $coddata['product_id'] ?>"><?php echo $coddata['productName'] ?> - Price: <?php echo $coddata['productRate'] ?></option>
                    <?php } ?>
                </select>
                <label class="form-label" for="product-price-${inputCounter}">Product Price</label>
                <input type="text" name="product_price[]" class="form-control" placeholder="Price" required>
                <label class="form-label" for="quantity-${inputCounter}">Product Quantity</label>
                <input type="text" name="quantity[]" class="form-control" placeholder="Quantity">
                <label class="form-label" for="discount-price-${inputCounter}">Discount Price</label>
                <input type="text" name="discountPrice[]" class="form-control" placeholder="Discount Price">
                <label class="form-label" for="description-${inputCounter}">Product Description</label>
                <input type="text" name="description[]" class="form-control" placeholder="Description">
            </div>`);
        });

        // Remove Product Field
        $(".remove_item_btn").click(function (e) {
            e.preventDefault();
            if (inputCounter > 0) {
                $(".product-item").last().remove();
                inputCounter--;
            } else {
                alert("No items to remove!");
            }
        });
    });
</script>

<?php
        // Process Form Submission
        if (isset($_POST['submit'])) {
            // Sanitized inputs
            $Clientid = $_POST['Clientid'];
$SiTeAddress = $_POST['SiTeAddress'] ?? '';
$Subject = htmlspecialchars($_POST['Subject'], ENT_QUOTES, 'UTF-8');
$Reference = htmlspecialchars($_POST['Reference'], ENT_QUOTES, 'UTF-8');
$CompanyNameLL = $_POST['CompanyNameLL'] ?? '';

// SQL query using mysqli_query (without prepared statements)
$sql = "INSERT INTO invList (clientid, clientNameId, subject, reference, siteAdress, status) 
        VALUES ('$Clientid', '$CompanyNameLL', '$Subject', '$Reference', '$SiTeAddress', '0')";

// Execute the query
if (mysqli_query($conn, $sql)) {
    $last_id = mysqli_insert_id($conn); // Get the last inserted ID

            
                $genid = rand(10000, 99999) . $last_id;
                $stmt = $conn->prepare("UPDATE invList SET inv_genId = ? WHERE invid = ?");
                $stmt->bind_param("si", $genid, $last_id);
                $stmt->execute();

                foreach ($_POST['productid'] as $key => $val) {
                    $product_price = $_POST['product_price'][$key];
                    $quantity = $_POST['quantity'][$key];
                    $description = $_POST['description'][$key];
                    $discount_price = $_POST['discount_price'][$key];

                    $stmt = $conn->prepare("INSERT INTO invProduct (inv_ID, product_ID, product_Price, discountPrice, quantity, description) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("iisiis", $last_id, $val, $product_price, $discount_price, $quantity, $description);
                    $stmt->execute();
                }

                echo "<script>alert('Successfully Added to Database')</script>";
            }
        }
    } else {
        echo "<script>window.location.href='login/';</script>";
    }
} else {
    echo "<script>window.location.href='login/';</script>";
}
?>
