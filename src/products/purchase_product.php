<!DOCTYPE html>
<html>
<head>
    <title>Purchase Product</title>
    <!-- Add your CSS styles here (if needed) -->
</head>
<body>
    <h1>Purchase Product</h1>
    <form action="process_purchase.php" method="post">

        <!-- Add more fields for user information -->
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <!-- Add other fields for address -->
        <label for="address">Address:</label>
        <input type="text" name="address" required>
        <label for="state">State:</label>
        <input type="text" name="state" required>
        <label for="country">Country:</label>
        <input type="text" name="country" required>
        <label for="postcode">Postcode:</label>
        <input type="text" name="postcode" required>
        <!-- Add more fields for credit card information -->
        <label for="card_number">Credit Card Number:</label>
        <input type="text" name="card_number" required>
        <label for="expiry">Expiry Date:</label>
        <input type="text" name="expiry" required>
        <!-- Add other credit card fields (CVV, etc.) -->
        <label for="cvv">CVV:</label>
        <input type="text" name="cvv" required>
        <input type="hidden" name="product_id" value="<?php echo $_POST['product_id']; ?>">
        <input type="submit" value="Submit Purchase">
    </form>
</body>
</html>


