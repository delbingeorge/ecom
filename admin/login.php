<?php
session_start();

if (isset($_SESSION['admin_id'])) {
     header('Location: index.php');
     exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $input_username = trim($_POST['username']);
     $input_password = trim($_POST['password']);

     // Validate user inputs
     if (empty($input_username) || empty($input_password)) {
          $error_message = 'Please enter a username and password';
     } else {
          try {
               $host = 'localhost';
               $username = 'root';
               $password = '';
               $dbname = 'craftsmendb';

               // Establish a database connection using PDO
               $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
               $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

               // Use prepared statements with parameterized queries to prevent SQL injection attacks
               // Use prepared statements with parameterized queries to prevent SQL injection attacks
               $stmt = $pdo->prepare("SELECT adminname, password FROM admin WHERE adminname = :username");
               $stmt->bindParam(':username', $input_username);
               $stmt->execute();
               $row = $stmt->fetch(PDO::FETCH_ASSOC);

               if ($row !== false && $row["adminname"] === $input_username && $input_password === $row['password']) {
                    $_SESSION['admin_id'] = $row['adminname'];
                    header('Location: index.php');
                    exit();
               } else {
                    $error_message = 'Invalid username or password';
               }
          } catch (PDOException $e) {
               $error_message = 'Database error: ' . $e->getMessage();
          }
     }
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
          <div class="log-div">
               <a href="../index.php">login as customer</a>
          </div>
     </div>
</body>

</html>