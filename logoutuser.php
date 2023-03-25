     <?php
     session_start();
     if (isset($_POST['logout_btn'])) {
          session_destroy();
          header("Location: login.php");
          exit();
     }
