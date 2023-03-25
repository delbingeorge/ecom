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
     <title>Update Product</title>
     <link rel="stylesheet" href="../style/admin-style.css">
</head>

<body>
     <?php
     include '../components/nav.php'
     ?>
     <div class="action-div" id="update">
          <div class="admin-head">
               <a href="./manageProducts.php"><img class="go-back-logo" src="https://cdn-icons-png.flaticon.com/512/271/271220.png" alt="">
               </a>
               <h1>Update product</h1>
          </div>
          <form action="./update-product.php" method="POST" class="product-form" enctype="multipart/form-data">
               <input type="text" id="product_id" name="product_id" placeholder="Product ID" required>
               <input type="text" id="product_name" name="product_name" placeholder="Product Name" required>
               <input type="file" id="image" name="image" required>
               <input type="number" id="price" name="price" min="0" step="0.01" placeholder="Price" required>
               <input type="text" id="description" name="description" min="0" placeholder="Description" required>
               <input type="number" id="qty" name="qty" min="0" placeholder="Quantity" required>
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
               $price = isset($_POST['price']) ? $_POST['price'] : '';
               $des = isset($_POST['description']) ? $_POST['description'] : '';
               $qty = isset($_POST['qty']) ? $_POST['qty'] : '';
               $image = isset($_FILES['image']) ? $_FILES['image'] : '';
               $image_name = $image['name'];
               $image_tmp_name = $image['tmp_name'];
               $image_size = $image['size'];
               $image_error = $image['error'];
               $sqlall = "SELECT p_id FROM products";
               $result = $conn->query($sqlall);
               if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                         if ($row['p_id'] == $product_id) {
                              $sql = "UPDATE products SET p_id='$product_id', product_name = '$product_name',image='$image',price = '$price',description='$des',qty = '$qty'  WHERE p_id = '$product_id';";
                              if (mysqli_query($conn, $sql)) {
                                   header('Location: manageProducts.php');
                              } else {
                                   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                              }
                         } else {
                              echo "No matching product found! <br> <a href='manageproducts.php'>Go Back</a>";
                         }
                    }
               } else {
                    echo "Error: " . $sqlall . "<br>" . mysqli_error($conn);
               }
          }

          mysqli_close($conn);


          ?>
     </div>
</body>

</html>