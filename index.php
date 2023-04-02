<?php
session_start();
if (!isset($_SESSION['uid'])) {
     header("Location: login.php");
     exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Craftmen Hardware</title>
     <link rel="stylesheet" href="style/style.css">
     <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/2713/2713537.png" type="image/x-icon">
</head>

<body>
     <?php
     include './components/nav.php';
     $uid = $_SESSION['uid'];
     ?>

     <div class="search-div">
          <form method="GET" class="search-form">
               <input type="text" name="query" placeholder="search something here" />
               <input type="submit" value="Search" />
          </form>
     </div>
     <div class="search-result-div">
          <h1 class="search-title">Suggested Items</h1>
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
               $query = isset($_GET['query']) ? $_GET['query'] : '';

               $sql = "SELECT * FROM products WHERE product_name LIKE '%$query%'";
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
          </div>
     </div>
     <?php
     include './components/footer.php';
     ?>
</body>

</html>