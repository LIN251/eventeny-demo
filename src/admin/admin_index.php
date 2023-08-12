<?php
session_start();
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
    <link rel="stylesheet" href="admin_index.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.27.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment@0.1.1"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="admin_index.js" defer></script>
    <header>
        <h1>Welcome,
            <?php echo $_SESSION["username"]; ?>!
        </h1>
        <nav>
            <ul class="navbar">
                <li class="nav-item">
                    <a class="nav-link tablink" href="#" onclick="openTab('products')" id="defaultOpen">On sell Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tablink" href="#" onclick="openTab('orderHistory')" id="orderHistoryTab">My Order</a>
                </li>

                <li class="nav-item">
                    <div class="dropdown-content">
                        <a class="dropdown-block tablink" href="#" onclick="openTab('add')" id="addTab">
                            <span class="dropdown-item">Add Products<br></span>
                            <span class="dropdown-label">Add products to market.</span>

                        </a>
                        <a class="dropdown-block tablink" href="#" onclick="openTab('manage')" id="manageTab">
                            <span class="dropdown-item">Modify products<br></span>
                            <span class="dropdown-label">Edit, Archive, Delete products.</span>
                        </a>

                        <a class="dropdown-block tablink" href="#" onclick="openTab('archive')" id="archiveTab">
                            <span class="dropdown-item">Archived Products<br></span>
                            <span class="dropdown-label">View archived products.</span>
                        </a>
                    </div>
                    <a class="nav-link" href="#">Products Management</a>
                </li>

                <li class="nav-item">
                    <div class="dropdown-content">
                        <a class="dropdown-block tablink" href="#" onclick="openTab('sold')" id="soldTab">
                            <span class="dropdown-item">Shipments<br></span>
                            <span class="dropdown-label">View and ship sold products.</span>
                        </a>
                        <a class="dropdown-block tablink" href="#" onclick="openTab('earn')" id="earnTab">
                            <span class="dropdown-item">Earn & Product Reviews<br></span>
                            <span class="dropdown-label">Total earn on marketplace.</span>
                        </a>
                    </div>
                    <a class="nav-link" href="#">Sales Management</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tablink" href="#" onclick="openTab('contact')" id="contactTab">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="logout()">Log Out</a>
                </li>
            </ul>
        </nav>
    </header>
</head>

<body>

    <main>
        <!-- Products tab -->
        <div id="products" class="tabcontent">
            <div class="show-products-container">
                <h1 class="form-title">Products On Sale From Other Sellers</h1>
                <div class="products-container">
                    <?php
                    require "../products/show_products_user.php";
                    ?>
                </div>
            </div>
        </div>

        <!-- Manage Order History tab -->
        <div id="orderHistory" class="tabcontent">
            <h1 class="form-title">Order History</h1>
            <?php
            include "../purchases/purchase_history.php";
            ?>
        </div>

        <!-- Add product to market -->
        <div id="add" class="tabcontent">
            <?php
            include "../products/add_product_form.php";
            ?>
        </div>

        <!-- Manage products tab -->
        <div id="manage" class="tabcontent">
            <h2 class="form-title">Manage products</h2>
            <?php
            // Include the database connection code
            require "../util/db_connection.php";
            include "../products/mamage_products.php";
            ?>

        </div>

        <!-- Sold products tab -->
        <div id="sold" class="tabcontent">
            <h1 class="form-title">Shipments</h1>
            <?php
            include "../products/sold_products.php";
            ?>
        </div>

        <!-- Archive products tab -->
        <div id="archive" class="tabcontent">
            <h1 class="form-title">Archived Products</h1>
            <?php
            include "../products/archive_products.php";
            ?>
        </div>

        <!-- Earn from sells tab -->
        <div id="earn" class="tabcontent">
            <h1 class="form-title">Earn & Product Reviews</h1>
            <?php
            include "../sells/earn_from_sells.php";
            ?>
        </div>


        <!-- Earn from sells tab -->
        <div id="review" class="tabcontent">
            <h1 class="form-title">Product Reviews</h1>
            <?php
            include "../products/product_reviews.php";
            ?>
        </div>


        <!-- Contact us tab -->
        <div id="contact" class="tabcontent">
            <?php
            include "../util/contact_us_form.php";
            ?>
        </div>
    </main>
</body>

</html>