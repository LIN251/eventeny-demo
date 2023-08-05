<?php
require_once "../util/db_connection.php";

// Create the 'purchases' table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS purchases (
    purchase_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    product_id INT(11) UNSIGNED NOT NULL,
    address VARCHAR(255) NOT NULL,
    state VARCHAR(100) NOT NULL,
    country VARCHAR(100) NOT NULL,
    postcode VARCHAR(20) NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    card_number VARCHAR(20) NOT NULL,
    expiry VARCHAR(10) NOT NULL,
    cvv VARCHAR(10) NOT NULL,
    shipped TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(product_id)
)";
if ($conn->query($sql) === true) {
    echo "Table 'purchases' created successfully or already exists.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Close the connection
$conn->close();

?>
