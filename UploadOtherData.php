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
<?php
    $iddD = $_GET['id'];
    $fileNamE = $_GET['fileName'];
    $SubFName = $_GET['SubF'];
?>
        <!-- Content -->
        
        <div class="container-xxl flex-grow-1 container-p-y">
            
            
            <div class="app-ecommerce">
<form method="POST" enctype="multipart/form-data">
  <!-- Add Product -->
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
    <div class="row">
      <!-- First column-->
      <div class="col-12 col-lg-12">
        <!-- Product Information -->
        <div class="card mb-6">
          <div class="card-header">
            <h5 class="card-title mb-0">Upload Data in <?php echo $fileNamE; ?></h5>
          </div>
          <div class="card-body">
            <div class="mb-6">
              <label class="form-label" for="ecommerce-product-name">File</label>
              <input type="file" class="form-control" id="ecommerce-product-name" name="file[]" accept="image/*" capture="environment" aria-label="Product title" required multiple>
            </div>
            <input type="hidden" value="<?php echo $fileNamE; ?>" name="fileN">
            <input type="hidden" value="<?php echo $iddD; ?>" name="idD">
            <br>
            <div class="col">
              <input type="submit" class="btn btn-primary" value="Submit" name="submit" style="background:#7367f0;border-radius:40px;border:none;">
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
// Include your database connection file
// Assuming $conn is the connection to your MySQL database

if (isset($_POST['submit'])) {
    // Get form data
    $fileN = $_POST['fileN'];
    $idD = $_POST['idD'];
    $uploadDirectory = "upload/"; // Define where you want to save the uploaded files

    // Insert data into the database
    $inssql = mysqli_query($conn, "INSERT INTO otherFolder (clientNameID, folderFilename,SubFName) VALUES ('$idD', '$fileN', '$SubFName')");
        
    if ($inssql) {
        $last_id = $conn->insert_id; // Get the last inserted ID
        
        
        foreach ($_FILES['file']['name'] as $key => $val) {
            move_uploaded_file($_FILES['file']['tmp_name'][$key], $uploadDirectory . $val);
            $ssinsert = mysqli_query($conn, "INSERT INTO otherfolderDoc (rowID, fileName) 
                VALUES ('$last_id', '$val')");
        }
       
                                echo "Image uploaded and saved to database: $file_name<br>";
                                echo "<script>alert('Successfully Added');</script>";
                            
       
        // Success message after inserting into database
        
    } else {
        echo "Error inserting data into the database.<br>";
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