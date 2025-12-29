<?php
session_start();
include "db/conn.php";

$username = $_SESSION['username'];
$pass = $_SESSION['pass'];

$adminsql = mysqli_query($conn, "SELECT * FROM user WHERE email = '$username' AND pass = '$pass'");
$adminfetch = mysqli_fetch_array($adminsql);

if($username && $pass) {
?>

<?php include "inc/header.php"; ?>    

<!-- ?PROD Only: Google Tag Manager (noscript) (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J3LMKC" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">

    <?php include "inc/side_bar.php"; ?>

    <!-- Layout container -->
    <div class="layout-page">

      <?php include "inc/top_bar.php"; ?>

      <!-- Content wrapper -->
      <div class="content-wrapper">
<?php
    $id = $_GET['id'];
    $desql = mysqli_query($conn, "select * from productlist where product_id = '$id'");
    $fetcj = mysqli_fetch_array($desql);
?>
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

          <div class="app-ecommerce">
            <form method="POST">
              <!-- Add Product -->
              <div class="flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
                <div class="row">
                  <!-- First column -->
                  <div class="col-12 col-lg-12">
                    <!-- Product Information -->
                    <div class="card mb-6">
                      <div class="card-header">
                        <h5 class="card-title mb-0">Product Add</h5>
                      </div>
                      <div class="card-body">
                        <div class="mb-6">
                          <label class="form-label" for="ecommerce-product-name">Product Name</label>
                          <input type="text" class="form-control" id="ecommerce-product-name" placeholder="Product Name" value="<?php echo $fetcj['productName'] ?>" name="productName" aria-label="Product title">
                        </div>
                        <div class="row mb-6">
                          <div class="col">
                            <label class="form-label" for="ecommerce-product-sku">HSN/SAC</label>
                            <input type="text" class="form-control" id="ecommerce-product-sku" placeholder="HSN/SAC Number" value="<?php echo $fetcj['hsnSACNumber'] ?>" name="hsnSACNumber">
                          </div>
                          <div class="col">
                            <label class="form-label" for="ecommerce-product-barcode">Unit</label>
                            <input type="text" class="form-control" id="ecommerce-product-barcode" placeholder="Unit" value="<?php echo $fetcj['unit'] ?>" name="unit">
                          </div>
                        </div>
                        <div class="mb-6">
                          <label class="form-label" for="ecommerce-product-name">Product Rate</label>
                          <input type="text" class="form-control" id="ecommerce-product-name" placeholder="Product Rate" value="<?php echo $fetcj['productRate'] ?>" name="productRate" aria-label="Product title">
                        </div>
                        <!-- Description -->
                        <div>
                          <label class="mb-1">Description</label>
                          <input class="form-control p-0" name="note" value="<?php echo $fetcj['note'] ?>">
                        </div><br><br>
                        <div class="col">
                          <input type="submit" class="btn btn-primary" value="Submit" name="submit" style="background:#7367f0; border-radius:40px; border:none;">
                        </div>
                      </div>
                    </div>
                    <!-- /Product Information -->
                  </div>
                  <!-- /First column -->
                </div>
              </div>
            </form>
          </div>

          <?php
          if(isset($_POST['submit'])) {
            $productName = mysqli_real_escape_string($conn, $_POST['productName']);
            $hsnSACNumber = mysqli_real_escape_string($conn, $_POST['hsnSACNumber']);
            $unit = mysqli_real_escape_string($conn, $_POST['unit']);
            $productRate = mysqli_real_escape_string($conn, $_POST['productRate']);
            $note = mysqli_real_escape_string($conn, $_POST['note']);

            $GSTPercentage = 18;
            $gstamount = ($productRate * $GSTPercentage) / 100;

            $inssql = mysqli_query($conn, "update productlist set productName = '$productName', hsnSACNumber = '$hsnSACNumber', unit = '$unit', productRate = '$productRate', note = '$note', gstamount = '$gstamount' where product_id = '$id'");
            
            if($inssql) {
              echo "<script>alert('Successfully Added');</script>";
              echo "<script>window.location.href='product_list.php';</script>";
            }
          }
          ?>
          <!-- /Content -->

          <?php include "inc/footer.php"; ?>

        </div>
      </div>
    </div>
  </div>
</div>

<?php
} else {
  echo "<script>window.location.href='login/';</script>";
}
?>
