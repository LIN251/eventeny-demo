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
    $card_number = $_POST["card_number"];
    $expiry = $_POST["expiry"];
    $cvv = $_POST["cvv"];

    if ( empty($name) || empty($email) || empty($address) || empty($state) || empty($country) || empty($postcode) || empty($card_number) || empty($expiry) || empty($cvv)) {
        echo "Please fill in all required fields.";
    } else {
        $reduceAvailabilityStmt = $conn->prepare("UPDATE products SET available = available - 1, sold = sold + 1 WHERE product_id = ?");        $reduceAvailabilityStmt->bind_param("i", $product_id);
        $reduceAvailabilityStmt->execute();
        $reduceAvailabilityStmt->close();

        // Prepare and execute the SQL query to insert the purchase into the database
        $stmt = $conn->prepare("INSERT INTO purchases (product_id, name, email, address, state, country, postcode, card_number, expiry, cvv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssssss", $product_id, $name, $email, $address, $state, $country, $postcode, $card_number, $expiry, $cvv);

        if ($stmt->execute()) {
            echo "Thank you for your purchase!"; 
            echo '<a href="../index.php"><button>Back to Home</button></a>';
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    // Close the database connection
    $conn->close();
}
?>