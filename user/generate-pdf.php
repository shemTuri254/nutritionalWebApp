<?php
include('authentication.php');
require('fpdf/fpdf.php');

$id = $_SESSION['auth_user']['user_id'];


if (isset($_POST['create_button'])) {
    // Create PDF report
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(40,10,'Diary Entry Report',0,1);
    $pdf->SetFont('Arial','',12);
    // Fetch diary entries from database and add them to the PDF
    $query = "SELECT * FROM diary WHERE user_id='$id' ORDER BY diary_create_datetime DESC";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(40,10,'Headline: '.$row['diary_headline'],0,1);
        $pdf->Cell(40,10,'Message: '.$row['diary_msg'],0,1);
        $pdf->Cell(40,10,'Date: '.$row['diary_create_datetime'],0,1);
        $pdf->Ln();
    }
    $pdf->Output('diary_report.pdf', 'D');
    }
    else
    {
        $_SESSION['message'] = "Something Went Wrong";
        // header('Location: new-diary.php');
 }


 if (isset($_POST['get_meals'])) {

        // Get user's weight and BMI from the database
    $pquery = "SELECT profile_id FROM user_profiles WHERE user_id='$id'";
    $pquery_run = mysqli_query($con, $pquery);
    if(mysqli_num_rows($pquery_run) > 0) {
        $user = mysqli_fetch_assoc($pquery_run);
        $profile_id = $user['profile_id'];
    }

    // Create PDF report
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(40,10,'Meals Report',0,1);
    $pdf->SetFont('Arial','',12);
    // Fetch diary entries from database and add them to the PDF
    $query = "SELECT * FROM meals WHERE profile_id='$profile_id' ORDER BY meal_created_at DESC";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(40,10,'Title: '.$row['meal_title'],0,1);
        $pdf->Cell(40,10,'Ready in Minutes: '.$row['meal_ready_in_minutes'],0,1);
        $pdf->Cell(40,10,'Serving: '.$row['meal_servings'],0,1);
        $pdf->Cell(40,10,'Source URL: '.$row['meal_source_url'],0,1);
        $pdf->Cell(40,10,'Date: '.$row['meal_created_at'],0,1);
        $pdf->Ln();
    }
    $pdf->Output('meals_report.pdf', 'D');
    }
    else
    {
        $_SESSION['message'] = "Something Went Wrong";
        // header('Location: new-diary.php');
 }




?>
<!-- <div class="container-fluid px-4">
      <h4 class="mt-4">New Diary</h4>
      <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item active">Dashboard</li>
          <li class="breadcrumb-item active">New Diary</li>
      </ol>
<div class="content create">
	<h2>Create Entry</h2>
    <?php include('../message.php')?>
    <form action="new-diary.php" method="POST">
        <div class="mb-3 p-5 card">
        <label for="headline" class="form-label">Enter headline</label>
        <input type="text" class="form-control" name="diary_headline" placeholder="headline" id="headline" required style="height{50px}">
        <label for="msg" class="form-label">Write your entry</label>
        <textarea name="diary_msg" class="form-control" placeholder="Enter your msg here..." id="msg" required></textarea>
        <button type="submit" name="create_button" class="btn btn-primary my-4">Submit</button>
        </div>
        </form>

</div>
</div> -->
<?php 
// include 'includes/footer.php';
// include 'includes/scripts.php';
?>


