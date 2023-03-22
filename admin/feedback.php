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
     <title>User Feedbacks</title>
     <link rel="stylesheet" href="style/admin-style.css">
</head>

<body>
     <?php
     include './components/nav.php'
     ?>
     <div class="dash-div">
          <h1>User feedback</h1>
          <div class="dash-div-btn">
               <div class="show-items">
                    <?php
                    // Set up database connection
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "craftsmendb";
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Query the database for the latest 10 items in the orders table
                    $sql = "SELECT * FROM feedback";
                    $result = $conn->query($sql);

                    // Display the results in an HTML table
                    echo "<table class='order-news'>";
                    echo "<tr>
               <th>Feedback ID</th>
               <th>Username</th>
               <th>Content</th>
               <th>Date</th>
               <th>Email</th>
               </tr>";
                    if ($result->num_rows > 0) {
                         while ($row = $result->fetch_assoc()) {
                              echo "<tr class='order-res'>
                         <td>" . $row["feedback_id"] . "</td>
                         <td>" . $row["username"] . "</td>
                         <td>" . $row["content"] . "</td>
                         <td>" . $row["date"] . "</td>
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