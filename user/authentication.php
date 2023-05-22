<?php
session_start();
include('config/dbcon.php');

if(!isset($_SESSION['auth']))
{
    $_SESSION['message'] = "login to access Dashboard";
    header('Location: ../login.php');
    exit(0);
}else{
    if($_SESSION['auth_role'] == 0)
    {
        $_SESSION['message'] = "You are not authorized to access Dashboard";
        header('Location: ../login.php');
        exit(0);
    }

}

?>