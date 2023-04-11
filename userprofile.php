<?php
session_start();
if (!isset($_SESSION['uid'])) {
     header("Location: login.php");
     exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="style/style.css">
</head>

<body>

     <?php
     include './components/nav.php';
     ?>

     <div class="div-head">
          <h1>Your Profile</h1>
     </div>
     <div style="display:flex; align-items:center; justify-content:center; flex-direction:column;">
          <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "craftsmendb";
          $uid = $_SESSION['uid'];
          $conn = new mysqli($servername, $username, $password, $dbname);
          if ($conn->connect_error) {
               die("Connection failed: " . $conn->connect_error);
          }
          $query = isset($_GET['query']) ? $_GET['query'] : '';

          $sql = "SELECT * FROM users WHERE uid='$uid'";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
               while ($row = $result->fetch_assoc()) {
                    echo "<div class='user-info-div'>
               <img src='https://cdn-icons-png.flaticon.com/512/456/456212.png'/>
               <h1> 
               " . $row['username'] . "
               </h1>
               <h2>
               " . $row['email'] . "
               </h2>
               <h2>
               " . $row['address'] . "
               </h2>
               <h2>
               " . $row['phoneNumber'] . "
               </h2>
               </div>";
               }
          } else {
               echo "";
          }
          ?>
          <div>
               <a class="add-to-cart-btn" href="edit-profile.php">Update Profile</a>
               <a class="add-to-cart-btn" href="delete-profile.php">Delete Account</a>
          </div>

          <h1 style="margin-top:2rem;">Past Orders</h1>
          <div style="text-align: center; display:flex;  align-items:center; justify-content: center; flex-direction:row;">
               <?php
               $sql = "SELECT * FROM orders WHERE uid='$uid'";
               $result = $conn->query($sql);
               if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                         $image_path = "./admin/products/uploads/" . $row['image'];
                         echo "
                    <div class='product-card'>
                         <img src='" . $image_path . "'/>
                         <h1 class='product-name'>" . $row['p_name'] . "</h1>
                         <div class='btn-grp'>
                              <form method='POST' action='product-details.php'>
                                   <input type='hidden' name='pid' value='" . $row["p_id"] . "'>
                                   <button type='submit' class='view-dtls-btn'>View Details</button>
                              </form>
                         </div>
                    </div>";
                    }
               } else {
                    echo "<p>No Results!</p>";
               }
               ?>
          </div>
     </div>
</body>

</html>