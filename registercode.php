<?php
session_start();
include('./user/config/dbcon.php');

if(isset($_POST['register_btn']))
{
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $user_email = mysqli_real_escape_string($con, $_POST['user_email']);
    $user_age = mysqli_real_escape_string($con, $_POST['user_age']);
    $user_location = mysqli_real_escape_string($con, $_POST['user_location']);
    $user_password = mysqli_real_escape_string($con, $_POST['user_password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    $create_datetime = date("Y-m-d H:i:s");
    

    if($user_password == $cpassword)
    {
        $password = trim($_POST["user_password"]);
        //encrypting the passwords
        // $password = password_hash($plain_cpassword, PASSWORD_BCRYPT);
        //check if user_email already exists
        $checkemail = "SELECT user_email FROM users WHERE user_email='$user_email'";
        $checkuemail_run = mysqli_query($con, $checkemail);
        
        if(mysqli_num_rows($checkemail_run) > 0)
        {
            //Already user_email exists

            $_SESSION['message'] = "email Already Exists";
            header('location: register.php');
            exit(0);
        }else{  

            $query = "INSERT INTO `users` (username, user_email, user_password, user_age, user_location, create_datetime) VALUES ('$username', '$user_email', '$password', '$user_age', '$user_location', '$create_datetime')";
            $query_run = mysqli_query($con, $query);

            if($query_run)
            {
                // echo "Saved";
                $_SESSION['message'] = "Profile Added";
                header('Location: login.php');
                exit(0);
            }
            else
            {
                $_SESSION['message'] = "Something Went Wrong";
                header('Location: register.php');
            }
        }   
    }
    else
    {
        $_SESSION['message'] = "Confirm Password Does Not Match";
        header('Location: register.php');
    }
}

?>