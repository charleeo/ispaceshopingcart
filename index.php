<?php

require_once('./config/Database.php');
require_once('query/GetData.php');
require_once('./config/confi.php');
$data = new GetData();
$result = $data->getCoursesForIndex();

include('includes/head.php');
include('includes/navbar.php');
?>
<section class="mt-5">
  <div class="row justify-content-center px-5 py-5">
    <?php foreach($result as $re){ ?>
    <div class="col-md-4 col-sm-6">
      <div class="card shadow-lg">
        <div class="card-header border-0 image-card-header">
          <img class="rounded index-image" src="<?= $re['course_image']?>" style="width:100%; height:190px"/>
        </div>
        <div class="card-body border-0">
          <div class="card-title">
            <h6>Course Title: <?= $re['fullname']?></h6>
          </div>
          <?php $summary = substr($re['summary'], 0, 65); ?>
          <p class="<?php echo (strlen($re['summary']) <= 65) ?'p-wdown':''?>"><b>Course Summary: </b>  <?= $summary;?> 
          <span class="show-more"><?php echo substr($re['summary'], 65, -1); ?>
        </span>
        <?php if(strlen($re['summary']) > 65): ?>
        <input type ="button" value="More Details" class="view-btn btn btn-link text text-success" />
        </p>
          <?php endif ;?>
        </div>
        <div class="card-footer bg-secondary  text-center">
          <form action="action/add_to_cart.php" method="post">
          <span class="text-white" >&#8358;<?= $re['amount']?></span>
            <button type="submit" class="btn btn-info btn-sm pull-right ml-5" name="add_to_cart" id="course_id<?= $re['course_id']?>">Add to cart
            <i class="fas fa-shopping-cart fa-lg text-light"></i>
          </button>
            <input type="hidden" name="amount" value="<?= $re['amount']?>">
            <!-- <input type="hidden" name="course_id" value="<?= $re['id']?>"> -->
            <input type="hidden" name="course_id" value="<?= $re['course_id']?>">
            <input type="hidden" name="fullname" value="<?= $re['fullname']?>">
            <input type="hidden" name="summary" value="<?= $re['summary']?>">
            <input type="hidden" name="course_immage" value="<?= $re['course_image']?>">
          </form>
          <br>
          <?php if(is_logged_in()) { ?>
              <a href = "action/delete.php?course_id=<?php echo $re['course_id']?>" class="btn btn-danger btn- ml-5" name="update_course" id="course_id<?= $re['course_id']?>">
                Delete
              </a>
            <?php } ?>
        </div>
      </div>
    </div>
<?php } ?>
  </div>
</section>
<?php
include('./includes/footer.php');?>

