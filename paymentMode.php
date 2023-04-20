<?php
session_start();
if (!isset($_SESSION['uid'])) {
     header("Location: login.php");
     exit();
}

if (isset($_POST['submit'])) {
     $payment_mode = isset($_POST['payment-mode']) ? $_POST['payment-mode'] : 'erre';
     $uid = $_SESSION['uid'];
     $cart_items = [];
     $host = 'localhost';
     $username = 'root';
     $password = '';
     $dbname = 'craftsmendb';

     $conn = new mysqli($host, $username, $password, $dbname);
     if ($conn->connect_error) {
          throw new Exception("Connection failed: " . $conn->connect_error);
     }

     $query1 = "SELECT * FROM users WHERE uid = '$uid'";
     $result1 = mysqli_query($conn, $query1);

     if (mysqli_num_rows($result1) > 0) {
          while ($row = mysqli_fetch_assoc($result1)) {
               if ($row['uid'] == $uid) {
                    $contact = $row['phoneNumber'];
                    $address = $row['address'];
                    $email = $row['email'];
               }
          }
     }

     $query = "SELECT * FROM cart WHERE uid = '$uid'";
     $result = mysqli_query($conn, $query);

     if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
               $cart_items[] = $row;
          }
     }

     foreach ($cart_items as $item) {
          $product_name = $item['product_name'];
          $p_id = $item['p_id'];
          $quantity = $item['quantity'];
          $price = $item['price'];
          $image = $item['image'];
          $total = $item['total'];
          $created_at = date('Y-m-d H:i:s');

          $query = "INSERT INTO orders (uid, p_name, phoneNumber, email, address, payment_mode, qty,  image, total, created_at,price,p_id)
               VALUES ('$uid', '$product_name', '$contact', '$email', '$address', '$payment_mode', '$quantity', '$image', '$total', NOW(),'$price','$p_id')";
          mysqli_query($conn, $query);
     }
     if ($payment_mode == "upiPayment") {
          header("Location: upiPayment.php");
     } elseif ($payment_mode == "creditCard") {
          header("Location: creditCard.php");
     } elseif ($payment_mode == "cod") {
          header("Location: cod.php");
     }
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
     <style>
          #payment-form {
               display: flex;
               flex-direction: column;
               align-items: center;
               justify-content: center;
               padding: 20px;
               border: 1px solid #ccc;
               border-radius: 5px;
               min-height: 100vh;
          }

          h1 {
               font-size: 1.5rem;
               margin-bottom: 20px;
               text-align: center;
          }

          div {
               display: flex;
               align-items: center;
               margin-bottom: 10px;
          }

          input[type="radio"] {
               margin-right: 10px;
          }

          label {
               font-size: 1rem;
          }

          button[type="submit"] {
               background-color: #007bff;
               color: #fff;
               border: none;
               border-radius: 5px;
               padding: 10px 20px;
               margin-top: 20px;
               cursor: pointer;
               transition: background-color 0.3s ease;
          }

          button[type="submit"]:hover {
               background-color: #0069d9;
          }

          @media screen and (max-width: 480px) {
               #payment-form {
                    max-width: 100%;
                    padding: 10px;
               }

               h1 {
                    font-size: 1.2rem;
               }

               div {
                    flex-direction: column;
                    align-items: flex-start;
               }

               label {
                    font-size: 0.8rem;
               }

               button[type="submit"] {
                    padding: 8px 16px;
               }
          }
     </style>
</head>

<body>
     <form action="paymentMode.php" id="payment-form" method="POST">
          <h1>Select your payment Mode</h1>
          <div>
               <input type="radio" name="payment-mode" value="upiPayment" checked>UPI Payment
          </div>
          <div>
               <input type="radio" name="payment-mode" value="creditCard">Bank Transfer
          </div>
          <div>
               <input type="radio" name="payment-mode" value="cod">COD
          </div>
          <button type="submit" value="Submit" name="submit">Submit</button>
     </form>

</body>

</html>