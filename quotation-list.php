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
            

            
            <!-- Product List Table -->
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">All Quotation</h5>
                <div class="d-flex justify-content-between align-items-center row pt-4 gap-6 gap-md-0">
                  <div class="col-md-4 product_status"></div>
                  <div class="col-md-4 product_category"></div>
                  <a href="quatation-add.php"><div class="col-md-4 product_stock btn btn-primary">Add Quotation</div></a>
                  
                </div>
                <div class="d-flex justify-content-between align-items-center row pt-4 gap-6 gap-md-0">
                  <div class="col-md-4 product_status"></div>
                  <div class="col-md-4 product_category"></div>
                  <a href="draft_list.php"><div class="col-md-4 product_stock btn btn-primary">Draft List</div></a>
                  
                </div>
              </div>
              <div class="card-datatable table-responsive">
                  <div class="d-flex justify-content-between align-items-center row pt-4 gap-6 gap-md-0">
                  <div class="col-md-4 product_status"></div>
                  <div class="col-md-4 product_category"></div>
                   <form id="searchForm" method="POST">
                                        <input type="text" id="searchID" placeholder="Enter Company Name">
                                        <!--<input type="submit" name="submit" value="Search">-->
                                    </form>
                  
                </div>
                <table class="datatables-products table">
                  <thead class="border-top">
                    <tr>
                      <th></th>
                      <th>Quotation ID</th>
                      <th>Company Name</th>
                      <th>Total Amount</th>
                      <th>Date</th>
                      <th>Opration</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="clientListBody">

                  </tbody>
                </table>
                

              </div>
            </div>
            
           
                      </div>
                      <!-- / Content -->
<!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            // Fetch data when page loads
            fetchClientData();

            // Search functionality on keyup
            $("#searchID").on("keyup", function () {
                var search_item = $(this).val();

                $.ajax({
                    url: "search_quotation_ajax.php",
                    type: "POST",
                    data: { search: search_item },
                    success: function (data) {
                        $("#clientListBody").html(data);
                    }
                });
            });

            // Fetch client data function
            function fetchClientData() {
                $.ajax({
                    url: 'fetch_data_quotation_ajax.php',  // URL to your PHP file
                    type: 'GET',
                    success: function (data) {
                        // Display the fetched data
                        $('#clientListBody').html(data);
                    },
                    error: function () {
                        console.log("Error fetching data");
                    }
                });
            }
        });
    </script>
<?php include "inc/footer.php"; ?>

<?php
    }else{
        echo "<script>window.location.href='login/';</script>";
    }
?>