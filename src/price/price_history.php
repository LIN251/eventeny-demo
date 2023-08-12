<?php
// Assuming you have established a database connection
require_once "../util/db_connection.php";
include "../util/db_operations.php";

$productId = $_GET["product_id"];
$result = findPriceHistoryByProductId($conn, $productId);

// Fetch the data into an associative array
$priceHistoryData = array();
while ($row = $result->fetch_assoc()) {
    $priceHistoryData[] = array(
        "created_at" => $row["created_at"],
        "price" => $row["price"]
    );
}

$conn->close();

// Send the data as JSON response
header("Content-Type: application/json");
echo json_encode($priceHistoryData);
?>
