<?php
include('authentication.php');


//Handle form submission
if(isset($_GET['diary_id'])){
    $diary_id = $_GET['diary_id'];

        if (isset($_POST['save_btn'])) {
            $diary_headline =  $_POST['diary_headline'];
            $diary_msg = $_POST['diary_msg'];
            $diary_create_datetime = date("Y-m-d H:i:s");

            

            $query = "UPDATE diary SET  diary_headline='$diary_headline', diary_msg='$diary_msg', diary_create_datetime='$diary_create_datetime'
             WHERE diary_id='$diary_id'";
            $query_run = mysqli_query($con, $query);
            

            if($query_run)
            {
                echo "Saved";
                $_SESSION['message'] = "Entry Updated!";
                echo "<script>window.location.href='view-entries.php'</script>";
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

        if (isset($_POST['delete_btn'])) {
            // Build SQL query to delete specific entry
            $query = "DELETE FROM diary WHERE diary_id = $diary_id";
            $query_run = mysqli_query($con, $query);

            if($query_run)
            {
                echo "Saved";
                $_SESSION['message'] = "Entry Deleted!";
                echo "<script>window.location.href='view-entries.php'</script>";
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
}

?>


