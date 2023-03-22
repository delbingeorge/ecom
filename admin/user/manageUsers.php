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
     <title>Manage Products</title>
     <link rel="stylesheet" href="../style/admin-style.css">
</head>

<body>
     <?php
     include '../components/nav.php'
     ?>
     <div class="dash-div">
          <h1>Manage Users</h1>
          <div class="dash-div-btn">
               <div>
                    <a href="add-user.php" style="background-color: green;" class="dash-btn">Add</a>
                    <a href="update-user.php" class="dash-btn">Update</a>
                    <a href="delete-user.php" style="background-color: red;" class="dash-btn">Delete</a>
               </div>
               <div class="show-items">
                    <h2>All Users</h2>
                    <?php
                    // Set up database connection
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "craftsmendb";
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Query the database for the latest 10 items in the orders table
                    $sql = "SELECT * FROM customers";
                    $result = $conn->query($sql);

                    // Display the results in an HTML table
                    echo "<table class='order-news'>";
                    echo "<tr>
               <th>User ID</th>
               <th>User Name</th>
               <th>Email</th>
               </tr>";
                    if ($result->num_rows > 0) {
                         while ($row = $result->fetch_assoc()) {
                              echo "<tr class='order-res'>
                         <td>" . $row["id"] . "</td>
                         <td>" . $row["name"] . "</td>
                         <td>" . $row["email"] . "</td>
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