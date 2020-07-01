<?php
require_once('config/Database.php');
require_once('query/GetData.php');
require_once('config/confi.php');
$models = new Models();
$data = new GetData();

if(!isset($_GET['success'])){
  $error = "Payment not success";
  headerRedirect("./view_cart.php?error=$error");
}else{
  $reference = checkInput($_GET['success']);
  $currency = "NGN";
  $amount = checkInput($_SESSION['amount']);
  $email = checkInput($_SESSION['email']);
  $phone = checkInput($_SESSION['phone']);
  $fname = checkInput($_SESSION['fname']);
  $lname = checkInput($_SESSION['lname']);
  $courses   = $_SESSION['course'];
  $transactionId = $models->getTransactionByReferenceID($reference);
  
      if($transactionId == null OR $transactionId == '' OR empty($transactionId) && $transactionId != $reference){
        $models->insertTransaction($reference,$fname,$lname,$amount,$email,$currency,$courses);
      }
  unset($_SESSION['cart']);
  include('includes/head.php');
  include('includes/navbar.php');
?>

<section>
  <div class="row mt-5">
  <div class="col-md-8 offset-md-2 col-sm-8">
  <div class="card border-0">
      <div class="card-header" >
        <button type="button" class="close text-light" data-dismiss="alert">
          ×
          </button>
          <span class="text-center">Transaction Successful</span>
          <i class="fa fa-check fa-2x text-success" aria-hidden="true"></i>
      </div>
      <div class="card-body">
        <h5 class="card-title text-center">Hello <?php echo $fname ?>!</h5> <hr>
        <p>
          Thanks for choosing Ispace Virtual Learning as your learning platform, you will receive a receipt for your payment through <b><?php echo $email?> </b>
        </p>
        <ul class="list-group">
          <li class="list-group-item">Transaction ID: <b><?php echo $reference; ?> </b></li>
          <li class="list-group-item">Transaction Amount: &#8358; <b> <?php echo number_format($amount,2);?></b> </li>
          <?php foreach ($_SESSION['course'] as $key => $value) {
          ?>
          <li class="list-group-item">Course: <b> <?php echo $value['fullname'];?> </b></li> 
          <?php }         ?>
                
          <li class="list-group-item">Email: <b> <?php echo $email?></b></li>

          <li class="list-group-item">Names: <b><?php echo $fname?> &nbsp; <?php echo $lname?></b></li>
        </ul>
        <p class="text-info pt-2">Thanks once again! <b>Ispace Virtual Learning</b> </p>
      </div>
      </div>
    </div>
  </div>
</section>
<?php }
include_once('./includes/footer.php');