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
     <title>Delete Proudct</title>
     <link rel="stylesheet" href="../style/admin-style.css">
</head>

<body>
     <?php
     include '../components/nav.php'
     ?>
     <div class="action-div" id="delete">
          <h1>Delete product</h1>
          <form action="./delete-user.php" method="POST" class="product-form">
               <input type="text" id="id" name="id" placeholder="User ID" required>
               <input type="submit" value="Delete">
          </form>

          <?php
          // Replace these values with your own database credentials
          $host = 'localhost';
          $username = 'root';
          $password = '';
          $dbname = 'craftsmendb';

          // Create connection
          $conn = mysqli_connect($host, $username, $password, $dbname);

          // Check connection
          if (!$conn) {
               die("Connection failed: " . mysqli_connect_error());
          }


          if (!empty($_POST)) {
               $id = isset($_POST['id']) ? $_POST['id'] : '';
               $sqlall = "SELECT id FROM customers";
               $result = $conn->query($sqlall);
               if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                         if ($row['id'] == $id) {
                              $sql = "DELETE FROM customers WHERE id='$id'";
                              if (mysqli_query($conn, $sql)) {
                                   echo "User Removed! <br> <a href='../user/manageUsers.php'>Go Back</a>";
                              } else {
                                   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                              }
                         } else {
                              echo "No matching user id found! <br> <a href='../user/manageUsers.php'>Go Back</a>";
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