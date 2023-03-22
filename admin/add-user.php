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
     <link rel="stylesheet" href="style/admin-style.css">
</head>

<body>
    
     <div class="action-div" id="add">
          <h1>Add product</h1>
          <form action="add.php" method="POST" class="product-form">
               <input type="text" id="userId" name="userId" placeholder="userid" required>
               <input type="text" id="name" name="name" placeholder="username" required>
               <input type="text" id="email" name="email" min="0" step="0.01" placeholder="email" required>
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
               $userId = isset($_POST['userId']) ? $_POST['userId'] : '';
               $userName = isset($_POST['name']) ? $_POST['name'] : '';
               $email = isset($_POST['email']) ? $_POST['email'] : '';
               $sql = "INSERT INTO customers (id,name,email) VALUES ('$userId','$userName','$email')";
               if (mysqli_query($conn, $sql)) {
                    echo "User added! <br> <a href='manageUser.php'>Go Back</a>";
               } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
               }
          }
          mysqli_close($conn);
          ?>
     </div>
</body>

</html>