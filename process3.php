<?php
include "db/conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if 'value' is set in the POST request
    if (isset($_POST['value'])) {
        $value = htmlspecialchars($_POST['value']); // Sanitize the input value

        // Prepare the SQL statement to prevent SQL injection
        if ($stmt = $conn->prepare("SELECT * FROM terms WHERE tc_idd = ?")) {
            $stmt->bind_param("s", $value);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if there are results
            if ($result->num_rows > 0) {
                // Loop through each row and output the details
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="mb-6">
                        <label class="col-sm-4 col-form-label" style="color:#000;">Term & Condition Details</label>
                        <input id="" name="SiTeAddress" value="<?php echo htmlspecialchars($row['tc']); ?>" class="form-control autonumber" required>
                    </div>
                    <?php
                }
            } else {
                echo "No terms and conditions found for the given value.";
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Failed to prepare the SQL statement.";
        }

    } else {
        echo "No value received.";
    }
} else {
    echo "Invalid request.";
}
?>
