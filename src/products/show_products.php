<?php
  // Fetch all products from the 'products' table
  $sql = "SELECT * FROM products";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo '<div class="product">';
      echo '<h3> Product: ' . $row["name"] . '</h3>';
      echo '<p>Price: $' . $row["price"] . '</p>';
      echo '<p>Description:' . $row["description"] . '</p>';
      echo '<p>Available: ' . $row["available"] . '</p>';
      echo '<p>Return Policy: ' . $row["returns_policy"] . '</p>';
      echo 'Product Images: '. '<br>';
      echo '<img src="' . $row["image"] . '" alt="Product Image">';
      echo '</div>';
    }
  } else {
    echo '<p>No products are on sale.</p>';
  }

  // Close the database connection
  $conn->close();
?>