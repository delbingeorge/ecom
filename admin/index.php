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
     <nav>
          <a href="index.php">
               <img src="../media/images/craftLogo.png">
          </a>
          <form method="post" action="logout.php">
               <button type="submit" name="logout_btn" class="logout-btn"><img src="../media/icons/logout.png"></button>
          </form>
     </nav>
     <div class="dash-div">
          <div class="admin-head">
               <img class="admin-logo" src="https://cdn-icons-png.flaticon.com/512/6995/6995809.png" alt="">
               <h1>
                    Admin Dashboard
               </h1>
          </div>
          <div class="dash-div-btn">
               <a href="./products/manageProducts.php" class="dash-btn">Manage Product</a>
               <a href="./user/manageUsers.php" class="dash-btn">User Info</a>
               <a href="./order/manageOrder.php" class="dash-btn">Show orders</a>
               <a href="./feedback/feedback.php" class="dash-btn">View feedback</a>
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
               <th>Address</th>
               </tr>";
               if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                         echo "<tr class='order-res'>
                         <td>" . $row["o_id"] . "</td>
                         <td>" . $row["uid"] . "</td>
                         <td>" . $row["p_name"] . "</td>
                         <td>" . $row["created_at"] . "</td>
                         <td>" . $row["qty"] . "</td>
                         <td>" . $row["total"] . "</td>
                         <td>" . $row["address"] . "</td>
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