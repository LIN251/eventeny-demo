<!DOCTYPE html>
<html>
<head>
    <title>Marketplace</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Marketplace</h1>
        <!-- Display all products -->
            <div class="all-products">
            <?php
            // Include the database connection code
            require_once "./util/db_connection.php";

            // Fetch all products from the 'product' table
            $sql = "SELECT * FROM product";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="product">';
                    echo '<h3>' . $row["name"] . '</h3>';
                    echo '<p>Price: $' . $row["price"] . '</p>';
                    echo '<p>Description:' . $row["description"] . '</p>';
                    echo 'Product Images: '. '<br>';
                    echo '<img src="' . $row["image"] . '" alt="Product Image">';
                    echo '<p>Available: ' . $row["available"] . '</p>';
                    echo '<p>Returns Policy: ' . $row["returns_policy"] . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<p>No products found.</p>';
            }

            // Close the database connection
            $conn->close();
            ?>
        </div>
        <!-- Add new product form -->
        <!-- <div class="add-product">
            <h2>Add New Product</h2>
            <form action="./product/add_product.php" method="post">
                <label for="name">Name:</label>
                <input type="text" name="name" required>

                <label for="price">Price:</label>
                <input type="number" name="price" step="0.01" required>

                <label for="description">Description:</label>
                <textarea name="description" required></textarea>

                <label for="image">Image URL:</label>
                <input type="text" name="image" required>

                <label for="available">Available:</label>
                <input type="number" name="available" required>

                <label for="returns_policy">Returns Policy:</label>
                <textarea name="returns_policy"></textarea>

                <input type="submit" value="Add Product">
            </form>
        </div> -->
    </div>
</body>
</html>
