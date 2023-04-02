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
     <?php
     include './components/nav.php';
     ?> <div class="div-head">
          <h1>Your Profile</h1>
     </div>
     <?php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "craftsmendb";
     $conn = new mysqli($servername, $username, $password, $dbname);
     if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
     }
     $query = isset($_GET['query']) ? $_GET['query'] : '';

     $sql = "SELECT * FROM users WHERE product_name LIKE '%$query%'";
     $result = $conn->query($sql);

     if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
               $image_path = "./admin/products/uploads/" . $row['image'];
               echo "
                         <div class='product-card'>
                              <img src='" . $image_path . "'/>
                              <h1 class='product-name'>" . $row['product_name'] . "</h1>
                              <h2 class='product-price'> ₹" . $row['price'] . "</h2>
                              <div class='btn-grp'>
                                   <form method='POST' action='cart.php'>
                                        <input type='hidden' name='qty' value='1'>
                                        <input type='hidden' name='pid' value='" . $row["p_id"] . "'>
                                        <button type='submit' class='add-to-cart-btn'>Add To Cart</button>
                                   </form>
                                   <form method='POST' action='product-details.php'>
                                        <input type='hidden' name='pid' value='" . $row["p_id"] . "'>
                                        <button type='submit' class='view-dtls-btn'>View Details</button>
                                   </form>
                              </div>
                         </div>";
          }
     } else {
          echo "No Results!";
     }
     $conn->close();
     ?>
</body>

</html>