<?php
$seller_id = $_SESSION["user_id"];
$result_sold = findPurchasesBySellerId($conn, $seller_id);

// Initialize the total earnings variable
$total_earnings = 0;
$shipped_earnings = 0;
$pending_earnings = 0;
if ($result_sold->num_rows > 0) {
    echo '<table class="product-table table">';
    echo '<tr><th>Product Name</th><th>Execution<br> Discount</th>
    <th>Execution<br> Price</th><th>Execution<br> Product Cost</th>
    <th>Earn</th><th>Buyer Info</th><th>Sold On</th>
   <th>Review</th><th>Rate<br>(0-5)</th></tr>';
    while ($sold_row = $result_sold->fetch_assoc()) {
        $earn = $sold_row["execution_price"] - $sold_row["execution_cost_price"];
        $total_earnings += $earn;
        if ($sold_row["shipped"]) {
            $shipped_earnings += $earn;
            echo '<tr purchase_id="' . $sold_row["purchase_id"] . '" class="marked-row">';
        } else {
            $pending_earnings += $earn;
            echo '<tr purchase_id="' . $sold_row["purchase_id"] . '">';
        }
        echo '<td>' . $sold_row["execution_product_name"] . '</td>';
        echo '<td>' . $sold_row["execution_discount"] . '%</td>';
        echo '<td>$' . $sold_row["execution_price"] . '</td>';
        echo '<td>$' . $sold_row["execution_cost_price"] . '</td>';
        echo '<td class="earn-column" style="color: red;">$' . $earn . '</td>';

        echo '<td>
        <strong>Name:</strong> ' . $sold_row["name"] . '<br>
        <strong>Email:</strong> <a href="mailto:' . $sold_row["email"] . '">' . $sold_row["email"] . '</a>
      </td>';


        echo '<td>' . $sold_row["created_at"] . '</td>';
        $reviewRawData = findReviewByPurchaseId($conn, $sold_row["purchase_id"]);
        $reviewData = $reviewRawData->fetch_assoc();
        if ($reviewData) {
            echo '<td>' . $reviewData["review_text"] . '</td>';
            echo '<td>' . $reviewData["rating"] . '</td>';
        } else {
            echo '<td>No Review</td>';
            echo '<td>No Rating</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
    echo '<br>';
    echo '<div class="add-product">';
    echo '<h3 class="form-title">Total Sales: $' . number_format($total_earnings, 2) . '</h3>';
    echo '<h3 class="form-title">Shipped Sales: $' . number_format($shipped_earnings, 2) . '</h3>';
    echo '<h3 class="form-title">Pending Sales: $' . number_format($pending_earnings, 2) . '</h3>';
    echo '<canvas id="earningsChart" width="300" height="150"></canvas>';

    echo '</div>';
    include "../sells/monthly_earn_for_seller.php";
} else {
    echo '<p>No products are sold.</p>';
}
?>


<script>
    var ctx = document.getElementById('earningsChart').getContext('2d');

    var earningsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php 
                if(count($ShippedEarn) > count($PendingEarn)){
                    echo json_encode(array_keys($ShippedEarn));
                }else{
                    echo json_encode(array_keys($PendingEarn));
                }                
                ?>,
            datasets: [
                {
                    label: 'Shipped Earn',
                    data: <?php echo json_encode(array_values($ShippedEarn)); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Pending Earn',
                    data: <?php echo json_encode(array_values($PendingEarn)); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                x: { stacked: true },
                y: { stacked: true }
            }
        }
    });
</script>