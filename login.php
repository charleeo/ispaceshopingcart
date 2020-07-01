<?php
require_once('./config/Database.php');
require_once('query/GetData.php');
require_once('./config/confi.php');

include('includes/head.php');
include('includes/navbar.php');

?>

<div class="row justify-content-center ">
  <div class="col-md-6 offset md-3">
    <div class="row">
      <p class="text-center text-danger mt-4">
        <?php echo echoSession('error'); unset($_SESSION['error']) ?>
      </p>
    </div>
    <form action="./action/login.php" method="POST" class="shadow-lg p-4 mb-4">
      <div class="form-group">
        <label for="email">User Name</label>
        <input type="text" name="admin_name" autocomplete= "off" value="<?php echo echoSession('admin_name') ?>" class="form-control">
      </div>
      <div class="form-group">
        <label for="password">password</label>
        <input type="password" name="password" class="form-control">
      </div>
      <div class="form-group">
        <button class="btn btn-default text-info" name="login">Login</button>
      </div>
    </form>
  </div>
</div>
