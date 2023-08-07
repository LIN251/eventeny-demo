<?php
// Fetch all products that belong to the current user
$user_id = $_SESSION["user_id"];
$sql = "SELECT * FROM products WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Initialize the total earnings variable
$total_earnings = 0;

if ($result->num_rows > 0) {
    echo '<table class="product-table table">';
    echo '<tr><th>Product Name</th><th>Price</th><th>Discount</th><th>Sell Price</th><th>Product Cost</th><th>Earn</th><th>Description</th><th>Address</th><th>State</th><th>Postcode</th><th>Country</th><th>Name</th><th>Email</th><th>Purchased At</th><th>Shipment</th></tr>';
    while ($row = $result->fetch_assoc()) {
        // Check if the product is sold
        $product_id = $row["product_id"];
        $sql_sold = "SELECT * FROM purchases WHERE product_id = ?";
        $stmt_sold = $conn->prepare($sql_sold);
        $stmt_sold->bind_param("i", $product_id);
        $stmt_sold->execute();
        $result_sold = $stmt_sold->get_result();

        while ($sold_row = $result_sold->fetch_assoc()) {
            // Calculate sell price and earn
            $discount = $row["discount"];
            $sell_price = $row["price"] - ($row["price"] * ($discount / 100));
            $earn = $sell_price - $row["cost_price"];
            $total_earnings += $earn;
            if ($sold_row["shipped"]) {
                echo '<tr purchase_id="' . $sold_row["purchase_id"] . '" class="marked-row">';
            } else {
                echo '<tr purchase_id="' . $sold_row["purchase_id"] . '">';
            }
            echo '<td>' . $row["name"] . '</td>';
            echo '<td>$' . $row["price"] . '</td>';
            echo '<td>' . $discount . '%</td>';
            echo '<td>$' . number_format($sell_price, 2) . '</td>';
            echo '<td>$' . $row["cost_price"] . '</td>';
            echo '<td class="earn-column" style="color: red;">$' . number_format($earn, 2) . '</td>'; // Apply CSS style to the "earn" column
            echo '<td>' . $row["description"] . '</td>';
            echo '<td>' . $sold_row["address"] . '</td>';
            echo '<td>' . $sold_row["state"] . '</td>';
            echo '<td>' . $sold_row["postcode"] . '</td>';
            echo '<td>' . $sold_row["country"] . '</td>';
            echo '<td>' . $sold_row["name"] . '</td>';
            echo '<td>' . $sold_row["email"] . '</td>';
            echo '<td>' . $sold_row["created_at"] . '</td>';
            if ($sold_row["shipped"]) {
                echo '<td><input type="checkbox" ' . 'checked' . ' disabled></td>';
            } else {
                echo '<td><input type="checkbox" onclick="handleCheckboxClick(this,' . $sold_row["purchase_id"] . ');"></td>';
            }
            echo '</tr>';
        }
    }
    echo '</table>';
    echo '<br>';
    echo '<div class="add-product">';
    echo '<h2>Total Earn: $' . number_format($total_earnings, 2) . '</h2>';
    echo '</div>';

} else {
    echo '<p>No products are sold.</p>';
}
?>