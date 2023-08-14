<!DOCTYPE html>
<html>

<head>
    <title>Marketplace</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.27.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment@0.1.1"></script>
  
    <script src="index.js" defer></script>
    <header>
    <h1>Marketplace</h1>
    <nav>
        <ul class="navbar">
            <li class="nav-item">
                <a class="nav-link tablink" href="#" onclick="openTab('products')" id="defaultOpen">All Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link tablink" href="#" onclick="openTab('login')" id="loginTab">Sign In</a>
            </li>
            <li class="nav-item">
                <a class="nav-link tablink" href="#" onclick="openTab('register')" id="registerTab">Sign Up</a>
            </li>
        </ul>
    </nav>
    </header>
</head>


<body>

    <!-- <button class="tablink" onclick="openTab('products')" id="defaultOpen">All Products</button>
    <button class="tablink" id="defaultOpen" onclick="openTab('login')">User Login</button>
    <button class="tablink" id="guestregister" onclick="openTab('register')">User Register</button> -->
    <?php
    include "util/db_setup.php";
    ?>
    <div id="products" class="tabcontent">
        <div class="show-products-container">
            <h1 class="form-title">All Products On Sale</h1>
            <div class="products-container">
                <?php
                // Include the database connection code
                require_once "util/db_connection.php";
                include "products/show_products_guest.php";
                ?>
            </div>
        </div>
    </div>

    <div id="login" class="tabcontent">
        <h1 class="form-title">Sign In</h1>
        <form action="./login/login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <input type="submit" value="Login">
        </form>

        <!-- Add a Register button that redirects to the registration page -->
        <!-- <form action="./login/register.php">
            <input type="submit" value="Register">
        </form> -->
    </div>

    <div id="register" class="tabcontent">
        <h1 class="form-title">Sign Up</h1>
        <form action="./login/register.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <p>You will receive an email confirmation <br>once the account is created.</p>
            <input type="submit" value="Register">
        </form>
    </div>

</body>

</html>