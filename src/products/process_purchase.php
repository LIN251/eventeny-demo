<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use Dotenv\Dotenv;
error_reporting(E_ALL);
ini_set('display_errors', 1);
var_dump($_REQUEST);
var_dump($_POST);
var_dump($_GET);
function confirmPurchase($name, $toEmail, $productName, $productPrice, $quantity, $total, $address,$state,$country,$postcode,$conn){
    // Load the environment variables from the .env file
    $dotenv = Dotenv::createImmutable(dirname(dirname(__DIR__)));
    $dotenv->load();
    $emailSender = $_ENV['EMAIL_SENDER'];
    // Set the timezone to New York
    date_default_timezone_set('America/New_York');
    $purchaseDate = date("Y-m-d H:i:s");
    // Email content <strong>
    $subject = "Purchase Confirmation";
    $message = '<html><body>';
    $message .= '<div style="font-family: Arial, sans-serif; font-size: 16px;">';
    $message .= "Dear $name,<br><br>Thank you for your purchase!<br><br>";
    $message .= '<strong>Product Information:</strong><br>';
    $message .= '<table>';
    $message .= '<tr><td>Product Name:</td><td>' . $productName . '</td></tr>';
    $message .= '<tr><td>Price:</td><td>$' . $productPrice . '</td></tr>';
    $message .= '<tr><td>Quantity:</td><td>' . $quantity . '</td></tr>';
    $message .= '<tr><td>Total Cost:</td><td>$' . $total . ' (Without Tax)</td></tr>';
    $message .= '<tr><td>Purchase Date:</td><td>' . $purchaseDate . ' EST</td></tr>';
    $message .= '</table>';
    $message .= '<br><strong>Shipping Address:</strong><br>';
    $message .= '<table>';
    $message .= '<tr><td>Address:</td><td>' . $address . '</td></tr>';
    $message .= '<tr><td>State:</td><td>' . $state . '</td></tr>';
    $message .= '<tr><td>Country:</td><td>' . $country . '</td></tr>';
    $message .= '<tr><td>Postcode:</td><td>' . $postcode . '</td></tr>';
    $message .= '</table>';
    $message .= '</div>';
    $message .= '</body></html>';
    
    $headers = "From: $emailSender \r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Send the email
    mail($toEmail, $subject, $message, $headers);
}


// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Include the database connection code
    require_once "../util/db_connection.php";
    // Get the submitted data from the form
    $product_id = $_POST["product_id"];
    $seller_id = $_POST["user_id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $state = $_POST["state"];
    $country = $_POST["country"];
    $postcode = $_POST["postcode"];
    $count = $_POST["count"];


    // Check the availability of the product
    $availabilityStmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $availabilityStmt->bind_param("i", $product_id);
    $availabilityStmt->execute();
    $availabilityResult = $availabilityStmt->get_result();
    $availabilityRow = $availabilityResult->fetch_assoc();
    $availableQuantity = $availabilityRow["available"];
    $productName = $availabilityRow["name"];
    $productPrice = $availabilityRow["price"];
    $availabilityStmt->close();

    if ($availableQuantity == 0) {
        echo "This product is currently out of stock.";
    } else {
        // Reduce availability and update sold count
        $reduceAvailabilityStmt = $conn->prepare("UPDATE products SET available = available - ? , sold = sold + ? WHERE product_id = ?");
        $reduceAvailabilityStmt->bind_param("iii", $count, $count, $product_id);
        $reduceAvailabilityStmt->execute();
        $reduceAvailabilityStmt->close();

        // Prepare and execute the SQL query to insert the purchase into the database
        for($i=0; $i<$count; $i++){
            $stmt = $conn->prepare("INSERT INTO purchases (product_id, seller_id, name, email, address, state, country, postcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iissssss", $product_id, $seller_id, $name, $email, $address, $state, $country, $postcode);
            $stmt->execute();
            $stmt->close();
        }

        echo '<link rel="stylesheet" href="../styles.css">';
        echo '<div class="purchase-success">';
        echo "<h1>Thank you for your purchase!</h1>";
        echo "<br>";
        echo "<h4>An email with the receipt will be sent to you shortly.</h4>";
        echo "<br>";
        echo "Please note that we do not store any credit card information. <br>All credit card transactions are securely processed by a trusted <br>third-party payment processor.";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo '<a href="../index.php" class="back-btn">Back to Home</a>';
        echo '</div>';
        confirmPurchase($name ,$email,$productName,$productPrice,$count,$productPrice*$count,$address,$state,$country,$postcode,$conn);
    }    

    // Close the database connection
    $conn->close();
}
?>