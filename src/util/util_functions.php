<?php
function calculateDiscountedPrice($price, $discount){
    $discounted_price = $price * (1 - ($discount / 100));
    $price = number_format($discounted_price, 2);
    return floatval(str_replace(',', '',$price));
}

?>