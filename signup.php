<?php
session_start();
if (isset($_SESSION['user_id'])) {
     header('Location: index.php');
     exit();
}

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'craftsmendb';
$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
}

if (!empty($_POST)) {
     $username = isset($_POST['username']) ? $_POST['username'] : '';
     $email = isset($_POST['email']) ? $_POST['email'] : '';
     $password = isset($_POST['password']) ? $_POST['password'] : '';
     $cpassword = isset($_POST['cpassword']) ? $_POST['cpassword'] : '';
     $address = isset($_POST['address']) ? $_POST['address'] : '';
     $contact = isset($_POST['contact']) ? $_POST['contact'] : '';

     $sql = "INSERT INTO users (username,email,password, address,PhoneNumber) VALUES ('$username','$email','$password', '$password','$contact')";
     if (mysqli_query($conn, $sql)) {
          header("Location:login.php");
     } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
     }
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
     <title>Create Account</title>
     <link rel="stylesheet" href="style/style.css">
</head>

<body>
     <div class="admin-login-div">
          <form method="post" class="login-form">
               <img src="https://cdn-icons-png.flaticon.com/512/456/456212.png">

               <h1>Create Account</h1>
               <div class="form-div">
                    <input placeholder="username" type="text" autocomplete="off" id="username" name="username" required>
                    <input placeholder="email" type="email" autocomplete="off" id="email" name="email" required>
               </div>
               <div class="form-div">
                    <input placeholder="password" type="password" autocomplete="off" id="password" name="password" required>
                    <input placeholder="confirm" type="password" autocomplete="off" id="cpassword" name="cpassword" required>
               </div>
               <div class="form-div">
                    <input placeholder="address" type="text" autocomplete="off" id="address" name="address" required>
                    <input placeholder="number" type="text" autocomplete="off" id="contact" name="contact" required>
               </div>
               <input type="submit" value="Login">
               <?php if (isset($error_message)) { ?>
                    <p class="invalid-msg"><?php echo $error_message; ?></p>
               <?php } ?>
               <div class="log-div">
                    <a href="login.php">already have an account</a>
               </div>
          </form>
     </div>
</body>

</html>