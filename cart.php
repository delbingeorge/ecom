<?php
session_start();
if (isset($_SESSION['uid'])) {
     header('Location: index.php');
     exit();
}

if (isset($_POST['pid'])) {
     $pid = $_POST['pid'];
     // $uid = $_SESSION['uid'];

     // Connect to database
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
          $sql = "UPDATE cart SET quantity = '$quantity' WHERE cart_id = '$cart_id'";
          if ($conn->query($sql) === TRUE) {
               echo "<script>alert('Items Added to cart!');</script>";
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
               $product_name = $row['product_name'];
               $quantity = 1;
               $price = $row['price'];
               $image = $row['image'];
               $sql = "INSERT INTO cart (p_id, uid, product_name, quantity, price, image) VALUES ('$pid', '$uid', '$product_name', '$quantity', '$price', '$image')";
               if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Items Added to cart!');</script>";
                    header("Location: index.php");
               } else {
                    echo "Error adding to cart: " . $conn->error;
               }
          } else {
               echo "Product not found!";
          }
     }

     $conn->close();
}
