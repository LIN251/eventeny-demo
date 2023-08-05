<?php
$user_id = $_SESSION["user_id"];
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Fetch all products for current user from the 'product' table
$sql = "SELECT * FROM products WHERE user_id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table class="product-table">';
    echo '<tr><th>Name</th><th>Image</th><th>Price</th><th>Available</th><th>Sold</th><th>Return Policy</th><th>Edit</th><th>Delete</th></tr>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr data-id="' . $row["product_id"] . '">';
        echo '<td class="editable name">' . $row["name"] . '</td>';
        // Check if the image is empty
        if (!empty($row["image"])) {
            echo '<td><img src="' . $row["image"] . '" alt="Product Image" style="max-width: 50%;"></td>';
        } else {
            echo '<td>No image provided</td>';
        }
        echo '<td class="editable price">$' . $row["price"] . '</td>';
        echo '<td class="editable available">' . $row["available"] . '</td>';
        echo '<td class="editable sold">' . $row["sold"] . '</td>';
        echo '<td class="editable return_policy">' . $row["returns_policy"] . '</td>';
        echo '<td><button class="edit-btn" onclick="editProduct(' . $row["product_id"] . ')">Edit</button></td>';
        echo '<td><button onclick="deleteProduct(' . $row["product_id"] . ')">Delete</button></td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo '<p>No products found.</p>';
}

// Close the database connection
$conn->close();
?>
