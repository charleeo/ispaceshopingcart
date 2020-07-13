
<nav class="navbar navbar-expand-lg  shadow  my-nav pr-5 " style="background:#fff!important; height:100px;">
  
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link " href="https://ispace.prolearncloud.com"> <img src="./assets/images/logo/ispacelogo.png" alt=" Ispacelogo" width="200px" height="70px"> <span class="sr-only">(current)</span></a>
    </li>
  </ul>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link " href="https://ispace.prolearncloud.com/local/staticpage/view.php?page=about">About </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="https://ispace.prolearncloud.com/local/staticpage/view.php?page=codingkits">Coding Kits </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="https://ispace.prolearncloud.com/local/staticpage/view.php?page=faqs">Faqs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="https://ispace.prolearncloud.com/local/staticpage/view.php?page=nigeria">Nig Pricing</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="https://ispace.prolearncloud.com/local/staticpage/view.php?page=ghana">Ghana</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="https://ispace.prolearncloud.com/local/staticpage/view.php?page=abidjan">CIV</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="./index.php">Courses and Payment</a>
      </li>
    </ul>

    <!-- Login and register area -->
    <ul class="navbar-nav mr-0">
      <?php if(is_logged_in()) { ?>


      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dashboard
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="./view_payment.php">View Payments</a>
          <a class="dropdown-item" href="./edit_course.php">Edit Course</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="./logout.php">Logout</a>
        </div>
      </li>
      <?php
       } 
      ?>
    </ul>
    <!--  -->

    <ul class="navbar-nav mr-0">
      <?php if(!empty($_SESSION['cart'])){?>
      <li class="">
        <a href="view_cart.php" class="nav-item nav-link ">
          View Cart
          <i class="fas fa-shopping-cart fa-lg  text-secondary"></i>
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
        <?php } ?>
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

