<?php
session_start();
if (!isset($_SESSION['uid'])) {
     header("Location: login.php");
     exit();
} else {
?>

     <!DOCTYPE html>
     <html lang="en">

     <head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Product Details</title>
          <link rel="stylesheet" href="style/style.css">
     </head>

     <body>
          <?php
          include './components/nav.php';
          $uid = $_SESSION['uid'];
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "craftsmendb";
          $conn = new mysqli($servername, $username, $password, $dbname);
          if ($conn->connect_error) {
               die("Connection failed: " . $conn->connect_error);
          }

          $pid = isset($_POST['pid']) ? $_POST['pid'] : '';
          $sql = "SELECT * FROM products WHERE p_id = $pid";
          $result = $conn->query($sql);
          if ($result->num_rows == 1) {
               $row = $result->fetch_assoc();
               $image_path = "./admin/products/uploads/" . $row['image'];
               echo "
          <div class='product-details'>
                <div class='product-img'>
                    <img src='" . $image_path . "' />
                </div>
               <div class='product-info'>
                    <h1>" . $row['product_name'] . "</h1>
                    <h2>" . $row['description'] . "</h2>
                   <h3>" . ($row['qty'] <= 0 ? "<span style='color:red;'>Stock Out</span>" : "<span style='color:green;'>" . $row['qty'] . " Stock Left!</span>") . "</h3>
                    <h1 class='price'>₹" . $row['price'] . "</h1>
                    <form method='POST' action='cart.php'>
                         <input type='hidden' name='pid' value='" . $row["p_id"] . "'>
                         <input type='number' class='qty-field' name='qty' value='1'>
                         <button type='submit' class='add-to-cart-btn'>Add To Cart</button>
                         <a href='feedback.php?product_id= " . $row["p_id"] .  " class='feedback' style='
                         padding: 10px 25px;
                    outline: none;
                    border: none;
                    background-color: #fda11c;
                    border-radius: 5px;
                    text-decoration: none;
                    color: white;'>Submit Feedback</a>
                    </form>
                    </div>
          </div>
          ";

               echo "
          <h1 style='text-align: center;'>User Review</h1>
          <div class='review-div'>
          ";
               $sql = "SELECT * FROM feedback WHERE feedback_id = '$row[p_id]'";
               $result = $conn->query($sql);
               if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                         echo "
                         <div class=comment>
                         <img src='https://cdn-icons-png.flaticon.com/512/456/456212.png'/>
                         <div>
                              <h1> " . $_SESSION["username"] . "</h1>
                              <div class='content'>"
                              . $row['content'] .
                              "</div>
                         </div>
                    </div>
                         ";
                    }
               } else {
                    echo "no reviews!";
               }
          } else {
               echo "Product not found!";
          }
          echo "</div>";
          $conn->close();
          include './components/footer.php';
          ?>
     </body>

     </html>
<?php
}
?>