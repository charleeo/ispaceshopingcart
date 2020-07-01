<nav class="navbar navbar-expand-lg navbar-light shadow-sm fixed-top my-nav">
  
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link " href="https://ispace.prolearncloud.com"> <img src="./assets/images/logo/ispacelogo.png" alt=" Ispacelogo" width="90%"> <span class="sr-only">(current)</span></a>
    </li>
  </ul>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link " href="index.php">Prices <span class="sr-only">(current)</span></a>
      </li>
    </ul>

    <!-- Login and register area -->
    <ul class="navbar-nav mr-0">
      <?php if(is_logged_in()) { ?>

      <li class="nav-item">
        <a class="nav-link" href="./logout.php">Logout</a>
      </li>
      <?php
       } 
      else{
      ?>
      <li class="nav-item">
        <a class="nav-link" href="./login.php">Log-in</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./register.php">Register</a>
      </li>
      <?php } ?>
    </ul>
    <!--  -->

    <ul class="navbar-nav mr-0">
      <li class="">
        <a href="view_cart.php" class="nav-item nav-link ">
          View Cart
          <i class="fas fa-shopping-cart fa-lg "></i>
          <?php

          if (isset($_SESSION['cart'])){
              $count = count($_SESSION['cart']);
              echo "<span id=\"cart_count\" class=\"text-warning badge badge-secondary cart \">$count</span>";
          }else{
              echo "<span id=\"cart_count\" class=\"text-warning badge badge-secondary\">0</span>";
          }

          ?>
        </a>
      </li>
    </ul>
    
  </div>
</nav>
<!-- Push navbar up -->
<hr class="nav-pusher">
<hr class="nav-pusher">

<!-- Flash Message -->
<section class="mt-5">
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
<?php 
   if(isset($_SESSION['error'])){ ?>
    <div class="alert">
    <button type="button" class="close text-light" data-dismiss="alert">×</button>
      <p class="text-center text-light">
        <strong >
          <?php 
           echo $_SESSION['error'];
           unset($_SESSION['error']);
          ?>
        </strong>
      </p>
    </div>
  <?php }  ?>
</section>

