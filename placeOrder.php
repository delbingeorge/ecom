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
$conn = new mysqli($servername, $username, $password, $dbname);
$uid = $_SESSION['uid'];
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Craftmen Hardware</title>
     <link rel="stylesheet" href="style/style.css">
     <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/2713/2713537.png" type="image/x-icon">
</head>

<body>
     <div class="bill">
          <div class="bill-div">
               <div>
                    <img style="width: 150px; height: 60px;" src="media/images/craftLogo.png" />
               </div>
               <div class='bill-info'>
                    <?php
                    $sql = "SELECT * FROM users WHERE uid ='$uid'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                         while ($row = $result->fetch_assoc()) {
                              echo "
                         <div>
                              <h1>Name:</h1><h1>" . $row['username'] . "</h1>
                         </div>
                         <div>
                              <h1>Email:</h1><h1>" . $row['email'] . "</h1>
                         </div>
                         <div>
                              <h1>Contact Info:</h1><h1>" . $row['phoneNumber'] . "</h1>
                         </div>
                         <div>
                              <h1>Address:</h1><h1>" . $row['address'] . "</h1>
                         </div>
                         ";
                         }
                    } else {
                         echo "No Results!";
                    }
                    ?>
               </div>

               <table border='1'>
                    <tr>
                         <th>
                              Product Name
                         </th>
                         <th>
                              Quantity
                         </th>
                         <th>Price/item</th>
                         <th>Total Price</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM cart WHERE uid ='$uid'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                         while ($row = $result->fetch_assoc()) {
                              echo "
                    <tr>
                         <td> " . $row['product_name'] . "</td>
                         <td> " . $row['quantity'] . "</td>
                         <td> " . $row['price'] . "</td>
                         <td> " . $row['total'] . "</td>
                    </tr>
              
               ";
                         }
                    } else {
                         echo "No Results!";
                    }
                    $conn->close();
                    ?>
               </table>
               <a href="checkout.php" class='add-to-cart-btn'>Check Out</a>
          </div>
     </div>
</body>

</html>