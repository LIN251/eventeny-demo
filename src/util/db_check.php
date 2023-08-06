<?php
require_once "db_connection.php";
function checkTable($tableName, $conn) {
    $query = "SHOW TABLES LIKE '" . $conn->real_escape_string($tableName) . "'";
    $result = $conn->query($query);
    if (!$result) {
        echo "Error executing query: " . $conn->error;
        return false;
    }
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

if(!checkTable("users",$conn)){
    require_once "users/create_users_table.php";
}
if(!checkTable("products",$conn)){
    require_once "products/create_products_table.php";
}
if(!checkTable("purchases",$conn)){
    require_once "products/create_purchases_table.php";

}


?>