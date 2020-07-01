<?php
require_once('../config/Database.php');
require_once('../query/GetData.php');
require_once('../config/confi.php');

if(isset($_POST['remove'])){
  if($_GET['action'] == 'remove'){
    $courseId = checkInput($_GET['id']);
    foreach($cart_id as $key => $value){
      // print_r($value); exit;
      if($value['course_id'] == $courseId){
        unset($_SESSION['cart'][$key]);
        $_SESSION['message'] = "Course removed from cart successfully";
        headerRedirect('../view_cart.php');
      }
    }
  }
}