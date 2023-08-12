<?php
$seller_id = $_SESSION["user_id"];
$result_sold = findPurchasesBySellerId($conn, $seller_id);

// Initialize the total earnings variable
$total_earnings = 0;

if ($result_sold->num_rows > 0) {
    echo '<table class="product-table table">';
    echo '<tr><th>Product Name</th><th>Execution<br> Description</th>
    <th>Shipping Info</th><th>Sold On</th>
    <th>Shipment</th></tr>';
    while ($sold_row = $result_sold->fetch_assoc()) {
        $earn = $sold_row["execution_price"] - $sold_row["execution_cost_price"];
        $total_earnings += $earn;
        if ($sold_row["shipped"]) {
            echo '<tr purchase_id="' . $sold_row["purchase_id"] . '" class="marked-row">';
        } else {
            echo '<tr purchase_id="' . $sold_row["purchase_id"] . '">';
        }
        echo '<td>' . $sold_row["execution_product_name"] . '</td>';
        echo '<td>$' . $sold_row["execution_description"] . '</td>';



        echo '<td class="shipping_info">
        <strong>Name:</strong> ' . $sold_row["name"] . '<br>
        <strong>Email:</strong> ' . '<a href="mailto:' . $sold_row["email"] . '">' . $sold_row["email"] . '</a><br>
        <strong>Address:</strong> ' . $sold_row["address"] . '<br>
        <strong>State:</strong>  ' . $sold_row["state"] . '<br>
        <strong>Country:</strong> ' . $sold_row["country"] . '<br>
        <strong>Postcode:</strong> ' . $sold_row["postcode"] . '<br>
        </td>';


        echo '<td>' . $sold_row["created_at"] . '</td>';
        if ($sold_row["shipped"]) {
            echo '<td><input type="checkbox" ' . 'checked' . ' disabled></td>';
        } else {
            echo '<td><input type="checkbox" onclick="handleCheckboxClick(this,' . $sold_row["purchase_id"] . ');"></td>';
        }
        echo '</tr>';
    }
    echo '</table>';
    echo '<br>';


} else {
    echo '<p>No products are sold.</p>';
}
?>