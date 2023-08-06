<?php
// Fetch all products that belong to the current user
$user_id = $_SESSION["user_id"];
$sql = "SELECT * FROM products WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<table class="product-table table">';
    echo '<tr><th>Product Name</th><th>Price</th><th>Description</th><th>Address</th><th>State</th><th>Postcode</th><th>Country</th><th>Name</th><th>Email</th><th>Purchased At</th><th>Shipment</th></tr>';
    while ($row = $result->fetch_assoc()) {
        // Check if the product is sold
        $product_id = $row["product_id"];
        $sql_sold = "SELECT * FROM purchases WHERE product_id = ?";
        $stmt_sold = $conn->prepare($sql_sold);
        $stmt_sold->bind_param("i", $product_id);
        $stmt_sold->execute();
        $result_sold = $stmt_sold->get_result();

        while ($sold_row = $result_sold->fetch_assoc()) {
            echo '<tr purchase_id="' . $sold_row["purchase_id"] . '">';
            echo '<td>' . $row["name"] . '</td>';
            echo '<td>$' . $row["price"] . '</td>';
            echo '<td>' . $row["description"] . '</td>';
            echo '<td>' . $sold_row["address"] . '</td>';
            echo '<td>' . $sold_row["state"] . '</td>';
            echo '<td>' . $sold_row["postcode"] . '</td>';
            echo '<td>' . $sold_row["country"] . '</td>';
            echo '<td>' . $sold_row["name"] . '</td>';
            echo '<td>' . $sold_row["email"] . '</td>';
            echo '<td>' . $sold_row["created_at"] . '</td>';
            if($sold_row["shipped"]){
                echo '<td><input type="checkbox" ' .  'checked' . ' disabled></td>';
            }else{
                echo '<td><input type="checkbox" onclick="handleCheckboxClick(this,'.$sold_row["purchase_id"] .');" ></td>';
            }
            echo '</tr>';
        }
    }
    echo '</table>';
} else {
    echo '<p>No products are sold.</p>';
}
?>
