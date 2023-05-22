<?php
session_start();
include('./user/config/dbcon.php');

if(isset($_POST['login_btn'])){
    $user_email = mysqli_real_escape_string($con, $_POST['user_email']);
    $user_password = mysqli_real_escape_string($con, $_POST['user_password']);

    $query = "SELECT * FROM users WHERE user_email='$user_email' AND user_password='$user_password' LIMIT 1";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) > 0)
    {
        foreach($query_run as $row)
        {
            $user_id = $row['user_id'];
            $user_name = $row['username'];
            $user_email = $row['User_email'];
            $role_as = $row['role_as'];
        }
        //valid
        $_SESSION['auth'] = true;
        $_SESSION['auth_role'] = $role_as; // 1=>admin, 0=>user
        $_SESSION['auth_user'] = [
            'user_id' => $user_id,
            'username' => $user_name,
            'user_email' => $user_email,
        ];

        if($_SESSION['auth_role'] == 1)//admin
        {
            $_SESSION['message'] = "Welcome User";
            header('Location: ./user/dashboard.php');
            exit(0);
        }
        elseif($_SESSION['auth_role'] == 0) //user
        {
            $_SESSION['message'] = "Welcome User";
            header('Location: index.php');
            exit(0);
        }
        
    }
    else
    {
        //invalid
        $_SESSION['auth'] = false;
        $_SESSION['message'] = "Invalid Credentials";
        header('Location: login.php');
    }
    

    // $p_query = "SELECT password FROM users where password='$password'";
    // $p_query_run = mysqli_query($con, $p_query);
    // if(password_verify($plain_password, $password)){
    //     $_SESSION['message'] = 'password exsits';
    //     header('Location: login.php');
    // }
    // else{
    //     $_SESSION['message'] = 'ERROR';
    //     header('Location: login.php');
    // }

    // $query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
    // $query_run = mysqli_query($con, $query);

    // if(password_verify($plain_password, $password)){
    //     $_SESSION['message'] = 'invalid';
    // }

            // if(mysqli_num_rows($query_run) > 0)
            // {
            //     foreach($query_run as $row)
            //     {
            //         $user_id = $row['user_id'];
            //         $user_name = $row['username'];
            //         $user_email = $row['email'];
            //         $role_as = $row['role_as'];
            //     }
            //     //valid
            //     $_SESSION['auth'] = true;
            //     $_SESSION['auth_role'] = $role_as; // 1=>admin, 0=>user
            //     $_SESSION['auth_user'] = 
            //     [
            //         'user_id' => $user_id,
            //         'username' => $user_name,
            //         'email' => $user_email,
            //     ];

            //     if($_SESSION['auth_role'] == 1)//admin
            //     {
            //         $_SESSION['message'] = "Welcome Admin";
            //         header('Location: ./admin/dashboard.php');
            //         exit(0);
            //     }
            //     elseif($_SESSION['auth_role'] == 0) //user
            //     {
            //         $_SESSION['message'] = "Welcome User";
            //         header('Location: index.php');
            //         exit(0);
            //     }

            // }
            // else
            // {
            //     //invalid
            //     $_SESSION['message'] = "Email/Password is Invalid";
            //     header('Location: login.php');
            // }
            //     //invalid
            //     $_SESSION['message'] = "Password is Invalid";
            //     header('Location: login.php');

        
}

?>