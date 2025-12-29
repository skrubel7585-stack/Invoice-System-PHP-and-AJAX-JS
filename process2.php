<?php
include "db/conn.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if 'value' is set in the POST request
    if (isset($_POST['value'])) {
        $value = htmlspecialchars($_POST['value']); // Sanitize the input value
        
        // Example processing based on the selected value
        
        // echo $value;
        
// Fetch the phone number from the database
$sql = mysqli_query($conn, "SELECT * FROM clientlist WHERE cid = '$value'");
$fetch = mysqli_fetch_array($sql);
$sqll = mysqli_query($conn, "SELECT * FROM contact_person WHERE clientlistID = '$value'");
$fetchl = mysqli_fetch_array($sqll);
// Check if the fetch was successful
if ($fetch) {
    $number = htmlspecialchars($fetch["cid"]); // Sanitize the phone number
} else {
    $number = ''; // Default value if no record is found
}
?>
<div class="row mb-6">
<label class="col-sm-2 col-form-label" style="color:#000;">Contact Person</label>
<div class="col-sm-10">
    <select name="CompanyNameLL" class="form-control autonumber" required>
        <option selected disabled>Select Contact Person</option>
        <?php
            $siteAdd = $fetch['cid'];
            $sidsql = mysqli_query($conn, "select * from contact_person where clientlistID = '$siteAdd'");
            foreach($sidsql as $sidsqldata){ ?>
                <option value="<?php echo $sidsqldata['id']; ?>"><?php echo $sidsqldata['name']; ?></option>
        <?php    }
        ?>
    </select>
</div>
</div>
<div class="row mb-6">
<label class="col-sm-2 col-form-label" style="color:#000;">GST</label>
<div class="col-sm-10">
    <input type="tel" placeholder="<?php echo $fetch['clientGst']; ?>" value="<?php echo $fetch['clientGst']; ?>" id="" name="ClientName" class="form-control autonumber" required>
</div>
</div><br>

<!--<div class="row mb-6">-->
<!--<label class="col-sm-2 col-form-label" style="color:#000;">Phone</label>-->
<!--<div class="col-sm-10">-->
<!--    <input type="tel" placeholder="<?php echo $fetch['phoneNumber']; ?>" value="<?php echo $fetchl['phone']; ?>" id="" name="Clientphone" class="form-control autonumber" required>-->
<!--</div>-->
<!--</div><br>-->

<!--<div class="row mb-6">-->
<!--<label class="col-sm-2 col-form-label" style="color:#000;">email</label>-->
<!--<div class="col-sm-10">-->
<!--    <input type="tel" placeholder="<?php echo $fetch['email']; ?>" value="<?php echo $fetchl['email']; ?>" id="" name="clientEmail" class="form-control autonumber" required>-->
<!--</div>-->
<!--</div><br>-->

<div class="row mb-6">
<label class="col-sm-2 col-form-label" style="color:#000;">Address</label>
<div class="col-sm-10">
    <input type="tel" placeholder="<?php echo $fetch['Address']; ?>" value="<?php echo $fetch['Address']; ?>" id="" name="Address" class="form-control autonumber" required>
</div>
</div>
<div class="row mb-6">
<label class="col-sm-2 col-form-label" style="color:#000;">Select Site Address</label>
<div class="col-sm-10">
    <select id="" name="SiTeAddress" value="0" class="form-control autonumber" required>
        <option value="0">Select Site Address</option>
        <?php
            $siteAdd = $fetch['cid'];
            $sidsql = mysqli_query($conn, "select * from siteAdress where client_id = '$siteAdd'");
            foreach($sidsql as $sidsqldata){ ?>
                <option value="<?php echo $sidsqldata['address']; ?>"><?php echo $sidsqldata['address']; ?></option>
        <?php    }
        ?>
    </select>
</div>
</div>
<?php
    } else {
        echo "No value received.";
    }
} else {
    echo "Invalid request.";
}
?>
