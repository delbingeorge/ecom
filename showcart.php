<?php
include './components/nav.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="style/style.css">
</head>

<body>
     <div class="search-result-div">
          <h1 class="search-title">Your cart</h1>
          <div class="search-card-div">

               <?php
               $servername = "localhost";
               $username = "root";
               $password = "";
               $dbname = "craftsmendb";
               $conn = new mysqli($servername, $username, $password, $dbname);
               if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
               }

               $sql = "SELECT * FROM cart";
               $result = $conn->query($sql);

               if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                         $image_path = "./admin/products/uploads/" . $row['image'];
                         echo "<div class='product-card'>
                    <img src='" . $image_path . "'/>
                    <h1 class='product-name'>" . $row['product_name'] . "</h1>
                    <h2 class='product-price'> ₹" . $row['price'] . "</h2>
                    <form method='POST' action='deleteItem.php'>
                         <input type='hidden' name='del_pid' value='" . $row["p_id"] . "'>
                         <button type='submit' class='add-to-cart-btn'>Remove</button>
                     </form>
                    </div>";
                    }
               } else {
                    echo "Your Cart is empty!";
               }
               $conn->close();
               ?>
          </div>
     </div>
</body>

</html>