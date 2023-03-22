<?php
session_start();
if (isset($_SESSION['admin_id'])) {
     header('Location: index.php');
     exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $input_username = $_POST['username'];
     $input_password = $_POST['password'];
     $host = 'localhost';
     $username = 'root';
     $password = '';
     $dbname = 'craftsmendb';
     $conn = new mysqli($host, $username, $password, $dbname);
     if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
     }
     $sql = "SELECT adminname, password FROM admin WHERE adminname = '$input_username'";
     $result = $conn->query($sql);

     if ($result->num_rows === 1) {
          $row = $result->fetch_assoc();
          $db_username = $row['adminname'];
          $db_password = $row['password'];
          if ($input_password === $db_password) {
               $_SESSION['admin_id'] = $db_username;
               header('Location: index.php');
               exit();
          }
     }
     $error_message = 'Invalid username or password';
     $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
     <title>Login</title>
     <link rel="stylesheet" href="style/admin-style.css">
</head>

<body>
     <div class="admin-login-div">
          <form method="post" class="login-form">
               <img src="../media/images/craftLogo.png">
               <h1>admin login</h1>

               <input placeholder="username" type="text" autocomplete="off" id="username" name="username" required>

               <input placeholder="password" type="password" autocomplete="off" id="password" name="password" required>
               <input type="submit" value="Login">
               <?php if (isset($error_message)) { ?>
                    <p class="invalid-msg"><?php echo $error_message; ?></p>
               <?php } ?>
          </form>
     </div>
</body>

</html>