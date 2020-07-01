<?php
require_once('./config/Database.php');
require_once('query/GetData.php');
require_once('./config/confi.php');

include('includes/head.php');
include('includes/navbar.php');
?>

<div class="row justify-content-center">
  <div class="col-md-6 offset md-3">
    <div class="row">
      <p class="text-center text-danger mt-4">
        <?php echo getError('error'); ?>
      </p>
    </div>
    <form action="./action/register.php" method="POST">
      <div class="form-group">
        <label for="email">User Name</label>
        <input type="text" name="admin_name" class="form-control">
      </div>
      <div class="form-group">
        <label for="password">password</label>
        <input type="text" name="password" class="form-control">
      </div>
      <div class="form-group">
        <button class="btn btn-info btn-md" value="<?php echo echoSession('email');?>" name="admin-create">Register</button>
      </div>
    </form>
  </div>
</div>

<?php include 'includes/footer.php' ?>