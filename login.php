<?php
session_start();
if (isset($_SESSION['email'])) {
     header('Location: index.php');
     exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $input_email = $_POST['email'];
     $input_password = $_POST['password'];
     $host = 'localhost';
     $username = 'root';
     $password = '';
     $dbname = 'craftsmendb';
     $conn = new mysqli($host, $username, $password, $dbname);
     if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
     }
     $sql = "SELECT email, password FROM users WHERE email = '$input_email' AND password='$input_password'";
     $result = $conn->query($sql);

     if ($result->num_rows === 1) {
          $row = $result->fetch_assoc();
          $db_username = $row['email'];
          $db_password = $row['password'];
          if ($input_password === $db_password) {
               $_SESSION['email'] = $db_username;
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
     <link rel="stylesheet" href="style/style.css">
</head>

<body>
     <div class="admin-login-div">
          <form method="post" class="login-form">
               <img src="https://cdn-icons-png.flaticon.com/512/456/456212.png">

               <h1>User Login</h1>
               <input placeholder="email" type="email" autocomplete="off" id="email" name="email" required>
               <input placeholder="password" type="password" autocomplete="off" id="password" name="password" required>
               <input type="submit" value="Login">
               <?php if (isset($error_message)) { ?>
                    <p class="invalid-msg"><?php echo $error_message; ?></p>
               <?php } ?>
               <div class="log-div">
                    <a href="forgotpass.php">forgot password!</a>
                    <a href="signup.php">create account</a>
               </div>
          </form>
     </div>
</body>

</html>