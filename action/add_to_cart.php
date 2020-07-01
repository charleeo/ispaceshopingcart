<?php
require_once('../config/Database.php');
require_once('../query/GetData.php');
require_once('../config/confi.php');
$domain = ($_SERVER['HTTP_HOST'] !='localhost')?'.'.$_SERVER['HTTP_HOST']:false;


if(isset($_POST['add_to_cart'])){
  $course_id = checkInput($_POST['course_id']);
  $amount = checkInput($_POST['amount']);
  $fullname = checkInput($_POST['fullname']);
  
  

//   if(isset($_SESSION['cart'])){
//     $cookie_data = stripslashes($_SESSION['cart']);
//     $cart_data = json_decode($cookie_data);
//   }else{
//   $cart_data = array();
//  }
  
// $course_id_list = array_column($cart_data, 'course_id');
// if(in_array($course_id, $course_id_list))
//  {
//   foreach($cart_data as $keys => $values)
//   {
//    if($cart_data[$keys]["course_id"] == $course_id)
//    {
//      $message = "Item in the cart already";
//     // $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_POST["quantity"];
//    }
//   }
//  }
//  else
//  {
//   $itemArray = [
//     "course_id" =>checkInput($_POST['course_id']),
//     "amount" => checkInput($_POST['aountm']),
//     "fullname" =>checkInput($_POST['fullname'])
//   ];
//     $cart_data[] = $item_array;
//  }
    
//   $item_data = json_encode($cart_data);
//   $cokie_expires = time() + (86400 *30);
//   setcookie(CART_COOKIE,$item_data, $cokie_expires, '/', $domain,false);
//   header("Location: ../index.php?message=$message");  

/// print_r($_POST['product_id']);
if($cart_id !=''){

  $item_array_id = array_column($_SESSION['cart'], "course_id");

  if(in_array($_POST['course_id'], $item_array_id)){
     $_SESSION['message'] = "This Course is already in your cart";
      headerRedirect('../index.php');
    }else{
      
      $count = count($_SESSION['cart']);
      $item_array = array(
        'course_id' => checkInput($_POST['course_id']),
        'fullname' => checkInput($_POST['fullname']),
        'amount' => checkInput($_POST['amount']),
        'summary' => checkInput($_POST['summary']),
        'course_image' => checkInput($_POST['course_image']),
      );
      
      $_SESSION['cart'][$count] = $item_array;
  
      $_SESSION['message'] = "Course Added To Cart Successfully";
      headerRedirect('../index.php');
    }
    
  }else{
    
    $item_array = array(
      'course_id' => $_POST['course_id'],
      'fullname' => $_POST['fullname'],
      'amount' => $_POST['amount'],
      'summary' => $_POST['summary'],
    );
    
    // Create new session variable
    $_SESSION['cart'][0] = $item_array;
    
    $_SESSION['message'] = "Course Added To Cart Successfully";
  headerRedirect('../index.php');
  
  }
}
