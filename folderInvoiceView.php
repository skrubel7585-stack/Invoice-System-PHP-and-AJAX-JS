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
            

            <div class="card-header">
                <h5 class="card-title">Welcome </h5>
                <div class="d-flex justify-content-between align-items-center row pt-4 gap-6 gap-md-0">
                  <div class="col-md-4 product_status"></div>
                  <div class="col-md-4 product_category"></div>
                  
                </div>
              </div>
              
<style>
    /*------------- folder box----------- */
.folder {
    width: 150px;
    height: 105px;
    margin: 50px 50px;
    float: left;
    position: relative;
    background: rgb(110,166,239);
    background: linear-gradient(183deg, rgba(110,166,239,1) 11%, rgba(30,92,172,1) 100%);
    border-radius: 0 6px 6px 6px;
    transition: 0.10s ease-out;
    /* box-shadow: 4px 4px 7px rgba(0, 0, 0, 0.59); */
}
/*-------------folder box----x------- */
.folder:hover{
  transform: scale(1.2);
}
/*-------------file opener----------- */
.folder:before {
    content: '';
    width: 46%;
    height: 21px;
    clip-path: polygon(0% 0%, 75% 0%, 100% 50%, 75% 100%, 0% 100%);
    border-radius: 4px 0px 0 0;
    background-color: #1e5cac;
    position: absolute;
    top: -10.3px;
    left: 0px;
}
/*-------------file opener----x------- */

/*------------- Document ----------- */
.folder:after {
    content: '';
    width: 29%;
    height: 5px;
    border-radius: 2px 2px 0 0;
    background-color: #ffffff;
    position: absolute;
    top: 5.6px;
    left: 4px;
}
/*-------------Document ----x------- */

/*------------- text  ----------- */
td{
    border: 1px solid #000;
}
/*-------------text ----x------- */

</style>              
<?php
$iDD = $_GET['id'];

// Perform the SQL query
$Sql = mysqli_query($conn, "SELECT * FROM invList WHERE clientid = '$iDD'");

// Check if the query returned any rows
if (mysqli_num_rows($Sql) > 0) {
    // Loop through the result set and display the link
    while ($SqlData = mysqli_fetch_assoc($Sql)) {
        ?>
         <table border="1" width="100%">
            <tr>
                <td width="35%" align="center"> 
                    <a href="invprint.php?id=<?php echo $SqlData['invid']; ?>">
                        
                            <p class="btn btn-primary">View</p>
                        
                    </a>
                </td>
                <td width="10%" align="center"><p style="color:#000;"><?php echo $SqlData['inv_genId']; ?></p></td>
                <td  width="25%" align="center">
                    <?php
                        $Clie = $SqlData['clientNameId'];
                        $SDFs = mysqli_query($conn,"select * from contact_person where id = '$Clie'");
                        $cdF = mysqli_fetch_array($SDFs);
                    ?>
                    
                            <span style="color:#000;"><?php echo $cdF['name']; ?></span>
                     
                </td>
                <td width="30%" align="center">
                    
                    <span style="color:#000;"><?php echo $SqlData['invdate']; ?></span>
                       
                </td>
            </tr>
        </table>
       
        <?php
    }
} else {
    // If no data is found, show an alert
    echo "<script>alert('Your Data Not Available');</script>";
    echo "Your Data Not Available";
}
?>

  <!--<a href="folderInvoiceView.php?id=<?php echo $iDD; ?>"><div class="folder"><p>Invoice</p></div></a>-->
  <!--<div class="folder"><p>2</p></div> -->
  <!--<div class="folder"><p>2</p></div>-->


            
            
                      </div>
                      <!-- / Content -->

<?php include "inc/footer.php"; ?>

<?php
    }else{
        echo "<script>window.location.href='login/';</script>";
    }
?>