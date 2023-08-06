<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    var_dump($_REQUEST);
    var_dump($_POST);
    var_dump($_GET);
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["product_id"])) {
        // Connect to the database
        require_once "../util/db_connection.php";

        // Get the product ID from the POST data
        $product_id = $_POST["product_id"];
        // Delete the product from the 'products' table
        $sql = "DELETE FROM products WHERE product_id = '$product_id' ";
        if ($conn->query($sql) === TRUE) {
            // If the product is deleted successfully, return a success response
            echo "Product deleted successfully!";
        } else {
            // If there's an error in the deletion process, return an error response
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the database connection
        $conn->close();
    }
?>
