<?php
include('authentication.php');
include('includes/header.php');

if (isset($_POST['create_btn'])) {
    $profile_age = mysqli_real_escape_string($con, $_POST['profile_age']);
    $profile_height = mysqli_real_escape_string($con, $_POST['profile_height']);
    $profile_weight = mysqli_real_escape_string($con, $_POST['profile_weight']);
    $profile_gender = mysqli_real_escape_string($con, $_POST['profile_gender']);
    $profile_health_conditions = mysqli_real_escape_string($con, $_POST['profile_health_conditions']);
    $bheight = $profile_height / 100;
    $profile_bmi = $profile_weight / ($bheight * $bheight);

    if (isset($_SESSION['auth_user'])) {
        $user_id = $_SESSION['auth_user']['user_id'];
    }


    $query = "INSERT INTO `user_profiles` (user_id, profile_age, profile_height, profile_weight, profile_gender, profile_health_conditions, profile_bmi ) VALUES ('$user_id','$profile_age', '$profile_height', '$profile_weight', '$profile_gender', '$profile_health_conditions', '$profile_bmi')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        // echo "Saved";
        $_SESSION['message'] = "Profile Updated!";
        echo "<script>window.location.href='view-profile.php'</script>";
        echo $profile_bmi;
        // exit(0);
    }
    else
    {
        $_SESSION['message'] = "Something Went Wrong";
        // header('Location: new-diary.php');
    }
}
?>


<div class="container-fluid px-4">
      <h4 class="mt-4">Users</h4>
      <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item active">Dashboard</li>
          <li class="breadcrumb-item active">Users</li>
      </ol>
      <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Registered User</h4>
                    <div class="card-body">

                    <!-- profile.html -->
                    <?php include('../message.php')?>
                    <form action="edit-profile.php" method="POST">
                      <div class="row">
                      <div class="col-md-6 mb-3">
                      <label for="age">Age:</label>
                      <input type="number" class="form-control" name="profile_age" required><br>
                      </div>

                      <div class="col-md-6 mb-3">
                      <label for="height">Height (cm):</label>
                      <input type="number" class="form-control" name="profile_height" id="height" required><br>
                      </div>

                      <div class="col-md-6 mb-3">
                      <label for="weight">Weight (kg):</label>
                      <input type="number" class="form-control" name="profile_weight" id="weight" required><br>
                      </div>

                      <div class="col-md-6 mb-3">
                      <label for="gender">Gender:</label>
                      <select name="profile_gender" class="form-control" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                      </select><br>
                      </div>

                      <div class="col-md-6 mb-3">
                      <label for="profile_health_conditions">Select Your Health Conditions:</label><br>
                      <select name="profile_health_conditions" class="form-control" required>
                      <option value="none">--Select One--</option>
                        <option value="none">None</option>
                        <option value="diabetes">Diabetes</option>
                        <option value="hypertension">Hypertension</option>
                        <option value="heart-disease">Heart Disease</option>
                      </select><br>
                      </div>

                      <div class="col-md-12 mb-3">
                      <button type="submit" class="btn btn-primary" name="create_btn">Save Profile</button>
                      </div>
                      </div>
                    </form>
                    </div>
                </div>
            </div>
          </div>
      </div>

</div>











<?php 
include 'includes/footer.php';
include 'includes/scripts.php';
?>