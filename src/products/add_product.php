<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Connect to the database
    require_once "../util/db_connection.php";

    // Get the form data
    $name = $_POST["name"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $image = $_POST["image"];
    $available = $_POST["available"];
    $returns_policy = $_POST["returns_policy"];

    // Insert the new product into the database
    $sql = "INSERT INTO product (name, price, description, image, available, returns_policy) 
            VALUES ('$name', '$price', '$description', '$image', '$available', '$returns_policy')";
    if ($conn->query($sql) === TRUE) {
        echo "New product added successfully!" . "<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the MySQL connection
    $conn->close();
}
?>
