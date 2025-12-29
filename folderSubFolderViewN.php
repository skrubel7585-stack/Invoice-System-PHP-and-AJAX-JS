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
p{
  position: absolute;
  left: 14px;
  top: 35px;
  margin: 0%;
  font-family: 'Courier New', Courier, monospace;
  font-size: 17px;
  color: white;
    
}
/*-------------text ----x------- */

</style>              
<?php
$iDD = $_GET['id'];
$filN = $_GET['filename'];


        ?>
<table width="100%" border="1">
    <?php
      if($filN == 'Certificates'){  
    ?>
    <tr>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=Form9"><div class="folder"><p>Form 9</p></div></a>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=Form10"><div class="folder"><p>Form 10</p></div></a>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=Form11"><div class="folder"><p>Form 11</p></div></a>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=Form37"><div class="folder"><p>Form 37</p></div></a>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=Form26A"><div class="folder"><p>Form 26A</p></div></a>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=Centrifuge"><div class="folder"><p>Centrifuge</p></div></a>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=OvenandDryer"><div class="folder"><p>Oven & Dryer</p></div></a>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=CharteredEngineerCertificate"><div class="folder"><p>Chartered Engineer Certificate</p></div></a>
    </tr>
    <?php } elseif ($filN == 'SafetyReports'){ ?>
    
    <tr>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=SafetyAudit"><div class="folder"><p>Safety Audit</p></div></a>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=SafetyTraining"><div class="folder"><p>Safety Training</p></div></a>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=SafetyBooklet"><div class="folder"><p>Safety Booklet</p></div></a>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=HazopStudy"><div class="folder"><p>Hazop Study</p></div></a>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=RiskAssessement"><div class="folder"><p>Risk Assessement</p></div></a>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=FirstAidTraining"><div class="folder"><p>First Aid Training</p></div></a>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=MockDrill"><div class="folder"><p>Mock Drill</p></div></a>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=Stability"><div class="folder"><p>Stability</p></div></a>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=ApprovedFactoryPlan"><div class="folder"><p>Approved Factory Plan</p></div></a>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=FactoryLicense"><div class="folder"><p>Factory License</p></div></a>
    </tr>
    <?php } elseif ($filN == 'PESO'){ ?>
    
    <tr>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=Form18"><div class="folder"><p>Form 18</p></div></a>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=Form19"><div class="folder"><p>Form 19</p></div></a>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=Form126"><div class="folder"><p>Form 126</p></div></a>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=Form130"><div class="folder"><p>Form 130</p></div></a>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=PriorAppoval"><div class="folder"><p>Prior Appoval</p></div></a>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=FinalGrant"><div class="folder"><p>Final Grant</p></div></a>
    </tr>
    
    <?php } elseif ($filN == 'GPCB'){ ?>
    
    <tr>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=ConsenttoEstabilishment"><div class="folder"><p>Consent to Estabilishment</p></div></a>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=ConsenttoOperate"><div class="folder"><p>Consent to Operate</p></div></a>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=EnviromentClearence"><div class="folder"><p>Enviroment Clearence </p></div></a>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=AmbientAirQuality"><div class="folder"><p>Ambient Air Quality </p></div></a>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=AmbientNoiseMonitoring"><div class="folder"><p>Ambient Noise Monitoring</p></div></a>
        <a href="cerotherFIleView.php?id=<?php echo $iDD; ?>&filename=<?php echo $filN; ?>&SubF=AmbientStackMonitoring"><div class="folder"><p>Ambient Stack Monitoring</p></div></a>
    </tr>
    <?php } ?>
</table>

        
        <?php
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