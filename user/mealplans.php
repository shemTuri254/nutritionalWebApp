<?php
include('authentication.php');
include('includes/header.php');

$apiKey = 'aa5739ea0f0f4c619f5016652923d2a1';
$id = $_SESSION['auth_user']['user_id'];

if(isset($_POST['get_meals'])) {

        // Get user's weight and BMI from the database
        $query = "SELECT profile_id, profile_weight, profile_bmi, profile_health_conditions FROM user_profiles WHERE id='$id'";
        $query_run = mysqli_query($con, $query);
        if(mysqli_num_rows($query_run) > 0) {
            $user = mysqli_fetch_assoc($query_run);
            $profile_id = $user['profile_id'];
            $weight = $user['profile_weight'];
            $bmi = $user['profile_bmi'];
            $health_conditions = $user['profile_health_conditions'];
    
            // Set the target calorie range based on the user's BMI
            if($bmi < 18.5) {
                // Underweight - aim for a higher calorie range
                $targetCalories = round(25 * $weight);
            } else if($bmi < 25) {
                // Normal weight - aim for a moderate calorie range
                $targetCalories = round(22.5 * $weight);
            } else if($bmi < 30) {
                // Overweight - aim for a lower calorie range
                $targetCalories = round(20 * $weight);
            } else {
                // Obese - aim for a very low calorie range
                $targetCalories = round(17.5 * $weight);
            }
    
            // Add health condition filter if the user has any
            if($health_conditions) {
                $params['health'] = $health_conditions;
            }
    
            // Make a request to the Spoonacular API to get meal plan recommendations
            $url = "https://api.spoonacular.com/mealplanner/generate?apiKey=$apiKey&targetCalories=$targetCalories&health=$health_conditions&timeFrame=day";
            $response = file_get_contents($url);
            $data = json_decode($response, true);

            //   // Clear the old meal data from the database
            //     $query = "DELETE FROM meals WHERE profile_id='$profile_id'";
            //     mysqli_query($con, $query);
    
            // Insert meals into the database
            foreach ($data['meals'] as $meal) {
                $title = mysqli_real_escape_string($con, $meal['title']);
                $image = mysqli_real_escape_string($con, $meal['imageType']);
                $sourceUrl = mysqli_real_escape_string($con, $meal['sourceUrl']);
                $readyInMinutes = (int) $meal['readyInMinutes'];
                $servings = (int) $meal['servings'];
                $created_at = date("Y-m-d H:i:s");
    
                $query = "INSERT INTO meals (profile_id, meal_title, meal_image_type, meal_source_url, meal_ready_in_minutes, meal_servings, meal_created_at) 
                VALUES ('$profile_id', '$title', '$image', '$sourceUrl', $readyInMinutes, $servings, '$created_at')";
                mysqli_query($con, $query);
            }
        
            // Get the newly inserted meals data
            $query = "SELECT * FROM meals WHERE profile_id='$profile_id' ORDER BY meal_create_datetime DESC";
            $query_run = mysqli_query($con, $query);
            if(mysqli_num_rows($query_run) > 0) {
                $meals = mysqli_fetch_all($con, $query_run);
            }
        }




   
} else {

    //get profile id
    $query = "SELECT profile_id FROM user_profiles WHERE user_id='$id'";
    $query_run = mysqli_query($con, $query);
    if(mysqli_num_rows($query_run) > 0) {
        $user = mysqli_fetch_assoc($query_run);
        $profile_id = $user['profile_id'];
    }
    // get meals data
    $query = "SELECT * FROM meals WHERE profile_id='$profile_id' ORDER BY meal_created_at DESC";
    $query_run = mysqli_query($con, $query);
    if(mysqli_num_rows($query_run) > 0) {
        $meals = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
    } else {
        $_SESSION['message'] = "Click Button to get meals";
    }


}
    


?>

<div class="container-fluid px-4">
      <h4 class="mt-4">My Plans</h4>
      <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item active">Dashboard</li>
          <li class="breadcrumb-item active">My Plans</li>
      </ol>

<!-- HTML code for displaying meals -->
<div class="container">
    <div class="row">
        <?php if(isset($meals)): ?>
            <?php foreach ($meals as $meal): ?>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="<?php echo $meal['image']; ?>" class="card-img-top" alt="Meal Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $meal['meal_title']; ?></h5>
                            <p class="card-text">Ready in <?php echo $meal['meal_ready_in_minutes']; ?> minutes</p>
                            <p class="card-text">Servings: <?php echo $meal['meal_servings']; ?></p>
                            <a href="<?php echo $meal['meal_source_url']; ?>" class="btn btn-primary" target="_blank">View Recipe</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-warning">
                <?php echo $_SESSION['message']; ?>
            </div>
        <?php endif; ?>
    </div>
    <form action="generate-pdf.php" method="post">
            <button type="submit" name="get_meals" class="btn btn-success">Generate Report</button>
    </form>
</div>
</div>





<?php 
include 'includes/footer.php';
include 'includes/scripts.php';
?>
