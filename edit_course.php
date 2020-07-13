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
  <div class="row justify-content-center px-4 pt-4">
    <?php
    // $courseId = array_column($result,'course_id');
    foreach($result as $re){ 
      $result2 = $models->getAllCouserFieldsById($re['course_id']);
      ?>
    <div class="col-md-4 py-4 col-sm-4">
      <div class="card">
        <div class="card-header border-0 image-card-header">
        <?php if(!empty($result2['course_image'] )){
            ?>
            <img src="<?php echo $result2['course_image']; ?>" alt="<?php echo $re['fullname']?>" style="height:100px;" />
         <?php } ?>
          
          </div>
          <div class="card-body">
              <h6 class="text-center">Course Name: <?= $re['fullname']?></h6>
          <!-- From the updated record -->
        <?php if(!empty($result2['amount'] )){
            ?>
            <p class="text-center"> Amount: &#8358;<?= $result2['amount']?></p>
         <?php } ?>
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
              <a href = "action/delete.php?course_id=<?php echo $re['course_id']?>" class="btn btn-danger btn- ml-5" name="update_course" id="course_id<?= $re['course_id']?>">
                Delete
              </a>
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