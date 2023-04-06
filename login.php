<?php
session_start();

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
     $stmt = $conn->prepare("SELECT uid, username, email, password FROM users WHERE email = ?");
     $stmt->bind_param("s", $input_email);
     $stmt->execute();
     $result = $stmt->get_result();

     if ($result->num_rows === 1) {
          $row = $result->fetch_assoc();
          $db_uid = $row['uid'];
          $db_username = $row['username'];
          $db_email = $row['email'];
          $db_password = $row['password'];
          if ($input_password === $db_password && $input_email === $db_email) {
               $_SESSION['uid'] = $db_uid;
               $_SESSION['username'] = $db_username;
               $_SESSION['email'] = $db_email;
               header('Location: index.php');
               exit();
          }
     } else {
          $error_message = 'Invalid username or password';
     }
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
               <?php
               if (isset($error_message)) {
                    echo "<p class='invalid-msg'>" . $error_message . "</p>";
               }
               ?>
               <div class="log-div">
                    <a href="forgotpass.php">forgot password!</a>
                    <a href="signup.php">create account</a>
               </div>
          </form>
     </div>
</body>

</html>