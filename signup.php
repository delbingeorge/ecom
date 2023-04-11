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
     $city = isset($_POST['city']) ? $_POST['city'] : '';
     $pincode = isset($_POST['pincode']) ? $_POST['pincode'] : '';

     try {
          // validate email
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
               throw new Exception("Invalid email format");
          } elseif (!preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
               throw new Exception("Invalid email format");
          } elseif (strlen($password) < 8) {
               throw new Exception("Password must be at least 8 characters long");
          } elseif ($password != $cpassword) {
               throw new Exception("Passwords do not match");
          } elseif (!preg_match("/^([0-9]{10,10})$/", $contact)) {
               throw new Exception("enter a valid number");
          } else {
               // check if email already exists in database
               $email_exists_query = "SELECT * FROM users WHERE email = '$email'";
               $result = mysqli_query($conn, $email_exists_query);
               if (mysqli_num_rows($result) > 0) {
                    throw new Exception("Email already exists");
               } else {
                    // insert user data into database
                    $sql = "INSERT INTO users (username, email, password, address, PhoneNumber,city,pincode) VALUES ('$username', '$email', '$password', '$address', '$contact','$city','$pincode')";
                    if (mysqli_query($conn, $sql)) {
                         header("Location:login.php");
                    } else {
                         throw new Exception("Error: " . $sql . "<br>" . mysqli_error($conn));
                    }
               }
          }
     } catch (Exception $e) {
          $error_message = $e->getMessage();
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
                    <input placeholder="full name" type="text" autocomplete="off" id="username" name="username" required>
                    <input placeholder="email address" type="email" autocomplete="off" id="email" name="email" required>
               </div>
               <div class="form-div">
                    <input placeholder="password" type="password" autocomplete="off" id="password" name="password" required>
                    <input placeholder="confirm password" type="password" autocomplete="off" id="cpassword" name="cpassword" required>
               </div>
               <div class="form-div">
                    <input placeholder="delivery address" type="text" autocomplete="off" id="address" name="address" required>
                    <input placeholder="contact number" type="number" autocomplete="off" maxlength="10" id="contact" name="contact" required>
               </div>
               <div class="form-div">
                    <input placeholder="city" type="text" autocomplete="off" id="city" name="city" required>
                    <input placeholder="pincode " type="number" autocomplete="off" maxlength="6" id="pincode" name="pincode" required>
               </div>
               <input type="submit" value="Create Account">
               <?php if (isset($error_message)) { ?>
                    <p class="invalid-msg"><?php echo $error_message; ?></p>
               <?php } ?>
               <div class="log-div">
                    <a href="login.php">Already have an account?</a>
               </div>
          </form>
     </div>
     </div>
</body>

</html>