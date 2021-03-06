<?php
require_once('config/Database.php');
require_once('query/GetData.php');
require_once('config/confi.php');
$errors = '';
$courses = $_SESSION['cart'];
$courses = array_column($courses, 'fullname');
$courses =  implode(',',($courses));
// if(isset($_POST['checkout'])){
  $amount = checkInput($_POST['amount']);
  $email = checkInput($_POST['email']);
  $phone = checkInput($_POST['phone']);
  $firstName = checkInput($_POST['firstname']);
  $lastname = checkInput($_POST['lastname']);
  $paymentPlan = checkInput($_POST['payment_plan']);
  $dueDate  = date("Y-m-d", time());
  $date = new DateTime($dueDate); // Y-m-d
  
  
  if($paymentPlan == 'full'){
    $amount = $amount * 2;
    $paymentPlan = 'Full Payment';
    $date->add(new DateInterval('P60D'));
  }else{
    $paymentPlan = "Part Payment";
    $date->add(new DateInterval('P30D'));
  }
  $dueDate =$date->format('d \of M  \, Y');
  // $currency = checkInput($_POST['currency']);
  if(empty($firstName) OR empty($email) OR empty($phone) ){
      $errors = " Please fill out the required fields ";
  }
  else if(!is_numeric($phone)){
    $errors = " Phone must be number ";
  }
  else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors = "Please enter a valid email address in the email field";
  }
  if(!empty($errors)){ 
    
    headerRedirect('./view_cart.php?error='.$errors);
  }
  else{
    $_SESSION['fname'] = $firstName;
    $_SESSION['lname'] = $lastname;
    $_SESSION['phone'] = $phone;
    $_SESSION['email'] = $email;
    $_SESSION['amount'] = $amount;
    $_SESSION['course'] = $courses;
    $_SESSION['plan']   = $paymentPlan;
    $_SESSION['dueDate']   = $dueDate;
  }
  include('includes/head.php');
  include('includes/navbar.php');
?>
<section>
  <div class="row py-4 justify-content-center" >
  <div class="col-md-8 offset-md-2 col-sm-8">
  <div class="card border-0">
    <div class="card-header">
      <h4 class="text-center">Payment Details</h4>
    </div>
    <div class="card-body">
      <h5 class="card-title text-center">Hello  <?php echo $firstName ?>!</h5> <hr>
      <p>
        Your have ordered the below transaction details please review before proceeding to make payment
      </p>
      <ul class="list-group">
        <li class="list-group-item">Transaction Amount: &#8358; <b> <?php echo number_format($amount,2);?></b> </li>
        <?php
        foreach ($cart_id as $key => $value) {
          ?>
        <li class="list-group-item">
          <?php echo $value['fullname']; ?>    
        </li>
        <?php  } ?>
        <li class="list-group-item">Email: <b> <?php echo $email?></b></li>
        <li class="list-group-item">Payment Plan: <b> <?php echo $paymentPlan?></b></li>
        <li class="list-group-item">Due Date: <b> <?php echo $dueDate;?></b></li>

        <li class="list-group-item">Names: <b><?php echo $firstName;
      
        ?> &nbsp; <?php echo $lastname?></b></li>
      </ul>
      <p class="text-info pt-2">Best Regards <b>Ispace Virtual Learning</b> </p>
    </div>
    <div class="card-footer p-0">
      <form>
        <button type="button"  class="form-control btn btn-info" onclick="payWithPaystack()"> Make Payment </button> 
      </form>
    </div>
  </div>
  </div>
  </div>
</section>


<!-- place below the html form -->
<script>
  function payWithPaystack(){
    
    var handler = PaystackPop.setup({
      key: '<?php echo APIKEY ?>',
      email: '<?php echo $email?>',
      amount: <?php echo $amount * 100?>,
      currency:"NGN",
      ref: ''+Math.floor((Math.random() * 1000000000) + 1), 
      metadata: {
         custom_fields: [
            {
                display_name: "<?php echo $firstName?>",
                variable_name: "<?php echo $lastname?>",
                value: "<?php echo $phone ?>",
            }
         ]
      },
      callback: function(response){
          const referenceId = response.reference;
          window.location.href='success.php?success='+referenceId;
      },
      onClose: function(){
          window.location.href='../success.php?success='+referenceId;
      }
    });
    handler.openIframe();
  }
</script>
<?php include('./includes/footer.php');?>