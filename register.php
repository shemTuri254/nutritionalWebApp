<?php
session_start();

if(isset($_SESSION['auth']))
{
    $_SESSION['message'] = "You are already logged in";
    header('Location: index.php');
    exit(0);
}

include('includes/header.php');
include('includes/navbar.php');
?>

<div class="py-s mt-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">

            <?php include('message.php'); ?>

            <div class="card">
                <div class="card-header text-center">
                    <h4>register</h4>
                </div>
                <div class="card-body">

                        <form action="registercode.php" method="POST">
                            <div class="form-group mb-3">
                                    <label>Username</label>
                                    <input required type="text" name="username" class="form-control" placeholder="Enter Username">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input required type="email" name="user_email" id="email" class="form-control" placeholder="Enter Email">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Age</label>
                                    <input required type="number" name="user_age" class="form-control" placeholder="Enter Age">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Location</label>
                                    <input required type="text" name="user_location" class="form-control" placeholder="Enter Location">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="user_password">Password</label>
                                    <input required type="password" name="user_password" id="user_password" class="form-control" placeholder="Enter password">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password">Confirm Password</label>
                                    <input required type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Confirm Password">
                                </div>
                                <div class="form-group mb-3">
                                    <button required type="submit" name="register_btn" class="btn btn-primary">Register</button>
                                </div>
                        </form>
                    </div>
              </div>
            </div>
        </div>
    </div>
</div>


<?php
include('includes/footer.php');
?>