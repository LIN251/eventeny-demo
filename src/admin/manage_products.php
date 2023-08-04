<?php
echo "aaaaa";

session_start();
var_dump($_SESSION);
if (!isset($_SESSION["user_id"])) {
    // Redirect to login if the user is not logged in
    header("Location: ../login/login.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Products</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION["username"]; ?>!</h1>
    <h2>Manage Products</h2>
    <!-- Add product CRUD operations here -->
    <a href="../login/logout.php">Logout</a>
</body>
</html>



