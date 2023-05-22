<?php
include('authentication.php');
include('includes/header.php');

// get user id
// $id = $_SESSION['auth_user']['id'];
// if(isset($_GET['diary_id'])) {
$diary_id = $_GET['diary_id'];

$query = "SELECT * FROM diary WHERE diary_id='$diary_id'";
$query_run = mysqli_query($con, $query);

if(mysqli_num_rows($query_run) > 0) {
    $diary = mysqli_fetch_assoc($query_run);
    $diary_id = $diary['diary_id'];
    $headline = $diary['diary_headline'];
    $msg = $diary['diary_msg'];
} else {
    $headline = "";
    $msg = "";
}
// } else{
//     $headline = "";
//     $msg = "";
// }
?>


<div class="container-fluid px-4">
      <h4 class="mt-4">Users</h4>
      <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item active">Dashboard</li>
          <li class="breadcrumb-item active">View Entries</li>
      </ol>
      <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Profile</h4>
                    <div class="card-body">
                        <form action="entry-code.php?diary_id=<?=$diary_id?>" method="POST">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name">Headline</label>
                                    <input type="text" class="form-control" name="diary_headline" value="<?php echo $headline; ?>" >
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="name">Message</label>
                                    <input type="text" class="form-control h-100" name="diary_msg"  value="<?php echo $msg; ?>" >
                                </div>
                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-primary mt-4 w-100" name="save_btn">Save Entry</button>
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


