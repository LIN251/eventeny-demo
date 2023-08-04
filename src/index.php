<!DOCTYPE html>
<html>
<head>
    <title>Marketplace</title>
    <link rel="stylesheet" href="styles.css">
    <script src="index.js" defer></script>
</head>


<body>

<h1>Marketplace</h1>
<button class="tablink" onclick="openTab('products')" id="defaultOpen">All products</button>
<button class="tablink" onclick="openTab('login')">Login</button>
<button class="tablink" onclick="openTab('register')">Register</button>

<div id="products" class="tabcontent">
  <h1>All Products</h1>
  <?php
  // Include the database connection code
  require_once "util/db_connection.php";

  // Fetch all products from the 'product' table
  $sql = "SELECT * FROM product";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo '<div class="product">';
      echo '<h3> Product: ' . $row["name"] . '</h3>';
      echo '<p>Price: $' . $row["price"] . '</p>';
      echo '<p>Description:' . $row["description"] . '</p>';
      echo 'Product Images: '. '<br>';
      echo '<p>Available: ' . $row["available"] . '</p>';
      echo '<p>Returns Policy: ' . $row["returns_policy"] . '</p>';
      echo '<img src="' . $row["image"] . '" alt="Product Image">';
      echo '</div>';
    }
  } else {
    echo '<p>No products found.</p>';
  }

  // Close the database connection
  $conn->close();
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
