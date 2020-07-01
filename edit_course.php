<?php

require_once('./config/Database.php');
require_once('query/GetData.php');
require_once('./config/confi.php');
$data = new GetData();
$models = new Models();
$result = $data->getCourses();
include('includes/head.php');
include('includes/navbar.php');
if(!is_logged_in()){
  headerRedirect('./index.php');
}

?>
<section>
  <?php 
   if(isset($_SESSION['message'])){ ?>
    <div class="alert">
    <button type="button" class="close text-light" data-dismiss="alert">×</button>
      <p class="text-center text-light">
        <strong >
          <?php 
           echo $_SESSION['message'];
           unset($_SESSION['message']);
          ?>
        </strong>
      </p>
    </div>
  <?php }  ?>
  <div class="row justify-content-center">
    <?php foreach($result as $re){ ?>
    <div class="col-md-4 py-4 col-sm-6">
      <div class="card">
        <div class="card-header">
          <h3 class="text-center"><?= $re['fullname']?></h3>
        </div>
        <div class="card-body">
          <p><?= $re['summary']?></p>
        </div> <hr>
        <div class="">
          <form action="action/update_course.php" method="post" enctype="multipart/form-data">
          <div class="form-group mx-5">
            <input type="file" class="form-control border-0 " name="course_image"required/>
          </div>
          <div class="form-group mx-5">
            <input type="text" class="form-control" name="amount" placeholder="Enter the Price for a course here" required/>
          </div>
            <div class="form-group">
              <button type="submit" class="btn btn-info btn-sm pull-right ml-5" name="update_course" id="course_id<?= $re['course_id']?>">
                Update Course
              </button>
            </div>
            <input type="hidden" name="course_id" value="<?= $re['course_id']?>">
            <input type="hidden" name="summary" value="<?= $re['summary']?>">
            <input type="hidden" name="fullname" value="<?= $re['fullname']?>">
            <input type="hidden" name="shortname" value="<?= $re['shortname']?>">
          </form>
        </div>
      </div>
    </div>
<?php } ?>
  </div>
</section>
<?php
include('./includes/footer.php');