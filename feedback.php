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

try {
     $conn = new mysqli($servername, $username, $password, $dbname);
     if ($conn->connect_error) {
          throw new Exception("Connection failed: " . $conn->connect_error);
     }
     if (isset($_POST['submit'])) {
          $uid = $_SESSION['uid'];
          $username = $_SESSION['username'];
          $content = $_POST['content'];
          $date = date("Y-m-d H:i:s");
          $email = $_SESSION['email'];
          $pid=$_GET['product_id'];

          // Insert the feedback into the database
          $sql = "INSERT INTO feedback (feedback_id,username, content, date, email) VALUES ('$pid','$username', '$content', '$date', '$email')";
          if ($conn->query($sql) === TRUE) {
               echo "<script>alert('Feedback Submitted.')</script>";
               echo "<script>window.location.href='index.php'</script>";
          } else {
               throw new Exception("Error: " . $sql . "<br>" . $conn->error);
          }
     }
} catch (Exception $e) {
     echo "Error: " . $e->getMessage();
}

$conn->close();
include './components/nav.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Submit Feedback</title>
     <link rel="stylesheet" href="style/style.css">
     <style>
          .forms {

               max-width: 600px;
               margin: 2rem auto;
               font-family: Arial, sans-serif;
          }

          label {
               display: block;
               margin-bottom: 10px;
          }

          input[type=text],
          input[type=email],
          textarea {
               display: block;
               width: 100%;
               padding: 10px;
               margin-bottom: 20px;
               border: 1px solid #ccc;
               border-radius: 4px;
               box-sizing: border-box;
               font-size: 16px;
          }

          input[type=submit] {
               background-color: #4CAF50;
               color: #fff;
               padding: 10px 20px;
               border: none;
               border-radius: 4px;
               cursor: pointer;
               font-size: 16px;
          }

          input[type=submit]:hover {
               background-color: #3e8e41;
          }
     </style>
</head>

<body>
     <form method="post" class="forms">
          <label for="content">Feedback:</label>
          <textarea name="content" required></textarea>
          <input type="submit" name="submit" value="Submit Feedback">
     </form>

</body>

</html>