<?php
include('authentication.php');
include('includes/header.php');

$apiKey = 'aa5739ea0f0f4c619f5016652923d2a1';
$id = $_SESSION['auth_user']['user_id'];

if(isset($_POST['get_meals'])) {

        // Get user's weight and BMI from the database
        $query = "SELECT profile_id, weight, bmi, health_conditions FROM user_profiles WHERE id='$id'";
        $query_run = mysqli_query($con, $query);
        if(mysqli_num_rows($query_run) > 0) {
            $user = mysqli_fetch_assoc($query_run);
            $profile_id = $user['profile_id'];
            $weight = $useprofile_r['profile_weight'];
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

              // Clear the old meal data from the database
                $query = "DELETE FROM meals WHERE profile_id='$profile_id'";
                mysqli_query($con, $query);
    
            // Insert meals into the database
            foreach ($data['meals'] as $meal) {
                $title = mysqli_real_escape_string($con, $meal['meal_title']);
                $image = mysqli_real_escape_string($con, $meal['meal_imageType']);
                $sourceUrl = mysqli_real_escape_string($con, $meal['meal_sourceUrl']);
                $readyInMinutes = (int) $meal['meal_ready_in_minutes'];
                $servings = (int) $meal['meal_servings'];
                $created_at = date("Y-m-d H:i:s");
    
                $query = "INSERT INTO meals (profile_id, meal_title, meal_image_type, meal_source_url, meal_ready_in_minutes, meal_servings, meal_created_at) 
                VALUES ('$profile_id', '$title', '$image', '$sourceUrl', $readyInMinutes, $servings, '$created_at')";
                mysqli_query($con, $query);
            }
        
            // Get the newly inserted meals data
            $query = "SELECT * FROM meals WHERE profile_id='$profile_id'";
            $query_run = mysqli_query($con, $query);
            if(mysqli_num_rows($query_run) > 0) {
                $meals = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
            }
        }




   
}   

?>

<!-- HTML code for displaying meals -->
<div class="container">
    <div class="row">
        <?php if(isset($meals)): ?>
            <?php foreach ($meals as $meal): ?>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="<?php echo $meal['image']; ?>" class="card-img-top" alt="Meal Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $meal['title']; ?></h5>
                            <p class="card-text">Ready in <?php echo $meal['ready_in_minutes']; ?> minutes</p>
                            <p class="card-text">Servings: <?php echo $meal['servings']; ?></p>
                            <a href="<?php echo $meal['source_url']; ?>" class="btn btn-primary" target="_blank">View Recipe</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-warning">
                <?php echo $_SESSION['message']; ?>
            </div>
        <?php endif; ?>
        <form action="mealplans.php" method="post">
            <button type="submit" name="get_meals" class="btn btn-success">Get ANother Meal</button>
        </form>
    </div>
</div>





<?php 
include 'includes/footer.php';
include 'includes/scripts.php';
?>
