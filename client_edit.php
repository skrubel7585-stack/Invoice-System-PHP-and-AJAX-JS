<?php
session_start();
include "db/conn.php";
$username = $_SESSION['username'];
$pass = $_SESSION['pass'];

// Verifying user session and credentials
$adminsql = mysqli_query($conn, "SELECT * FROM user WHERE email = '$username' AND pass = '$pass'");
$adminfetch = mysqli_fetch_array($adminsql);
if ($username && $pass) {
    include "inc/header.php"; 
?>

<!-- Layout wrapper starts -->
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">

    <?php include "inc/side_bar.php"; ?>

    <div class="layout-page">
        <?php include "inc/top_bar.php"; ?>
        
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                
<?php
$id = $_GET['id'];
$desql = mysqli_query($conn, "SELECT * FROM clientlist WHERE cid = '$id'");
$fetcj = mysqli_fetch_array($desql);
?>
                <div class="app-ecommerce">
                    <form method="POST">
                        <div class="flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <div class="card mb-6">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Client Add</h5>
                                        </div>
                                        <div class="card-body">
<?php
$cliendID = mysqli_query($conn,"SELECT * FROM contact_person WHERE clientlistID = '$id'");
foreach($cliendID as $cliendIDDATA){ 
?>
                                            <div class="mb-6">
                                                <label class="form-label" for="clientName">Contact Person</label>
                                                <input type="text" class="form-control" id="clientName" value="<?php echo $cliendIDDATA['name'] ?>" name="clientName[]" placeholder="Client Name" aria-label="Product title" >
                                            </div>
                                            <div class="mb-6">
                                                <label class="form-label" for="clientName">Contact Person Password</label>
                                                <input type="text" class="form-control" id="clientName" value="<?php echo $cliendIDDATA['pass'] ?>" name="pass[]" placeholder="Client Name" aria-label="Product title" >
                                            </div>
                                            <div class="row mb-6">
                                                <div class="col"><label class="form-label" for="phone">Phone Number</label>
                                                    <input type="text" class="form-control" id="phone" value="<?php echo $cliendIDDATA['phone'] ?>" name="phoneNumber[]" placeholder="Phone Number"></div>
                                                <div class="col"><label class="form-label" for="email">Email</label>
                                                    <input type="text" class="form-control" id="email" value="<?php echo $cliendIDDATA['email'] ?>" name="email[]" placeholder="Email Address"></div>
                                            </div>
<?php
}
?>
<div id="show_partnllerll"></div>
                      <button class="form-group row btn-add-input add_item_btlnll"  style="border:none;background:#008CBA;border-radius:7px;padding:10px;color:#fff;">Add Contact Person</button>
                      <br>
                       <button class="form-group row btn-add-input remove_item_btn"  style="border:none;background:#008CBA;border-radius:7px;padding:10px;color:#fff;">Remove Contact Person</button><br><br>
                                            <div class="mb-6">
                                                <label class="form-label" for="companyName">Company</label>
                                                <input type="text" class="form-control" id="companyName" value="<?php echo $fetcj['companyName'] ?>" name="companyName" placeholder="Company" aria-label="Product title">
                                            </div>

                                            <div class="row mb-6">
                                                <div class="col"><label class="form-label" for="clientGst">Client GST</label>
                                                    <input type="text" class="form-control" id="clientGst" value="<?php echo $fetcj['clientGst'] ?>" name="clientGst" placeholder="Client GST"></div>
                                                <div class="col"><label class="form-label" for="panNumber">PAN</label>
                                                    <input type="text" class="form-control" id="panNumber" value="<?php echo $fetcj['panNumber'] ?>" name="panNumber" placeholder="PAN Number"></div>
                                            </div>

                                            <div class="mb-6">
                                                <label class="form-label" for="address">Bill Address</label>
                                                <input type="text" class="form-control" id="address" value="<?php echo $fetcj['Address'] ?>" name="Address" placeholder="Address" aria-label="Product title">
                                            </div>

                                            <div id="show_partnller"></div>
                      <button class="form-group row btn-add-input add_item_btln"  style="border:none;background:#008CBA;border-radius:7px;padding:10px;color:#fff;">Add Site Address</button>
                      <br>
                       <button class="form-group row btn-add-input remove_item_btnk"  style="border:none;background:#008CBA;border-radius:7px;padding:10px;color:#fff;">Remove Last Site Address</button>
                      
                                            <br><br>
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
            <div  class="mb-6">
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
// Database Update Logic
if (isset($_POST['submit'])) {
    $companyName = $_POST['companyName'];
    $clientGst = $_POST['clientGst'];
    $panNumber = $_POST['panNumber'];
    $address = $_POST['Address'];

    // Start transaction
    $conn->autocommit(false);
    
    try {
        // Update client details
        $stmt = $conn->prepare("UPDATE clientlist SET companyName = ?, clientGst = ?, panNumber = ?, Address = ? WHERE cid = ?");
        $stmt->bind_param("ssssi", $companyName, $clientGst, $panNumber, $address, $id);
        $stmt->execute();
        $stmt->close();

        // Remove existing contact persons
        $stmt = $conn->prepare("DELETE FROM contact_person WHERE clientlistID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        // Insert new contact persons
        if (isset($_POST['clientName']) && is_array($_POST['clientName'])) {
            $stmt = $conn->prepare("INSERT INTO contact_person (clientlistID, name, phone, email,pass) VALUES (?, ?, ?, ?, ?)");

            foreach ($_POST['clientName'] as $key => $clientName) {
                $name = trim($clientName);
                $phone = trim($_POST['phoneNumber'][$key]);
                $email = trim($_POST['email'][$key]);
                $pass = trim($_POST['pass'][$key]);

                if (!empty($name) && !empty($phone) && !empty($email)) {
                    $stmt->bind_param("issss", $id, $name, $phone, $email, $pass);
                    $stmt->execute();
                }
            }
            $stmt->close();
        }

        // Insert site addresses (if any)
        if (isset($_POST['SiteAddress']) && is_array($_POST['SiteAddress'])) {
            foreach ($_POST['SiteAddress'] as $siteAddress) {
                $siteAddress = trim($siteAddress);
                if (!empty($siteAddress)) {
                    $stmt = $conn->prepare("INSERT INTO siteAddress (client_id, address) VALUES (?, ?)");
                    $stmt->bind_param("is", $id, $siteAddress);
                    $stmt->execute();
                }
            }
        }

        // Commit transaction
        $conn->commit();
        echo "<script>alert('Successfully Updated');</script>";
        echo "<script>window.location.href='client_list.php';</script>";
    } catch (Exception $e) {
        // Rollback on error
        $conn->rollback();
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>

            </div>
        </div>
    </div>
</div>

<?php
} else {
    echo "<script>window.location.href='login/';</script>";
}
?>
