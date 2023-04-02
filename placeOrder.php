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
     <title>Craftmen Hardware</title>
     <link rel="stylesheet" href="style/style.css">
     <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/2713/2713537.png" type="image/x-icon">
</head>

<body>
     <div class="bill-div">
          <h1>
               Total Bill
          </h1>
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
               $servername = "localhost";
               $username = "root";
               $password = "";
               $dbname = "craftsmendb";
               $conn = new mysqli($servername, $username, $password, $dbname);
               $uid = $_SESSION['uid'];
               if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
               }
               $query = isset($_GET['query']) ? $_GET['query'] : '';

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
          <button class='add-to-cart-btn'>Check Out</button>
     </div>
</body>

</html>