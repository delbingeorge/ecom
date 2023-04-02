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
     <title>Dashboard</title>
     <link rel="stylesheet" href="../style/admin-style.css">  <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/2713/2713537.png" type="image/x-icon">
</head>

<body>
     <?php
     include '../components/nav.php'
     ?>
     <div class="dash-div">
          <div class="dash-news">
          <div class="admin-head">
               <img class="admin-logo" src="https://cdn-icons-png.flaticon.com/512/1007/1007959.png" alt="">
               <h1>
                    Manage Orders
               </h1>
          </div>  <?php
               // Set up database connection
               $servername = "localhost";
               $username = "root";
               $password = "";
               $dbname = "craftsmendb";
               $conn = new mysqli($servername, $username, $password, $dbname);

               // Query the database for the latest 10 items in the orders table
               $sql = "SELECT * FROM orders ORDER BY created_at DESC LIMIT 10";
               $result = $conn->query($sql);

               // Display the results in an HTML table
               echo "<table class='order-news'>";
               echo "<tr>
               <th>Order ID</th>
               <th>Customer ID</th>
               <th>Product Name</th>
               <th>Order Date</th>
               <th>Quantity</th>
               <th>Total</th>
               </tr>";
               if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                         echo "<tr class='order-res'>
                         <td>" . $row["id"] . "</td>
                         <td>" . $row["customer_id"] . "</td>
                         <td>" . $row["product_name"] . "</td>
                         <td>" . $row["created_at"] . "</td>
                         <td>" . $row["quantity"] . "</td>
                         <td>" . $row["price"] . "</td>
                         </tr>";
                    }
               } else {
                    echo "<tr><td colspan='6'>No results found.</td></tr>";
               }
               echo "</table>";

               // Close database connection
               $conn->close();
               ?>

          </div>

     </div>
</body>

</html>