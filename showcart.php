<?php
session_start();
if (!isset($_SESSION['uid'])) {
     header("Location: login.php");
     exit();
}

include './components/nav.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Your Cart</title>
     <link rel="stylesheet" href="style/style.css">
     <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/891/891462.png" type="image/x-icon">
</head>

<body>
     <div class="div-head">
          <h1>Your Cart</h1>
     </div>


     <?php
     echo " <div class='cart-div'><div class='search-card-div'>";
     $uid = $_SESSION['uid'];
     $name = $_SESSION['username'];
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "craftsmendb";
     $conn = new mysqli($servername, $username, $password, $dbname);
     if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
     }

     $sql = "SELECT * FROM cart WHERE uid='$uid'";
     $sqlone = "SELECT SUM(total) as total_sum FROM cart WHERE uid='$uid';";
     $result = $conn->query($sql);
     $sum = $conn->query($sqlone);

     if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
               $image_path = "./admin/products/uploads/" . $row['image'];
               echo "<div class='product-card'>
                                   <img src='" . $image_path . "'/>
                                   <h1 class='product-name'>" . $row['product_name'] . "</h1>
                                   <h2 class='price'> ₹" . $row['total'] . "</h2>
                                   <h2 class='qty'> Qty: " . $row['quantity'] . "</h2>
                                   <form method='POST' action='deleteItem.php'>
                                        <input type='hidden' name='del_pid' value='" . $row["p_id"] . "'>
                                        <input type='hidden' name='item_qty' value='" . $row["quantity"] . "'>
                                        <button type='submit' class='add-to-cart-btn'>Remove</button>
                                   </form>
                    </div>";
          }
     } else {
          echo "
                    <div class='empty-cart'>
                          <img src='https://cdn-icons-png.flaticon.com/512/1376/1376786.png' alt=''/>
                          <h1>" . $name . ", your cart is empty!</h1>
                    </div>
                    ";
     }

     $conn->close();
     if ($sum->num_rows > 0) {
          $row = $sum->fetch_assoc();
          $total_sum = $row["total_sum"];
     }
     if ($total_sum > 0) {
          echo "</div>
          <div class='place-order-div'>
          <div>
          <h1><span>₹</span>" . $total_sum .  " </h1>
          </div>
          <form method='POST' action='paymentMode.php'>
                 <button type='submit' class='add-to-cart-btn'>Place Order</button>
          </form>
          </div>";
     } else {
          echo "<div></div>";
     }
     ?>
     </div>
     </div>
     <?php
     include './components/footer.php'; ?>
</body>

</html>