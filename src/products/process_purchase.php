<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Include the database connection code
    require_once "../util/db_connection.php";

    // Get the submitted data from the form
    $product_id = $_POST["product_id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $state = $_POST["state"];
    $country = $_POST["country"];
    $postcode = $_POST["postcode"];

    if ( empty($name) || empty($email) || empty($address) || empty($state) || empty($country) || empty($postcode)) {
        echo "Please fill in all required fields.";
    } else {
        // Check the availability of the product
        $availabilityStmt = $conn->prepare("SELECT available FROM products WHERE product_id = ?");
        $availabilityStmt->bind_param("i", $product_id);
        $availabilityStmt->execute();
        $availabilityResult = $availabilityStmt->get_result();
        $availabilityRow = $availabilityResult->fetch_assoc();
        $availableQuantity = $availabilityRow["available"];
        $availabilityStmt->close();

        if ($availableQuantity == 0) {
            echo "This product is currently out of stock.";
        } else {
            // Reduce availability and update sold count
            $reduceAvailabilityStmt = $conn->prepare("UPDATE products SET available = available - 1, sold = sold + 1 WHERE product_id = ?");
            $reduceAvailabilityStmt->bind_param("i", $product_id);
            $reduceAvailabilityStmt->execute();
            $reduceAvailabilityStmt->close();

            // Prepare and execute the SQL query to insert the purchase into the database
            $stmt = $conn->prepare("INSERT INTO purchases (product_id, name, email, address, state, country, postcode) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssss", $product_id, $name, $email, $address, $state, $country, $postcode);

            if ($stmt->execute()) {
                echo '<link rel="stylesheet" href="../styles.css">';
                echo '<div class="purchase-success">';
                echo "<h1>Thank you for your purchase!</h1>";
                echo "<br>";
                echo "Please note that we do not store any credit card information.";
                echo "<br>";
                echo "All credit card transactions are securely processed by a trusted third-party payment processor.";
                echo "<br>";
                echo '<a href="../index.php" class="back-btn">Back to Home</a>';
                echo '</div>';
            } else {
                echo "Error: " . $stmt->error;
            }
        }
    }

    // Close the database connection
    $conn->close();
}
?>