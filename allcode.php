<?php
session_start();
 if(isset($_POST['logout_btn']))
 {
     unset($_SESSION['auth']);
     unset($_SESSION['auth_role']);
     unset($_SESSION['auth_user']);

     $_SESSION['message'] = "You are logged out successfully";
     header('Location: login.php');
     exit(0);
 }

?>