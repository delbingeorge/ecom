<?php
require('fpdf/fpdf.php');
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
try {
     if ($conn->connect_error) {
          throw new Exception("Connection failed: " . $conn->connect_error);
     }

     $sql = "SELECT * FROM users WHERE uid ='$uid'";
     $result = $conn->query($sql);

     if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
               $name = $row['username'];
               $email = $row['email'];
               $phone = $row['phoneNumber'];
               $address = $row['address'];
          }
     }

     $total_price = 0;
     $transaction_info = "";
     $p_name = "";
     $phone_number = "";
     $email_id = "";
     $address_info = "";
     $payment_mode = "Cash on Delivery";

     $sql = "SELECT * FROM cart WHERE uid ='$uid'";
     $result = $conn->query($sql);

     if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
               $total_price += $row['total'];
               $p_name .= $row['product_name'] . ",";
          }
     } else {
          throw new Exception("No Results!");
     }

     $transaction_info = "Total Price:" . $total_price;
     $p_name = rtrim($p_name, ",");
     $phone_number = $phone;
     $email_id = $email;
     $address_info = $address;

     $o_id = uniqid("Order");

     $sql = "INSERT INTO orders (o_id, uid, transaction_info, p_name, phoneNumber, email, address, payment_mode, created_at)
          VALUES ('$o_id', '$uid', '$transaction_info', '$p_name', '$phone_number', '$email_id', '$address_info', '$payment_mode', NOW())";

     if ($conn->query($sql) === false) {
          throw new Exception("Error: " . $sql . "<br>" . $conn->error);
     }
} catch (Exception $e) {
     echo "";
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
               <div>
                    <h1>Invoice</h1>
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
                    $sql = "SELECT * FROM orders WHERE uid ='$uid'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                         while ($row = $result->fetch_assoc()) {
                              echo "
                    <tr>
                         <td> " . $row['p_name'] . "</td>
                         <td> " . $row['qty'] . "</td>
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
               <div>
                    <a href="generate-pdf.php" class="add-to-cart-btn" target="_blank">Download PDF</a>
                    <!-- <a href="check out.php" class='add-to-cart-btn'>Check Out</a> -->
               </div>

          </div>
     </div>
</body>

</html>