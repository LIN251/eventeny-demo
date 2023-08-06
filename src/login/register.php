<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// var_dump($_REQUEST);
// var_dump($_POST);
// var_dump($_GET);
// Function to redirect to the login page
function login($username, $password, $conn){
    // Validate user credentials
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            session_start();
            // Login successful, set session variable
            $_SESSION["user_id"] = $user["user_id"];
            $_SESSION["username"] = $user["username"];
            header("Location: ../admin/admin_index.php");
            exit;
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }
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
            login($username,$password,$conn);
        }
    }

    // Close the database connection
    $conn->close();
}

?>
