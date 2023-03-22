<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
     header('Location: login.php');
     exit();
}
?>

<!DOCTYPE html>
<html>

<head>
     <title>Admin Dashboard</title>
     <link rel="stylesheet" href="style/admin-style.css">

</head>

<body>
     <?php
     include './components/nav.php';
     ?>
     <div class="dash-div">
          <h1>Admin Dashboard</h1>
          <div class="dash-div-btn">
               <a href="manageproducts.php" class="dash-btn">Manage Product</a>
               <a href="manageUsers.php" class="dash-btn">Manage user</a>
               <a href="manageOrder.php" class="dash-btn">Manage orders</a>
               <a href="feedback.php" class="dash-btn">View feedback</a>
               <a href="" class="dash-btn">Generate Report</a>
          </div>
          <div class="dash-news">
               <h2>Latest Orders</h2>
               <?php
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
                    echo "<tr><td colspan='4'>No results found.</td></tr>";
               }
               echo "</table>";

               // Close database connection
               $conn->close();
               ?>

          </div>
     </div>
</body>

</html>