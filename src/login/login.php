<?php
session_start();
require_once "../util/db_connection.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

function login($username, $password,$conn){
     // Validate user credentials
     $sql = "SELECT * FROM users WHERE username = ?";
     $stmt = $conn->prepare($sql);
     $stmt->bind_param("s", $username);
     $stmt->execute();
     $result = $stmt->get_result();
 
     if ($result->num_rows === 1) {
         $user = $result->fetch_assoc();
         if (password_verify($password, $user["password"])) {
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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    login($username, $password,$conn);
}

?>
