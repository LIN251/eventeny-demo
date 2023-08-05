<?php
    // Connect to the database
    require_once "../util/db_connection.php";
    $purchase_id = $_POST["purchase_id"];
    echo $purchase_id;
    $updateShipmentStmt = $conn->prepare("UPDATE purchases SET shipped = 1 WHERE purchase_id = ?");       
    $updateShipmentStmt->bind_param("i", $purchase_id);
    $updateShipmentStmt->execute();
    $updateShipmentStmt->close();

    //close database connection
    $conn->close();
?>