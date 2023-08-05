<!DOCTYPE html>
<html>
<head>
    <title>Purchase Product</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="form-container">
        <h1 class="form-title">Purchase Product</h1>
        <form action="process_purchase.php" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" name="address" required>
            </div>
            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" name="state" required>
            </div>
            <div class="form-group">
                <label for="country">Country:</label>
                <input type="text" name="country" required>
            </div>
            <div class="form-group">
                <label for="postcode">Postcode:</label>
                <input type="text" name="postcode" required>
            </div>
            <div class="form-group">
                <label for="card_number">Credit Card Number:</label>
                <input type="text" name="card_number" required>
            </div>
            <div class="form-group">
                <label for="expiry">Expiry Date:</label>
                <input type="text" name="expiry" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV:</label>
                <input type="text" name="cvv" required>
            </div>
            <input type="hidden" name="product_id" value="<?php echo $_POST['product_id']; ?>">
            <div class="form-group">
                <input type="submit" value="Submit Purchase" class="submit-btn">
            </div>
        </form>
    </div>
</body>
</html>
