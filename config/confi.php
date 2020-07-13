<?php
define('CART_COOKIE', 'SX443kPl56Nmv9IxZ8');
define('CART_COOKIE_EXPIRE', time()+ (86400 *30));

function checkInput($data){
  $data = strip_tags($data);
  $data = trim($data);
  $data = htmlspecialchars($data);
  $data = addslashes($data);
  return	$data;
}

$cart_id = '';
if(isset($_SESSION['cart'])){
    $cart_id = ($_SESSION['cart']);
}

function headerRedirect($location){
  return header("Location:".$location);
}

function is_logged_in()
{
  if(isset($_SESSION['admin_id']) && $_SESSION['admin_id'] > 0){
   return  true ;  
  }
  return false;
}

function echoSession($session)
{
  if(isset($_SESSION[$session]))
  {
    return $_SESSION[$session];
  }
  else return '';
}

function getError($error)
{
  if(isset($_GET[$error]))
  {
    return $_GET[$error];
  }
  else return '';
}
define("APIKEY", "pk_test_b04e1a0182d8e61539c2e12863650aa4859e8443");date_default_timezone_set('Africa/Lagos');