<?php
// include "../util/db_operations.php";
include "../util/db_connection.php";
$user_id = $_SESSION["user_id"];
$result = findPurchasesByBuyerId($conn, $user_id);
$cur_user = findUserByUserId($conn, $user_id);
$cur_user_data = $cur_user->fetch_assoc();

if ($result->num_rows > 0) {


    echo '<table class="product-table table">';
    echo '<tr>
                    <th>Seller Info</th>
                    <th>Product Info</th>
                    <th>Buyer Info</th>
                    <th>Shipping Info</th>

                    <th>Purchase Info</th>
                    <th>Request to Cancel Order</th>
                    <th>Add Review</th>
                    </tr>';

    while ($row = $result->fetch_assoc()) {
        $sellerStmtResult = findUserByUserId($conn, $row["seller_id"]);
        $sellerRow = $sellerStmtResult->fetch_assoc();
        $seller = $sellerRow["username"];
        echo '<tr data-id="' . $row["purchase_id"] . '">';
        echo '<td class="name">
        <strong>Name: </strong>' . $seller . ' <br>
        <strong>Email: </strong>' . '<a href="mailto:' . $sellerRow["email"] . '">' . $sellerRow["email"] . '</a><br>

        
        </td>';

        echo '<td class="product_info">
        <strong>Name:</strong> ' . $row["execution_product_name"] . '<br>
        <strong>Price:</strong> ' . $row["execution_price"] . '<br>
        <strong>Product Description:</strong><br> ' . $row["execution_description"] . '    
        </td>';
        echo '<td class="order_info">
        <strong>Name:</strong> ' . $_SESSION["username"] . '<br>
        <strong>Email:</strong> ' . '<a href="mailto:' . $cur_user_data["email"] . '">' . $cur_user_data["email"] . '</a><br>
        </td>';
        echo '<td class="shipping_info">
        <strong>Name:</strong> ' . $row["name"] . '<br>
        <strong>Email:</strong> ' . '<a href="mailto:' . $row["email"] . '">' . $row["email"] . '</a><br>
        <strong>Address:</strong> ' . $row["address"] . '<br>
        <strong>State:</strong>  ' . $row["state"] . '<br>
        <strong>Country:</strong> ' . $row["country"] . '<br>
        <strong>Postcode:</strong> ' . $row["postcode"] . '<br>
        </td>';




        echo '<td class="created_at">
        <strong>Order At:</strong> ' . $row["created_at"] . '<br>
        <strong>Updated At:</strong> ' . $row["updated_at"] . '<br>
        </td>';
        if ($row["shipped"] == 1) {
            echo '<td>Item already shipped</td>';
            if ($row["review_submitted"] == 1) {
                echo '<td>Thank you <br>for reviewing.</td>';
            } else {
                echo '<td><button onclick="showReviewForm(' . $row["purchase_id"] . ')">Add Review</button></td>';
            }
        } else {
            echo '<td><button class="button" onclick="cancelPurchase(' . $row["purchase_id"] . ')">Request</button></td>';
            echo '<td>Waiting to deliver</td>';
        }
        echo '</tr>';
    }
    echo '</table>';


    // <!-- hidden form for adding reviews -->
    echo "<div class='add-product' id='reviewFormContainer' style='display: none;'>";
    echo "<h2>Add Review</h2>";
    echo "<form class='add-product-form' action='../productReviews/add_product_review.php' method='post'> ";
    echo "<input type='hidden' name='purchase_id' id='purchaseId' value=''>";
    echo "<input type='hidden' name='user_id' value='" . $user_id . "'>";
    echo "<label for='review_text'>Review Text:</label>";
    echo "<input type='text' name='review_text' required placeholder='Add your review (Required)'>";
    echo "<label for='rating'>Rating:</label>";
    echo "<input type='number' name='rating' step='0.1' min='0' max='5' required placeholder='Rate the product (0-5 stars)'>";
    echo "<div class='center-container'>";
    echo "<input type='submit' value='Add Review'>";
    echo "</div>";
    echo "</form>";
    echo "</div>";

} else {
    echo '<p>No products found.</p>';
}
?>