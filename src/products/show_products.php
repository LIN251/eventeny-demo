<?php
  // Fetch all products from the 'products' table
  $sql = "SELECT * FROM products WHERE archive = '0'";
  $result = $conn->query($sql);

  function findUserName($user_id,$conn){
    $usersql = "SELECT username FROM users WHERE user_id = '$user_id'";
    $usernameresult = $conn->query($usersql);
    $username = "";
    if ($usernameresult->num_rows > 0) {
      $userRow = $usernameresult->fetch_assoc();
      $username = $userRow["username"];
    }
    return $username;
  }

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $username = findUserName($row["user_id"],$conn);
        echo '<div class="product" id="'. $row["product_id"] . '">';
        echo '<div class="product-image">';
        $imageURL = "https://via.placeholder.com/100";
        if(!empty($row["image"])){
          $imageURL  =  $row["image"];
          echo '<img src="' . $imageURL . '" alt="Product Image">';
        }else{
          echo '<p class="no-image">Seller did not provide<br> a product image.<p>';
        }
        echo '</div>';
        echo '<div class="product-details">';
        echo '<h3> Product: ' . $row["name"] . '</h3>';
        echo '<p>Price: $' . $row["price"] . '</p>';
        echo '<p >Description: ' . $row["description"] . '</p>';
        echo '<p>Available: ' . $row["available"] . '</p>';
        echo '<p>Return Policy: ' . $row["returns_policy"] . '</p>';
        echo '<p class="sellerInfo">Sell By: ' . $username . '</p>';
        if ($row["available"] > 0) {
          echo '<form action="./products/purchase_product.php" method="post">';
          echo '<input type="hidden" name="product_id" value="' . $row["product_id"] . '">';
          echo '<input type="hidden" name="available" value="' . $row["available"] . '">';
          echo '<input type="hidden" name="name" value="' . $row["name"] . '">';
          echo '<input type="hidden" name="price" value="' . $row["price"] . '">';
          echo '<input type="hidden" name="description" value="' . $row["description"] . '">';
          echo '<input type="hidden" name="returns_policy" value="' . $row["returns_policy"] . '">';
          echo '<input type="hidden" name="image" value="' . $imageURL . '">';
          echo '<input type="submit" value="Purchase As Guest">';
          echo '</form>';
        } else {
          echo '<form action="./products/purchase_product.php" method="post">';
          echo '<input style="background-color: grey;" type="submit" value="Out of Stock" disabled>';
          echo '</form>';
        }
        echo '</div>';
        echo '</div>';
    }
  } else {
    echo '<p>No products are on sale.</p>';
  }

  // Close the database connection
  $conn->close();
?>
