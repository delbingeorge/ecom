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
     <title>Product Details</title>
     <link rel="stylesheet" href="style/style.css">

</head>

<body>
     <?php
     include './components/nav.php';
     $uid = $_SESSION['uid'];
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "craftsmendb";
     $conn = new mysqli($servername, $username, $password, $dbname);
     if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
     }

     $pid = isset($_POST['pid']) ? $_POST['pid'] : '';
     $sql = "SELECT * FROM products WHERE p_id = $pid";
     $result = $conn->query($sql);

     if ($result->num_rows == 1) {
          $row = $result->fetch_assoc();
          $image_path = "./admin/products/uploads/" . $row['image'];
          echo "
          <div class='product-details'>
                <div class='product-img'>
                    <img src='" . $image_path . "' />
                </div>
               <div class='product-info'>
                    <h1>" . $row['product_name'] . "</h1>
                    <h2>" . $row['description'] . "</h2>
                    <h1 class='price'>₹" . $row['price'] . "</h1>
                    <form method='POST' action='cart.php'>
                         <input type='hidden' name='pid' value='" . $row["p_id"] . "'>
                         <input type='number' class='qty-field' name='qty' value='1'>
                         <button type='submit' class='add-to-cart-btn'>Add To Cart</button>
                    </form>
               </div>
          </div>
          ";
     } else {
          echo "Product not found!";
     }
     $conn->close();
     include './components/footer.php';
     ?>
</body>

</html>