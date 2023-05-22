<?php
include('authentication.php');
include('includes/header.php');

$id = $_SESSION['auth_user']['user_id'];
$query = "SELECT * FROM user_profiles WHERE user_id='$id'";
$query_run = mysqli_query($con, $query);

if(mysqli_num_rows($query_run) > 0) {
    $profile = mysqli_fetch_assoc($query_run);
    $age = $profile['profile_age'];
    $height = $profile['profile_height'];
    $weight = $profile['profile_weight'];
    $health_conditions = $profile['profile_health_conditions'];
    $bmi = $profile['profile_bmi'];
} else {
    $age = "";
    $height = "";
    $weight = "";
    $health_conditions = "";
    $bmi = "";
}

?>


<div class="container-fluid px-4">
      <h4 class="mt-4">Users</h4>
      <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item active">Dashboard</li>
          <li class="breadcrumb-item active">Edit Profile</li>
      </ol>
      <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Profile</h4>
                    <div class="card-body">
                        <?php
                            

                            //     if(mysqli_num_rows($query_run) > 0)
                            // {
                            //     foreach($query_run as $profiles)
                            //     {

                                
                                ?>

                       


                                            <form action="code.php" method="POST">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="name">Age</label>
                                                        <input type="number" class="form-control" name="profile_age" value="<?php echo $age; ?>" >
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="name">Height(cm)</label>
                                                        <input type="number" class="form-control" name="profile_height"  value="<?php echo $height; ?>" >
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="number">Weight(kg)</label>
                                                        <input type="number" class="form-control" name="profile_weight"  value="<?php echo $weight; ?>" >
                                                    </div>
                                                    <!-- <div class="col-md-6 mb-3">
                                                    <label for="gender">Gender:</label>
                                                    <select name="gender" class="form-control" required>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select><br>
                                                    </div> -->
                                                    <div class="col-md-6 mb-3">
                                                    <label for="health_conditions">Select Your Health Conditions:</label><br>
                                                        <select name="profile_health_conditions" required class="form-control" value="<?php echo $bmi;?>">
                                                            <option value="none">--Select One--</option>
                                                            <option value="none">None</option>
                                                            <option value="diabetes">Diabetes</option>
                                                            <option value="hypertension">Hypertension</option>
                                                            <option value="heart-disease">Heart Disease</option>
                                                        </select><br>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="number">BMI</label>
                                                        <input type="number" class="form-control" name="profile_bmi" value="<?php echo $bmi;?>" readonly>
                                                    </div> 
                                                    <div class="col-md-12 mb-3">
                                                        <button type="submit" class="btn btn-primary" name="save_btn">Save Profile</button>
                                                    </div>
                                                </div>
                                            </form>

                                            <?php
                            //     }
                            // }
                            // else
                            // {
                                ?>
                               <!-- <h4>No Record Found</h4> -->
                                <?php

                        //     }
                        // }
                        ?>                 










 
                    


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
