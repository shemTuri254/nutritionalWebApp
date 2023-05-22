<?php
include('authentication.php');

//Handle form submission
if (isset($_POST['save_btn'])) {
    $profile_age =  $_POST['profile_age'];
    $profile_height = $_POST['profile_height'];
    $profile_weight = $_POST['profile_weight'];
    $profile_health_conditions = $_POST['profile_health_conditions'];
    $bheight = $profile_height / 100;
    $profile_bmi = $profile_weight / ($bheight * $bheight);

    $id = $_SESSION['auth_user']['user_id'];

    $query = "UPDATE user_profiles SET profile_age='$profile_age', profile_height='$profile_height', profile_weight='$profile_weight', profile_health_conditions='$profile_health_conditions', profile_bmi='$profile_bmi' WHERE user_id='$id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        echo "Saved";
        $_SESSION['message'] = "profile Updated!";
        echo "<script>window.location.href='view-profile.php'</script>";
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Something Went Wrong";
        // header('Location: new-diary.php');
    }

}else{
    echo "No data found";
}



?>


