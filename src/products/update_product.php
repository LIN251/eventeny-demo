<?php
// Include the database connection code
require_once "../util/db_connection.php";

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  
    // Get the product ID from the query parameters
    $id = $_GET["id"];
    
    // Get the data sent in the POST request
    $name = $_POST["name"];
    $price = $_POST["price"];
    $available = $_POST["available"];
    $description = $_POST["description"];
    $returns_policy = $_POST["returns_policy"];

    // Prepare the SQL statement to update the product record
    $sql = "UPDATE products 
            SET name = ?, price = ?, available = ?, description = ?, returns_policy = ? 
            WHERE product_id = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters to the statement
    $stmt->bind_param("sssssi", $name, $price, $available, $description, $returns_policy, $id);

    // Execute the statement
    if ($stmt->execute()) {
        // Success
        echo "Product updated successfully!";
    } else {
        // Error
        echo "Error updating product: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
