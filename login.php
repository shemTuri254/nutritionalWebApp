<?php
session_start();

if(isset($_SESSION['auth']))
{
    if(!isset($_SESSION['message'])){
        $_SESSION['message'] = "You are already logged in";
    }
    header('Location: index.php');
    exit(0);
}


include('includes/header.php');
include('includes/navbar.php');
?>
<div class="py-s m-4">
 
    <div class="container-fluid h-custom bg">

    <div class="row d-flex justify-content-center align-items-center flex-sm-column-reverse h-100">
    <div class="row d-flex justify-content-center align-items-center flex-sm-row-reverse h-100">
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
      
        <div class="card rounded-4 shadow">
                <div class="card-header text-center">
                    <h4 class="text-center">Login</h4>
                </div>
                <div class="card-body">
                <?php include('message.php'); ?>

                
                    <form action="logincode.php" method="POST">
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input required="" type="email" name="user_email" id="email" class="form-control" placeholder="Enter Email">
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input required="" type="password" name="user_password" id="password" class="form-control" placeholder="Enter Password">
                    </div>
                    <div class="form-group mb-3">
                        <button type="submit" name="login_btn" class="btn btn-primary btn-lg w-100 rounded-2">Login</button>
                        <p class="link-danger"><a href="register.php">New Registration</a></p>
                    </div>
                    </form>

                </div>
              </div>
      </div><div class="col-md-9 col-lg-6 col-xl-5">
        <img src="./assets/images/login.png" class="img-fluid" alt="Sample image">
      </div>
          
    
    </div>
  </div>


</div>


<?php
include('includes/footer.php');
?>