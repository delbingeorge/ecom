<?php
session_start();
if (!isset($_SESSION['uid'])) {
     header("Location: login.php");
     exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "craftsmendb";
$uid = $_SESSION['uid'];
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
     $username = $_POST['username'];
     $email = $_POST['email'];
     $address = $_POST['address'];
     $phoneNumber = $_POST['phoneNumber'];
     $sql = "UPDATE users SET username='$username', email='$email', address='$address', phoneNumber='$phoneNumber' WHERE uid='$uid'";
     if ($conn->query($sql) === TRUE) {
          echo "Record updated successfully";
     } else {
          echo "Error updating record: " . $conn->error;
     }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Update Profile</title>
     <link rel="stylesheet" href="style/style.css">
</head>

<body>
     <?php
     include './components/nav.php';
     ?>
     <div class="div-head">
          <h1>Update Profile</h1>
     </div>
     <form action="" method="post" class="login-form">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" required>
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required>
          <label for="address">Address</label>
          <input type="text" id="address" name="address" required>
          <label for="phoneNumber">Phone Number</label>
          <input type="text" id="phoneNumber" name="phoneNumber" required>
          <button type="submit" class="add-to-cart-btn" name="submit">Update</button>
     </form>
</body>

</html>