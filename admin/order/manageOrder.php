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

               $sql = "SELECT * FROM orders ORDER BY created_at DESC LIMIT 10";
               $result = $conn->query($sql);

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
                    echo "<tr><td colspan='7'>No results found.</td></tr>";
               }
               echo "</table>";

               // Close database connection
               $conn->close();
               ?>

          </div>

     </div>
</body>

</html>