<?php

// Function to redirect to the login page
function redirectToLogin() {
    header("Location: login.php");
    exit;
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Include the database connection code
    require_once "../util/db_connection.php";

    // Get user inputs from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Perform some basic validation
    if (empty($username) || empty($password)) {
        echo "Please fill in all required fields.";
    } else {
        // Check if the username is already taken
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "Username already exists. Please choose a different username.";
        } else {
            // Insert the new user into the database
            include "../users/add_user.php";
 
            // Redirect to the index page and change to the login tab
            echo "<script>
                    window.location.href = '../index.php#login';
                    // let guestLoginButton = document.getElementById('guestLogin');
                    // if (guestLoginButton) {
                    //     guestLoginButton.click();
                    // }
                  </script>";
            exit;
        }
    }

    // Close the database connection
    $conn->close();
}

?>
