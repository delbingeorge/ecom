<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "craftsmendb";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}
$p_id = $_POST['del_pid'];
$qty = $_POST['item_qty'];

$sql = "DELETE FROM cart WHERE p_id='$p_id'";
$result = $conn->query($sql);
// $updateQty = "UPDATE products  SET qty = qty +'$qty' WHERE p_id = '$p_id'";
if ($result) {
     // $conn->query($updateQty);
     header('Location: showcart.php');
} else {
     echo "Removing item failed!";
}

$conn->close();
