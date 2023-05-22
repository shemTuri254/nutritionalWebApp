<!-- <?php
// include('authentication.php');
// include('includes/header.php');

// $apiKey = 'aa5739ea0f0f4c619f5016652923d2a1';
// $id = $_SESSION['auth_user']['id'];

// if(isset($_POST['get_meals'])) {

//     // Get user's weight and BMI from the database
//     $query = "SELECT profile_id, weight, bmi, health_conditions FROM user_profiles WHERE id='$id'";
//     $query_run = mysqli_query($con, $query);
//     if(mysqli_num_rows($query_run) > 0) {
//         $user = mysqli_fetch_assoc($query_run);
//         $profile_id = $user['profile_id'];
//         $weight = $user['weight'];
//         $bmi = $user['bmi'];
//         $health_conditions = $user['health_conditions'];

//         // Set the target calorie range based on the user's BMI
//         if($bmi < 18.5) {
//             // Underweight - aim for a higher calorie range
//             $targetCalories = round(25 * $weight);
//         } else if($bmi < 25) {
//             // Normal weight - aim for a moderate calorie range
//             $targetCalories = round(22.5 * $weight);
//         } else if($bmi < 30) {
//             // Overweight - aim for a lower calorie range
//             $targetCalories = round(20 * $weight);
//         } else {
//             // Obese - aim for a very low calorie range
//             $targetCalories = round(17.5 * $weight);
//         }

//         // Add health condition filter if the user has any
//         if($health_conditions) {
//             $params['health'] = $health_conditions;
//         }

//         // Make a request to the Spoonacular API to get meal plan recommendations
//         $url = "https://api.spoonacular.com/mealplanner/generate?apiKey=$apiKey&targetCalories=$targetCalories&health=$health_conditions&timeFrame=day";
//         $response = file_get_contents($url);
//         $data = json_decode($response, true);


//         // Insert meals into the database
//         foreach ($data['meals'] as $meal) {
//             $title = mysqli_real_escape_string($con, $meal['title']);
//             $image = mysqli_real_escape_string($con, $meal['imageType']);
//             $sourceUrl = mysqli_real_escape_string($con, $meal['sourceUrl']);
//             $readyInMinutes = (int) $meal['readyInMinutes'];
//             $servings = (int) $meal['servings'];
//             $created_at = date("Y-m-d H:i:s");

//             $query = "INSERT INTO meals (profile_id, title, image, source_url, ready_in_minutes, servings, created_at) 
//             VALUES ('$profile_id', '$title', '$image', '$sourceUrl', $readyInMinutes, $servings, '$created_at')";
//             mysqli_query($con, $query);
//         }
//     }
// }else{
//     echo "No meals found";
// }





?>
<!-- HTML code for displaying meals -->
<!-- <div class="container">
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
        <form action="meals.php" method="post">
            <button type="submit" name="get_meals" class="btn btn-success">Get ANother Meal</button>
        </form>
    </div>
</div> -->





<?php 
// include 'includes/footer.php';
// include 'includes/scripts.php';
?> 



<?php


include('authentication.php');
include('includes/header.php');

$apiKey = 'aa5739ea0f0f4c619f5016652923d2a1';

$id = $_SESSION['auth_user']['user_id'];


$query = "SELECT user_location FROM users WHERE user_id='$id'";
$query_run = mysqli_query($con, $query);
if(mysqli_num_rows($query_run) > 0) {
    $user = mysqli_fetch_assoc($query_run);
    $location = $user['user_location'];
}


// Get user's weight and BMI from the database
$query = "SELECT profile_id, profile_weight, profile_height, profile_health_conditions FROM user_profiles WHERE user_id='$id'";
$query_run = mysqli_query($con, $query);
if(mysqli_num_rows($query_run) > 0) {
    $user = mysqli_fetch_assoc($query_run);
    $profile_id = $user['profile_id'];
    $weight = $user['profile_weight'];
    $height = $user['profile_height'];
    $health_conditions = $user['profile_health_conditions'];
}

// Calculate the user's BMI
$height = $height / 100;
$bmi = $weight / ($height * $height);
// echo $bmi;

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

// Set up API request parameters
$params = [
    'apiKey' => $apiKey,
    'targetCalories' => $targetCalories,
    'location' => $location,
];

// Add health condition filter if the user has any
if($health_conditions) {
    $params['health'] = $health_conditions;
}

// Build API request URL
$url = "https://api.spoonacular.com/mealplanner/generate?apiKey=$apiKey&location=$location&targetCalories=$targetCalories&health=$health_conditions&timeFrame=day";

$queryString = http_build_query($params);
$url .= '?' . $queryString;

// Make API request
$response = file_get_contents($url);

// Decode JSON response
$data = json_decode($response, true);

// Insert meals into the database
foreach ($data['meals'] as $meal) {
    $title = mysqli_real_escape_string($con, $meal['title']);
    $image = mysqli_real_escape_string($con, $meal['imageType']);
    $sourceUrl = mysqli_real_escape_string($con, $meal['sourceUrl']);
    $readyInMinutes = (int) $meal['readyInMinutes'];
    $servings = (int) $meal['servings'];
    $meal_create_datetime = date("Y-m-d H:i:s");
    
    $query = "INSERT INTO meals (profile_id, meal_title, meal_image_type, meal_source_url, meal_ready_in_minutes, meal_servings, meal_created_at) VALUES ('$profile_id', '$title', '$image', '$sourceUrl', '$readyInMinutes', '$servings', '$meal_create_datetime')";
    mysqli_query($con, $query);
    
}
?>


<div class="container-fluid px-4">
    <h4 class="mt-4">Meal Plan</h4>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item active">Meal Plan</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header m-4">
                    <?php 
                    $meals = $data['meals'];
                    $mealTitles = array('Breakfast', 'Lunch', 'Supper');
                    for ($i = 0; $i < count($meals); $i++) { 
                        $meal = $meals[$i];
                        ?>
                        <div class="meal">
                            <h4><?php echo $mealTitles[$i]; ?></h4>
                            <h4><?php echo $meal['title']; ?></h4>
                            <img src="https://images.spoonacular.com/file/wximages/<?php echo $meal['id']; ?>-312x231.jpg" alt="<?php echo $meal['title']; ?>">
                            <div  class=" border-1 rounded-2">
                            <a href="<?php echo $meal['sourceUrl']; ?>" target="_blank">View recipe</a>
                            </div>
                            <p>Ready in <?php echo $meal['readyInMinutes']; ?> minutes | <?php echo $meal['servings']; ?> servings</p><br>
                        </div>
                    <?php } ?>
                </div>
                <div class="card-body">
                    <div class="row m4">
                        <div class="col-md-12">
                            <h3>Nutrients</h3>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="nutrient">
                                <h4>Calories</h4>
                                <p><?php echo $data['nutrients']['calories']; ?></p>
                            </div>
                            <div class="nutrient">
                                <h4>Carbohydrates</h4>
                                <p><?php echo $data['nutrients']['carbohydrates']; ?></p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="nutrient">
                                <h4>Fat</h4>
                                <p><?php echo $data['nutrients']['fat']; ?></p>
                            </div>
                            <div class="nutrient">
                                <h4>Protein</h4>
                                <p><?php echo $data['nutrients']['protein']; ?></p>
                            </div>
                        </div>
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

