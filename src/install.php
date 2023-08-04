<?php


if (!file_exists("installed.txt")) {
    // Include the files to create the required tables
    // require_once "/users/create_user_table.php";
    //require_once "./products/create_product_table.php";

    // Create the flag file to indicate installation is completed
    file_put_contents("installed.txt", "Installed");
}

// Redirect to the main application page
header("Location: index.php");

?>