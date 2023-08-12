<?php
$sql = "CREATE TABLE price_history (
    price_history_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    price DECIMAL(10, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($sql);
?>