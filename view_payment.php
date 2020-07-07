<?php

require_once('./config/Database.php');
require_once('query/GetData.php');
require_once('./config/confi.php');
$model = new Models();
$paymentHostory = $model->getPaymentHistory();

include('includes/head.php');
include('includes/navbar.php');
?>
<section class="mt-5 px-5">
<table class="table table-stripped table-bordered table-sm">
  <thead class="text-center">
    <th>#</th>
    <th>Name</th>
    <th>Email</th>
    <th>Amount Paid</th>
    <th>Date Paid</th>
    <th>Payment Currency</th>
    <th>Courses Paide For</th>
    <th>Transaction ID</th>
  </thead>
  <tbody>
    <?php foreach($paymentHostory as $key => $history): ?>
      <tr>
        <td><?php echo $key +1?></td>
        <td><?php echo $history['fname']; echo"&nbsp;";  echo $history['lname']?></td>
        <td><?php echo $history['email'];?></td>
        <td> &#8358;<?php echo $history['grand_total'];?></td>
        <td><?php echo date("d M  \, Y ", strtotime($history['txn_date']));?></td>
        <td><?php echo $history['currency'];?></td>
        <td>
          <?php
          foreach(explode(',',$history['courses']) as $course){
            echo trim($course, '""');
          }?>
        </td>
        <td><?php echo $history['transaction_id'];?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</section>
<?php
include('./includes/footer.php');