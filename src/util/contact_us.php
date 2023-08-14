<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    include 'email_confirmation.php';

    contact_us_confirmation($name, $email, $subject, $message);
    echo '<link rel="stylesheet" href="../styles.css">';
    echo '<div class="purchase-success">';
    echo "<h1 class='form-title'>Feedback sent!</h1>";
    echo "<br>";
    echo "Thank you for your feedback!";
    echo "<br>";
    echo '<a href="../admin/admin_index.php" class="back-btn">Back to Home</a>';
    echo '</div>';
}
?>
