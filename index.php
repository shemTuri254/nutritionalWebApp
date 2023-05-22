<?php
session_start();
include('./user/config/dbcon.php');
include('./includes/header.php');
include('./includes/navbar.php');
?>

<?php if (isset($_SESSION['message'])) : ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong><?= $_SESSION['message']; ?></strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<?php if (isset($_SESSION['auth'])) : ?>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Welcome <?= $_SESSION['auth_user']['username']; ?></h3>
        </div>
        <div class="card-body">
            <p>Lorem ipsu
            </p>
        </div>
        </div>
        </div>
        </div>
        </div>
<?php else : ?>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Welcome Guest</h3>
        </div>
        <div class="card-body">
            <p>L    </p>    
        </div>
        </div>
        </div>
        </div>
        </div>
<?php endif; ?>

<?php
include('./includes/footer.php');
?>