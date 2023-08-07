<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Connect to the database
    require_once "../util/db_connection.php";

    // Get the form data
    $name = $_POST["name"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $image = $_POST["image"];
    $available = $_POST["available"];
    $return_policy = $_POST["return_policy"];
    $user_id = $_SESSION["user_id"];

    // Insert the new product into the database
    $sql = "INSERT INTO products (name, price, description, image, available, return_policy, user_id) 
            VALUES ('$name', '$price', '$description', '$image', '$available', '$return_policy', '$user_id')";
    if ($conn->query($sql) === TRUE) {
        echo "New product added successfully!" . "<br>";
        header("Location: ../admin/admin_index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the MySQL connection
    $conn->close();
}
?>