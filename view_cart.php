<?php
  require_once('config/Database.php');
  require_once('query/GetData.php');
  require_once('config/confi.php');
  include('includes/head.php');
  include('includes/navbar.php');
  $totalAmount = 0;
  if(!empty($_SESSION['cart'])){
?>
<?php 
   if(isset($_GET['error'])){ ?>
    <div class="alert">
    <button type="button" class="close text-light" data-dismiss="alert">×</button>
      <p class="text-center text-light">
        <strong >
          <?php 
           echo $_GET['error'];
          ?>
        </strong>
      </p>
    </div>
  <?php }  ?>
<section>
  <div class="row  px-4">
    <div class="col-md-8 col-sm-9">
    <div class="card border-0 mt-5">
      <div class="card-header"><h6>My Cart details</h6></div>
      <div class="card-body">
        <?php 
          foreach($cart_id as $cart){
            ?>
       <div class="row  mb-2 border  py-5 justify-content-center">
         <div class="col-md-7 col-sm-7  shadow-lg p-3 mr-3" style="background:#fff">
            <h6>About Course</h6> <hr>
            <p class="p-3 pl-0" ><?php echo $cart['summary']?></p>
         </div>
         <div class="col-md-4 border shadow col-sm-6 py-5" style="background:#fff">
           <h6> Course Name: <?php echo $cart['fullname']?></h6>
           <h6>Price/Course/Month: <b class="text-info">&#8358;<?php echo $cart['amount']?> </b>
          </h6>
           <form action="action/remove_item.php?action=remove&id=<?= $cart['course_id']?>" method="POST">
            <button class="btn btn-danger" name="remove">Remove</button>
          </form>
         </div>
       </div>
       <?php } ?>
      </div>
    </div>
    </div>

    <!-- Right hand column -->
    <div class="col-md-4 py-5">
      <div class="list-item">
        <div class="card">
          <div class="card-header">
            <h4 class="text-start">Price Details</h4>
          </div>
          <div class="card-body border-0">
              <?php 
              foreach($cart_id as $cart){
  
                $totalAmount = $totalAmount+ $cart['amount'] ;
              } ?>
              <table class="table table-striped table-bordered">
                <thead>
                  <th>No Of Courses</th>
                  <th>Full Payment(Two Months) </th>
                  <th>Part Payment(One Month) </th>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <?php echo count($cart_id) ?>
                    </td>
                    <td>&#8358;<?php echo (int)$totalAmount * 2 ;?></td>
                    <td> &#8358;<?php echo (int)$totalAmount;?></td>
                  </tr>
                </tbody>
              </table>
              <a href="#payhere" class="btn btn-info btn-sm">Pay Below</a>
            </div>
          </div>
        </div>
        <span id="payhere"></span>
    </div>
  </div>
</section> 

<section >
<div class="card-footer " style="background:#fff"> 
<h4 class="text-center">Payment Form</h4>
<div class="row">
  <div class="col-md-6 col-sm-6 offset-3">
    <form action="./pay.php" method="POST" class="shadow p-5">
      <div class="row">
        <div class="col-md-4 col-sm-4">
          <div class="form-group">
            <label for="payment_plan">Payment Option</label>
          </div>
        </div>
        <div class="col-md-8 col-sm-8">
          <div class="form-group">
            <select name="payment_plan" id="payment_plan" required class="form-control border-0">
              <option value="">Select a payment option</option>
              <option value="<?php echo (int)$totalAmount?>">Full Payment</option>
              <option value="<?php echo (int)$totalAmount /2 ?>">Part Payment</option>
            </select>
          </div>
        </div>
      </div>
      <!-- <div class="row">
        <div class="col-md-4 col-sm-4">
          <div class="form-group">
            <label for="currency">Payment Currency</label>
          </div>
        </div>
        <div class="col-md-8 col-sm-8">
          <div class="form-group">
            <select name="currency" id="" required class="form-control">
              <option value="">Select Currency</option>
              <option value="NGN">NGN</option>
              <option value="usd">USD</option>
              <option value="GHS">GHS</option>
            </select>
          </div>
        </div>
      </div>  -->
      <div class="row">
        <div class="col-md-4 col-sm-4">
          <div class="form-group">
            <label for="email">Email Address</label>
          </div>
        </div>
        <div class="col-md-8 col-sm-8">
          <div class="form-group">
            <input type="text" name="email"  placeholder="enter active email address" class="form-control" />
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-md-4 col-sm-4">
          <div class="form-group">
            <label for="email">Phone Number</label>
          </div>
        </div>
        <div class="col-md-8 col-sm-8">
          <div class="form-group">
            <input type="number" name="phone" required placeholder="Phone number here" class="form-control" />
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-md-4 col-sm-4">
          <div class="form-group">
            <label for="firstname">First Name(s)</label>
          </div>
        </div> 
        <div class="col-md-8 col-sm-8">
          <div class="form-group">
            <input type="text" name="firstname" required placeholder="for above one child, separate with ," class="form-control" />
            <small class="text-danger">If you're paying for more than one child, please separate their names, with coma(,)</small>
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-md-4 col-sm-4">
          <div class="form-group">
            <label for="lastname">Last Name(s)</label>
          </div>
        </div> 
        <div class="col-md-8 col-sm-8">
          <div class="form-group">
            <input type="text" name="lastname" placeholder="for above one child, separate with ," class="form-control" />
            <small class="text-danger">If you're paying for more than one child, please separate their names, with coma(,)</small>
          </div>
        </div>
      </div> 
      <div class="row justify-content-center ml-5">
        <div class="col-md-8  offset-md-2 col-md-8">
          <div class="form-group">
            <input type="submit" value="Checkout" name="checkout" class="form-control btn btn-sm btn-info" />
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
  </div>
</div>
</section>

<?php } else{ ?>
  <p class="text-center alert mt-5 text-light">You have no item in Your Cart</p>
<?php } 

include('./includes/footer.php');
?> 
