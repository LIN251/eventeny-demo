<?php
    // Insert the new user into the database
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashedPassword', '$email')";

    if (!$conn->query($sql) === TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>
