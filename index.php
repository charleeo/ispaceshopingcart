<?php

require_once('./config/Database.php');
require_once('query/GetData.php');
require_once('./config/confi.php');
$data = new GetData();
$result = $data->getCoursesForIndex();

include('includes/head.php');
include('includes/navbar.php');
// checkInput($data->insertCourse());
?>
<section class="mt-5">
  <div class="row justify-content-center">
    <?php foreach($result as $re){ ?>
    <div class="col-md-4 py-4 col-sm-6">
      <div class="card">
        <div class="card-header">
          <img class="rounded p-0" src="<?= $re['course_image']?>" style="width:100%"/>
        </div>
        <div class="card-body">
          <div class="card-title">
            <p><?= $re['shortname']?></p>
          </div>
          <p><?= $re['summary']?></p>
        </div>
        <div class="card-footer bg-secondary  text-center">
          <form action="action/add_to_cart.php" method="post">
          <span class="text-white" >&#8358;<?= $re['amount']?></span>
            <button type="submit" class="btn btn-info btn-sm pull-right ml-5" name="add_to_cart" id="course_id<?= $re['course_id']?>">Add to cart
            <i class="fas fa-shopping-cart fa-lg text-light"></i>
          </button>
            <input type="hidden" name="amount" value="<?= $re['amount']?>">
            <input type="hidden" name="course_id" value="<?= $re['course_id']?>">
            <input type="hidden" name="fullname" value="<?= $re['fullname']?>">
            <input type="hidden" name="summary" value="<?= $re['summary']?>">
            <input type="hidden" name="course_immage" value="<?= $re['course_image']?>">
          </form>
        </div>
      </div>
    </div>
<?php } ?>
  </div>
</section>
<?php
include('./includes/footer.php');