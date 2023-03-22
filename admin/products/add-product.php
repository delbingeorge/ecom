<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
     header('Location: login.php');
     exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Add Products</title>
     <link rel="stylesheet" href="../style/admin-style.css">
</head>

<body>
<?php
     include '../components/nav.php'
     ?>
     <div class="action-div" id="add">
          <h1>Add product</h1>
          <form action="./add-product.php" method="POST" class="product-form">
               <input type="text" id="product_id" name="product_id" placeholder="Product ID" required>
               <input type="text" id="product_name" name="product_name" placeholder="Product Name" required>
               <input type="number" id="qty" name="qty" min="0" step="0.01" placeholder="Quantity" required>
               <input type="number" id="price" name="price" min="0" step="0.01" placeholder="Price" required>
               <input type="submit" value="Add">
          </form>
          <?php
          $host = 'localhost';
          $username = 'root';
          $password = '';
          $dbname = 'craftsmendb';
          $conn = mysqli_connect($host, $username, $password, $dbname);
          if (!$conn) {
               die("Connection failed: " . mysqli_connect_error());
          }

          if (!empty($_POST)) {
               $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
               $product_name = isset($_POST['product_name']) ? $_POST['product_name'] : '';
               $qty = isset($_POST['qty']) ? $_POST['qty'] : '';
               $price = isset($_POST['price']) ? $_POST['price'] : '';
               $sql = "INSERT INTO products (product_id,product_name,qty, price) VALUES ('$product_id','$product_name','$qty', '$price')";
               if (mysqli_query($conn, $sql)) {
                    echo "Product added! <br> <a href='manageproducts.php'>Go Back</a>";
               } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
               }
          }
          mysqli_close($conn);
          ?>
     </div>
</body>

</html>