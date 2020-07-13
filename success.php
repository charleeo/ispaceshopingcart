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
  $paymentPlan = checkInput($_SESSION['plan']);
  $dueDate = checkInput($_SESSION['dueDate']);
  $courses   = json_encode($_SESSION['course']);
  $transactionId = $models->getTransactionByReferenceID($reference);
  $transactionId2 = $models->getTransactionDetailsById($reference);
  
  require('fpdf17/fpdf.php');
  if(isset($_POST['download'])){
  $pdf = new FPDF();
  $pdf->AliasNbPages();
  $pdf->AddPage('L','A4',0);
  $pdf->Image('assets/images/logo/ispacelogo.png', 10,6);
  $pdf->SetFont('Arial', 'B', 16);
  $pdf->Cell(276,5, 'ISPACE VIRTUAL LEARNING',0,0, 'C');
  $pdf->Ln(10);
  $pdf->SetFont('Times', 'B',14);
  $pdf->Cell(276,10,'Your Payment Receipt Details',0,0,'C');
  $pdf->Ln(15);

  $pdf->SetFont('Arial', 'B',5);
  $pdf->Cell(296,0,'',1,0,'L');
    
  $pdf->Ln(15);
  $pdf->SetFont('Times', 'B', 12);
  $pdf->Cell(106,10,'Transaction ID',0,0,'R');
  $pdf->Cell(90,10,$reference,0,0,'C');
  $pdf->Ln(10);

  $pdf->SetFont('Times', 'B', 12);
  $pdf->Cell(106,10,'Transaction Amount',0,0,'R');
  $pdf->Cell(90,10,$amount,0,0,'C');
  $pdf->Ln(10);

  foreach (explode(",",$_SESSION["course"]) as $key => $value) {
  $pdf->SetFont('Times', 'B',12);
  $pdf->Cell(106,10,'Course',0,0,'R');
  $pdf->Cell(90,10,$value,0,0,'C');
  $pdf->Ln(10);
  }

  $pdf->SetFont('Times', 'B', 12);
  $pdf->Cell(106,10,'Email',0,0,'R');
  $pdf->Cell(90,10,$email,0,0,'C');
  $pdf->Ln(10);

  $pdf->SetFont('Times', 'B', 12);
  $pdf->Cell(106,10,'Name',0,0,'R');
  $pdf->Cell(90,10,$fname,0,0,'C');
  $pdf->Ln(10);

  $pdf->SetFont('Times', 'B', 12);
  $pdf->Cell(106,10,'Due Date',0,0,'R');
  $pdf->Cell(90,10,$dueDate,0,0,'C');
  $pdf->Ln(10);
  $pdf->SetFont('Times', 'B', 12);
  $pdf->Cell(106,10,'Payment Plan',0,0,'R');
  $pdf->Cell(90,10,$paymentPlan,0,0,'C');

  $pdf->Ln(10);
  $pdf->SetFont('Arial', 'B',5);
  $pdf->Cell(296,0,'',1,0,'L');

  $pdf->Ln(20);
  $pdf->SetFont('Arial', 'B', 14);
  $pdf->Cell(196,10,'You will receive an email notification on how to access your courses.',0,0,'C');
  $pdf->Ln(10);
  $pdf->SetFont('Arial','B', 16);
  $pdf->Cell(176,10,'Thanks once again! Ispace Virtual Learning', 0,0,'C');
  ob_clean();
  $pdf->Output();
  }
  
  if($transactionId == null OR $transactionId == '' OR empty($transactionId) && $transactionId != $reference){
    $models->insertTransaction($reference,$fname,$lname,$amount,$email,$currency,$courses,$dueDate, $paymentPlan,$children);
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
          <?php foreach (explode(",",$_SESSION["course"]) as $key => $value) {
          ?>
          <li class="list-group-item">Course: <b> <?php echo $value;?> </b></li> 
          <?php }         ?>
                
          <li class="list-group-item">Email: <b> <?php echo $email?></b></li>

          <li class="list-group-item">Names: <b><?php echo $fname?> &nbsp; <?php echo $lname?></b></li>
          <li class="list-group-item">Due Date: <b><?php echo $dueDate?> </b></li>
          <li class="list-group-item">Payment Plan: <b><?php echo $paymentPlan?> </b></li>
        </ul>
        <p class="text-info pt-2">
          You will receive an email notification on how to access your courses  <br>
            Thanks once again! <b>Ispace Virtual Learning</b> </p>
            <form action="" method="POST">
              <button name="download" class="btn btn-info">Download Receipt</button>
            </form>
      </div>
      </div>
    </div>
  </div>
</section> 
<?php


?>
<?php }

  include_once('./includes/footer.php');
  ?>

<?php 

?>