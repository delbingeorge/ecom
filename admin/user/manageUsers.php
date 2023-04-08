<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
     header('Location: login.php');
     exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <title>User Info</title>
     <link rel="stylesheet" href="../style/admin-style.css">
</head>

<body>
     <?php
     include '../components/nav.php'
     ?>
     <div class="dash-div">
          <div class="admin-head">
               <img class="admin-logo" src="https://cdn-icons-png.flaticon.com/512/7542/7542177.png" alt="">
               <h1>
                    User Information
               </h1>
          </div>
          <div class="dash-div-btn">
               <div class="show-items">
                    <h2>All Users</h2>
                    <?php
                    //Database Connection
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "craftsmendb";
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    $sql = "SELECT * FROM users";
                    $result = $conn->query($sql);
                    echo "<table class='order-news'>";
                    echo "<tr>
               <th>User ID</th>
               <th>Username</th>
               <th>Email</th>
               <th>Address</th>
               <th>Contact Number</th>
               <th>Remove</th>
               </tr>";
                    if ($result->num_rows > 0) {
                         while ($row = $result->fetch_assoc()) {
                              echo "<tr class='order-res'>
                         <td>" . $row["uid"] . "</td>
                         <td>" . $row["username"] . "</td>
                         <td>" . $row["email"] . "</td>
                         <td>" . $row["address"] . "</td>
                         <td>" . $row["phoneNumber"] . "</td>
                         <td>
                         <form method='POST'>
                              <input type='hidden' name='user_id' value='" . $row["uid"] . "'>
                              <button type='submit' class='del-btn'><img src='https://cdn-icons-png.flaticon.com/512/6861/6861362.png'/></button>
                         </form>
                     </td>
                         </tr>";
                         }
                    } else {
                         echo "<tr><td colspan='6'>No results found.</td></tr>";
                    }
                    echo "</table>";

                    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
                    $sqlall = "SELECT uid FROM users";
                    $result = $conn->query($sqlall);
                    if ($result->num_rows > 0) {
                         while ($row = $result->fetch_assoc()) {
                              if ($row['uid'] == $user_id) {
                                   $sql = "DELETE FROM users WHERE uid='$user_id'";
                                   if (mysqli_query($conn, $sql)) {
                                        echo "User Removed!";
                                        header('Location: manageUsers.php');
                                        exit();
                                   } else {
                                        echo "Failed to remove user!";
                                   }
                              } else {
                                   echo "<script>alert(No matching user id found!)</script>";
                              }
                         }
                    } else {
                         echo "<script>alert(No user found!)</script>";
                    }

                    mysqli_close($conn);
                    ?>
               </div>
          </div>
</body>

</html>