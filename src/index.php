<!DOCTYPE html>
<html>
<head>
    <title>Marketplace</title>
    <link rel="stylesheet" href="styles.css">
    <script src="index.js" defer></script>
</head>


<body>

<h1>Marketplace</h1>
<button class="tablink" onclick="openTab('products')" id="defaultOpen">All on sale products</button>
<button class="tablink" onclick="openTab('login')">Login</button>
<button class="tablink" onclick="openTab('register')">Register</button>

<div id="products" class="tabcontent">
  <h1>All Products</h1>
  <?php 
    // Include the database connection code
    require_once "util/db_connection.php";
    include "products/show_products.php"; 
  ?>
</div>

<div id="login" class="tabcontent">
    <h1>Login</h1>
    <form action="./login/login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <input type="submit" value="Login">
    </form>

    <!-- Add a Register button that redirects to the registration page -->
    <form action="./login/register.php">
        <input type="submit" value="Register">
    </form>
</div>


<div id="register" class="tabcontent">
    <h1>Register</h1>
    <form action="./login/register.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <input type="submit" value="Register">
    </form>
</div>


</body>
</html>
