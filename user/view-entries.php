<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
      <h4 class="mt-4">Users</h4>
      <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item active">Dashboard</li>
          <li class="breadcrumb-item active">View Entries</li>
      </ol>
      <?php include('../message.php')?>
      <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Food Diary Entries</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-success table-striped-columns">
                            <thead>
                                <tr>
                                    <th>Diary ID</th>
                                    <th>Date Created</th>
                                    <th>Headline</th>
                                    <th>Message</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                    $id = $_SESSION['auth_user']['user_id'];
                                    $query = "SELECT * FROM diary WHERE user_id='$id' ORDER BY diary_create_datetime DESC";
                                    $query_run = mysqli_query($con, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        while($row = mysqli_fetch_assoc($query_run))
                                        {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['diary_id']; ?></td>
                                                <td><?php echo $row['diary_create_datetime']; ?></td>
                                                <td><?php echo $row['diary_headline']; ?></td>
                                                <td><?php echo $row['diary_msg']; ?></td>
                                                <td>
                                                    <form action="edit-entry.php?diary_id=<?= $row['diary_id']?>" method="post">
                                                        <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                                        <button type="submit" name="edit_btn" class="btn btn-success">EDIT</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="entry-code.php?diary_id=<?= $row['diary_id']?>" method="post">
                                                        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                                        <button type="submit" name="delete_btn" class="btn btn-danger">DELETE</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "No Record Found";
                                    }

                                ?>
                            </tbody>
                        </table>
                    </div>
            </div>

      </div>
      <div class="my-4">
        <li class="list-unstyled text-primary">
        <a href="new-diary.php" class="btn btn-primary">Create Entry</a>
        </li>
      </div>
      <form action="generate-pdf.php" method="post">
            <button type="submit" name="create_button" class="btn btn-success">Generate Report</button>
        </form>

</div>


<?php 
include 'includes/footer.php';
include 'includes/scripts.php';
?>
