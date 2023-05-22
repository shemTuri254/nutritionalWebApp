<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('server.php');
    // When form submitted, insert values into the database.
    // Define variable and initialize with empty values
    $name_err = $email_err = $age_err = $location_err = $password_err = "";
    
    // Process data when form is submitted
    if (isset($_REQUEST['username'])) {
          // Validate name
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter your name.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email address.";
    } else {
        $email = trim($_POST["email"]);
        // Check if email address is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Invalid email address format.";
        }
    }

    // Validate age
    if (empty(trim($_POST["age"]))) {
        $age_err = "Please enter your age.";
    } else {
        $age = trim($_POST["age"]);
        // Check if age is a valid number
        if (!is_numeric($age)) {
            $age_err = "Age must be a number.";
        }
    }

    // Validate location
    if (empty(trim($_POST["location"]))) {
        $location_err = "Please enter your location.";
    } else {
        $location = trim($_POST["location"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 0) {
        $password_err = "Password must have at least 8 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    $create_datetime = date("Y-m-d H:i:s");

        // check if the user a;ready exists in the database
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $con->query($sql);
        if (mysqli_num_rows($result) > 0){
            // User already exists, display an error message
            $email_err = "User with this email already exists!";
        }else{
            // Insert the data into the database if there are no errors
            if (empty($usernameErr) && empty($emailErr) && empty($passwordErr) && empty($ageErr) && empty($locationErr)) {
  
                                $sql    = "INSERT into `users` (username, email, age, location, password, create_datetime)
                                            VALUES ('$username', '$email', '$age', '$location', '" . md5($password) . "',  '$create_datetime')";
                                if ($con->query($sql) === TRUE) {
                                    echo "<div class='form'>
                                        <h3>You are registered successfully.</h3><br/>
                                        <p class='link'>Click here to <a href='login.php'>Login</a></p>
                                        </div>";
                                } 
        
                            }
                            else {
                                echo "<div class='form'>
                                    <h3>Required fields are correctly.</h3><br/>
                                    <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                                    </div>";
                            }
                }

    } else {
?>
   <form method="POST" action="registration.php">
		<label for="username">Name:</label>
		<input type="text" id="username" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">
		<span class="error"><?php echo isset($errors['username']) ? $errors['username'] : '' ?></span>
		<br><br>
		<label for="email">Email:</label>
		<input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" placeholder="example@gmail.com">
		<span class="error"><?php echo isset($errors['email']) ? $errors['email'] : '' ?></span>
		<br><br>
		<label for="password">Password:</label>
		<input type="password" id="password" name="password">
		<span class="error"><?php echo isset($errors['password']) ? $errors['password'] : '' ?></span>
		<br><br>
		<label for="confirm_password">Confirm Password:</label>
		<input type="password" id="confirm_password" name="confirm_password" placeholder="Enter password">
		<span class="error"><?php echo isset($errors['confirm_password']) ? $errors['confirm_password'] : '' ?></span>
		<br><br>
		<label for="age">Age:</label>
		<input type="number" id="age" name="age" value="<?php echo isset($_POST['age']) ? htmlspecialchars($_POST['age']) : '' ?>">
		<span class="error"><?php echo isset($errors['age']) ? $errors['age'] : '' ?></span>
		<br><br>
		<label for="location">Location:</label>
		<input type="text" id="location" name="location" value="<?php echo isset($_POST['location']) ? htmlspecialchars($_POST['location']) : '' ?>">
		<span class="error"><?php echo isset($errors['location']) ? $errors['location'] : '' ?></span>
		<br><br>

    <input type="submit" name="submit" value="Register" class="login-button">
    </form>
<?php
    }
?>
</body>
</html>