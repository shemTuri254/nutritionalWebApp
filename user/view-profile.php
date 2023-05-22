<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
      <h4 class="mt-4">Profile</h4>
      <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item active">Dashboard</li>
          <li class="breadcrumb-item active">Profile</li>
      </ol>
      <?php include('../message.php')?>
      <div class="d-flex flex-row justify-content-center align-items-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                    
                    <h2><i class="fas fa-user fa-fw"></i><strong>Username:</strong> <?= $_SESSION['auth_user']['username']; ?></h2>
                    <br>
                            <?php
                                    $query = "SELECT * FROM user_profiles WHERE user_id = '".$_SESSION['auth_user']['user_id']."'";
                                    $query_run = mysqli_query($con, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        while($row = mysqli_fetch_assoc($query_run))
                                        {
                                            ?>
                                                <h4> <span class="text-danger"> Your User ID : </span><?php echo $row['user_id']; ?> </h4>
                                                <h4> <span class="text-danger"> Your Profile ID : </span><?php echo $row['profile_id']; ?> </h4>
                                                <h4> <span class="text-danger">  Your age is : </span> <?php echo $row['profile_age']; ?> </h4>
                                                <h4> <span class="text-danger"> Your height is : </span> <?php echo $row['profile_height']; ?>cm </h4>
                                                <h4> <span class="text-danger"> Your weight is : </span> <?php echo $row['profile_weight']; ?>Kgs </h4>
                                                <h4> <span class="text-danger"> Your Health Condition is : </span> <?php echo $row['profile_health_conditions']; ?> </h4>
                                                <h4> <span class="text-danger"> Your BMI is : </span> <?php echo $row['profile_bmi']; ?> </h2>
                                                
                                                    <form action="alter-profile.php?id=<?=$row['profile_id'];?>" method="POST">
                                                        <input type="hidden" name="edit_id" value="">
                                                        <button type="submit" name="alter_btn" class="btn btn-success m-2 w-50">EDIT</button>
                                                    </form>
                                            
                                            
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        // a button to add profile
                                        ?>
                                        <h2> You don't have a profile yet. </h2>
                                         <form action="edit-profile.php" method="POST">
                                          <input type="hidden" name="edit_id" value="">
                                          <button type="submit" name="edit_btn" class="btn btn-success m-2">EDIT</button>
                                      </form>
                                        <?php
                                    }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

      </div>

</div>


<?php 
include 'includes/footer.php';
include 'includes/scripts.php';
?>
