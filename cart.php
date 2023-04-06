<?php
session_start();
if (!isset($_SESSION['uid'])) {
     header("Location: login.php");
     exit();
}

if (isset($_POST['pid'])) {
     $pid = $_POST['pid'];
     $uid = $_SESSION['uid'];
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "craftsmendb";
     $conn = new mysqli($servername, $username, $password, $dbname);
     if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
     }

     // Check if item already exists in cart
     $sql = "SELECT * FROM cart WHERE p_id = '$pid'";
     $result = $conn->query($sql);
     if ($result->num_rows > 0) {
          // Update quantity of existing item in cart
          $row = $result->fetch_assoc();
          $cart_id = $row['cart_id'];
          $quantity = $row['quantity'] + 1;
          $sql = "UPDATE cart SET quantity = '$quantity' WHERE uid = '$uid'";
          if ($conn->query($sql) === TRUE) {
               header("Location: index.php");
          } else {
               echo "Error updating cart: " . $conn->error;
          }
     } else {
          // Add new item to cart
          $sql = "SELECT * FROM products WHERE p_id = '$pid'";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
               $row = $result->fetch_assoc();
               $product_id = $row['p_id'];
               $product_name = $row['product_name'];
               $quantity = $_POST['qty'];
               $price = $row['price'];
               $total = $row['price'] * $quantity;
               $image = $row['image'];
               if ($quantity > $row['qty']) {
                    echo "Quantity is high!";
               } else {
                    $sql = "INSERT INTO cart (p_id, uid, product_name, quantity, price, image,total) VALUES ('$pid', '$uid', '$product_name', '$quantity', '$price', '$image','$total')";
                    $updateQty = "UPDATE products  SET qty = qty-'$quantity' WHERE p_id = '$product_id'";
                    if ($conn->query($sql) === TRUE) {
                         $conn->query($updateQty);
                         header("Location: index.php");
                    } else {
                         echo "Error adding to cart: " . $conn->error;
                    }
               }
          } else {
               echo "Product not found!";
          }
     }

     $conn->close();
}
