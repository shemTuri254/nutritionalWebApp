<?php


include('authentication.php');
include('includes/header.php');
// get user id
$id = $_SESSION['auth_user']['user_id'];


if (isset($_POST['create_button'])) {
    $diary_headline = mysqli_real_escape_string($con, $_POST['diary_headline']);
    $diary_msg = mysqli_real_escape_string($con, $_POST['diary_msg']);
    $diary_create_datetime = date("Y-m-d H:i:s");

    $query = "INSERT INTO `diary` (user_id, diary_headline, diary_msg, diary_create_datetime) VALUES ('$id', '$diary_headline', '$diary_msg', '$diary_create_datetime')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        // echo "Saved";
        $_SESSION['message'] = "Entry Added!";
        echo "<script>window.location.href='view-entries.php'</script>";
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Something Went Wrong";
        // header('Location: new-diary.php');
    }
}


?>
<div class="container-fluid px-4">
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
</div>


<?php 
include 'includes/footer.php';
include 'includes/scripts.php';
?>