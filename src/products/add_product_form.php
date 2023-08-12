<div class="add-product">
    <h2 class="form-title">Add New Product</h2>
    <form class="add-product-form" action="../products/add_product.php" method="post"> <label
            for="name">Name:</label>
        <input type="text" name="name" required placeholder="Product Name (Required)">
        <label for="price">Price (Visible to customers):</label>
        <input type="number" name="price" step="0.01" required placeholder="Product Price (Required)">
        <label for="cost_price">Product Cost (Visible to you only):</label>
        <input type="number" name="cost_price" step="0.01" required placeholder="Product Cost (Required)">
        <label for="description">Description:</label>
        <textarea name="description" required placeholder="Product Description (Required)"></textarea>
        <label for="image">Image URL:</label>
        <input type="text" name="image" placeholder="One Image URL (Optional)">
        <label for="available">Available:</label>
        <input type="number" name="available" required placeholder="Quantity Available (Required)">
        <label for="return_policy">Return Policy:</label>
        <textarea name="return_policy" required placeholder="Return Policy (Required)"></textarea>
        <label for="discount">Discount (as a number):</label>
        <input type="number" name="discount" step="0.01" min="0" max="100" required
            placeholder="Product Discount (0 ~ 100 Required)">
        <div class="center-container">
            <input type="submit" value="Add Product">
        </div>
    </form>
</div>