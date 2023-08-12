<?php
require_once "db_connection.php";
function checkTable($tableName, $conn)
{
    $query = "SHOW TABLES LIKE '" . $conn->real_escape_string($tableName) . "'";
    $result = $conn->query($query);
    if (!$result) {
        echo "Error executing query: " . $conn->error;
        return false;
    }
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}


// Function to add testing data for uses;
function addTestingDataForUsers($conn)
{
    $passwordHash = password_hash("admin", PASSWORD_DEFAULT);
    $username = "admin";
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$passwordHash', 'admin@gmail.com')";
    $conn->query($sql);

    $passwordHash = password_hash("testuser", PASSWORD_DEFAULT);
    $username = "testuser";
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$passwordHash', 'lzhang2510@gmail.com')";
    $conn->query($sql);


}

// Function to add testing data for products
function addTestingDataForProducts($conn)
{
    $products = array(
        array(
            'name' => 'Iphone14',
            'price' => 1000,
            'description' => 'This is iphone14',
            'available' => 1,
            'image' => 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone-card-40-iphone14pro-202209_FMT_WHH?wid=508&hei=472&fmt=p-jpg&qlt=95&.v=1663611329204',
            'return_policy' => '30 days return policy',
            'user_id' => 1,
            'sold' => 0,
            'shipped' => 0,
            'archive' => 0,
            'cost_price' => 599,
            'discount' => 10
        ),
        array(
            'name' => 'Apple Watch',
            'price' => 399,
            'description' => 'This is Apple Watch',
            'available' => 10,
            'image' => 'https://assets-prd.ignimgs.com/2023/06/29/best-apple-watch-deals-2023-ign-1688052051470.png',
            'return_policy' => '30 days return policy',
            'user_id' => 1,
            'sold' => 0,
            'shipped' => 0,
            'archive' => 0,
            'cost_price' => 299,
            'discount' => 10
        ),

        array(
            'name' => 'Ipad',
            'price' => 799,
            'description' => 'This is ipad',
            'available' => 5,
            'image' => 'https://ss7.vzw.com/is/image/VerizonWireless/apple-ipad-pro-11-replacement-coleus-spacegray-2022?wid=700&hei=700&fmt=webp',
            'return_policy' => 'No returns allowed',
            'user_id' => 1,
            'sold' => 0,
            'shipped' => 0,
            'archive' => 1,
            'cost_price' => 599,
            'discount' => 20
        ),

        array(
            'name' => 'AirPods',
            'price' => 199,
            'description' => 'This is AirPods',
            'available' => 15,
            'image' => 'https://i.insider.com/61d5c65a5a119b00184b1e1a?width=1136&format=jpeg',
            'return_policy' => '30 days return policy',
            'user_id' => 1,
            'sold' => 0,
            'shipped' => 0,
            'archive' => 0,
            'cost_price' => 99,
            'discount' => 0
        ),
        array(
            'name' => 'Macbook',
            'price' => 1599,
            'description' => 'This is macbook',
            'available' => 20,
            'image' => 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/mbp-spacegray-select-202206?wid=640&hei=595&fmt=jpeg&qlt=95&.v=1664497359481',
            'return_policy' => '15 days return policy',
            'user_id' => 2,
            'sold' => 0,
            'shipped' => 0,
            'archive' => 0,
            'cost_price' => 1399,
            'discount' => 0
        ),
        array(
            'name' => 'Apple TV',
            'price' => 149,
            'description' => 'This is Apple TV',
            'available' => 20,
            'image' => '',
            'return_policy' => 'Free return',
            'user_id' => 2,
            'sold' => 0,
            'shipped' => 0,
            'archive' => 0,
            'cost_price' => 99,
            'discount' => 10
        )
    );

    foreach ($products as $product) {
        $name = $product['name'];
        $price = $product['price'];
        $description = $product['description'];
        $available = $product['available'];
        $image = $product['image'];
        $return_policy = $product['return_policy'];
        $user_id = $product['user_id'];
        $sold = $product['sold'];
        $shipped = $product['shipped'];
        $archive = $product['archive'];
        $cost_price = $product['cost_price'];
        $discount = $product['discount'];

        $sql = "INSERT INTO products (name, price, description, available, image, return_policy, user_id, sold, shipped, archive, cost_price, discount) VALUES
            ('$name', $price, '$description', $available, '$image', '$return_policy', $user_id, $sold, $shipped, $archive, $cost_price, $discount)";

        $conn->query($sql);

        $lastProductId = $conn->insert_id;
        $discounted_price = number_format($price * (1 - ($discount / 100)), 2);
        $execution_price = floatval(str_replace(',', '', $discounted_price));

         // Insert into price_history table
        $priceHistorySql = "INSERT INTO price_history (product_id, price) VALUES ($lastProductId, $execution_price)";
        $conn->query($priceHistorySql);
    }
}

// function addTestingDataForProducts($conn)
// {
//     $sql = "INSERT INTO products (name, price, description, available, image, return_policy, user_id,sold,shipped,archive, cost_price, discount) VALUES
//     ('Iphone14', 999, 'This is iphone14', 1, 
//     'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone-card-40-iphone14pro-202209_FMT_WHH?wid=508&hei=472&fmt=p-jpg&qlt=95&.v=1663611329204', 
//     '30 days return policy', 1, 0, 0, 0, 599, 50),
//     ('Apple Watch', 399, 'This is Apple Watch', 10,
//     'https://assets-prd.ignimgs.com/2023/06/29/best-apple-watch-deals-2023-ign-1688052051470.png',
//     '30 days return policy', 1, 0, 0, 0, 299, 10),
//     ('Ipad', 799, 'This is ipad', 5, 
//     'https://ss7.vzw.com/is/image/VerizonWireless/apple-ipad-pro-11-replacement-coleus-spacegray-2022?wid=700&hei=700&fmt=webp', 
//     'No returns allowed', 1, 0, 0, 1, 599, 20),
//     ('AirPods', 199, 'This is AirPods', 15,
//     'https://i.insider.com/61d5c65a5a119b00184b1e1a?width=1136&format=jpeg',
//     '30 days return policy', 1, 0, 0, 0, 99, 0),
//     ('Macbook', 1599, 'This is macbook', 20, 
//     'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/mbp-spacegray-select-202206?wid=640&hei=595&fmt=jpeg&qlt=95&.v=1664497359481', 
//     '15 days return policy', 2, 0, 0, 0, 1399, 0),
//     ('Apple TV', 149, 'This is Apple TV', 20,'','Free return', 2, 0, 0, 0, 99, 10)";
//     $conn->query($sql);

// }

// function addTestingDataForPriceHistory($conn ){
//     $sql = "INSERT INTO price_history (product_id, price) VALUES
//     (1, 800),
//     (1, 700),
//     (1, 900),
//     (1, 600)";
//     $conn->query($sql);
// }

if (!checkTable("price_history", $conn)) {
    require_once "create_price_history_table.php";
}

if (!checkTable("users", $conn)) {
    require_once "create_users_table.php";
    addTestingDataForUsers($conn);
}
if (!checkTable("products", $conn)) {
    require_once "create_products_table.php";
    addTestingDataForProducts($conn);
}
if (!checkTable("purchases", $conn)) {
    require_once "create_purchases_table.php";
}

if (!checkTable("product_reviews", $conn)) {
    require_once "create_product_reviews_table.php";
}

?>