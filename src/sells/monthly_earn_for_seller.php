


<?php
include "../util/db_connection.php";
$shipped_sql = "
    SELECT 
        MONTH(created_at) AS month,
        SUM(execution_price - execution_cost_price) AS total_earnings
    FROM purchases
    WHERE YEAR(created_at) = YEAR(CURRENT_DATE) AND seller_id = '$seller_id' AND shipped = 1
    GROUP BY MONTH(created_at)
    ORDER BY MONTH(created_at)
    ";

$pending_sql = "
    SELECT 
        MONTH(created_at) AS month,
        SUM(execution_price - execution_cost_price) AS total_earnings
    FROM purchases
    WHERE YEAR(created_at) = YEAR(CURRENT_DATE) AND seller_id = '$seller_id' AND shipped = 0
    GROUP BY MONTH(created_at)
    ORDER BY MONTH(created_at)
    ";

$shipped_sql_result = $conn->query($shipped_sql);
$ShippedEarn = array();
while ($row = mysqli_fetch_assoc($shipped_sql_result)) {
    $month = date("F", mktime(0, 0, 0, $row['month'], 1));
    $ShippedEarn[$month] = $row['total_earnings'];
}


$pending_sql_result = $conn->query($pending_sql);
$PendingEarn = array();
while ($row = mysqli_fetch_assoc($pending_sql_result)) {
    $month = date("F", mktime(0, 0, 0, $row['month'], 1));
    $PendingEarn[$month] = $row['total_earnings'];
}


?>