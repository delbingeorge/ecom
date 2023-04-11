<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
     // If admin user is not logged in, redirect to login page
     header('Location: login.php');
     exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <title>Manage Products</title>
     <link rel="stylesheet" href="../style/admin-style.css">
     <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/2713/2713537.png" type="image/x-icon">
</head>

<body>
     <?php
     include '../components/nav.php'
     ?>
     <div class="dash-div">
          <div class="admin-head">
               <img class="admin-logo" src="https://cdn-icons-png.flaticon.com/512/3114/3114633.png" alt="">
               <h1>
                    Manage Products
               </h1>
          </div>
          <div class="dash-div-btn">
               <div>
                    <a href="./add-product.php" style="background-color: green;" class="dash-btn"> Add</a>
                    <a href="./update-product.php" class="dash-btn">Update</a>
               </div>
               <div class="show-items">
                    <h2>All Products</h2>
                    <?php
                    // Set up database 
                    $script = "";
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "craftsmendb";
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Query the database for the latest 10 items in the orders table
                    $sql = "SELECT * FROM products";
                    $result = $conn->query($sql);

                    // Display the results in an HTML table
                    echo "<table class='order-news'>";
                    echo "<tr>
               <th>Product ID</th>
               <th>Product Name</th>
               <th>Image</th>
               <th>Price</th>
               <th>Description</th>
               <th>Qty</th>
               <th>Remove</th>
               </tr>";
                    if ($result->num_rows > 0) {
                         while ($row = $result->fetch_assoc()) {
                              echo "<tr class='order-res'>
                         <td>" . $row["p_id"] . "</td>
                         <td>" . $row["product_name"] . "</td>
                         <td>" . $row["image"] . "</td>
                         <td>" . $row["price"] . "</td>
                         <td>" . $row["description"] . "</td>
                         <td>" . $row["qty"] . "</td>
                         <td>
                         <form method='POST'>
                              <input type='hidden' name='pid' value='" . $row["p_id"] . "'>
                              <button type='submit' class='del-btn'><img src='https://cdn-icons-png.flaticon.com/512/6861/6861362.png'/></button>
                         </form>
                              </td>
                         
                         </tr>";
                         }
                    } else {
                         echo "<tr><td colspan='7'>No results found.</td></tr>";
                    }
                    echo "</table>";
                    $pid = isset($_POST['pid']) ? $_POST['pid'] : '';
                    $sqlall = "SELECT p_id FROM products";
                    $result = $conn->query($sqlall);
                    if ($result->num_rows > 0) {
                         while ($row = $result->fetch_assoc()) {
                              if ($row['p_id'] == $pid) {
                                   $sql = "DELETE FROM products WHERE p_id='$pid'";
                                   if (mysqli_query($conn, $sql)) {
                                        echo "<script>alert('Product Removed!')</script>";
                                        echo "<script>window.location.href='manageProducts.php'</script>";
                                   } else {
                                        echo "<script>alert('Failed to remove product!');</script>";
                                   }
                              }
                         }
                    }
                    $conn->close();
                    ?>

               </div>
          </div>
</body>

</html>