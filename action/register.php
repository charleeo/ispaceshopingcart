<?php
require_once('../config/Database.php');
require_once('../query/GetData.php');
require_once('../config/confi.php');
$user = new Models();

if(isset($_POST['admin-create']))
{
  $error = '';
  $password = trim(checkInput($_POST['password']));
  $email = trim(checkInput($_POST['admin_name']));

  
  if(empty($password))
  {
    $error = "Please fill out the required field password";
  }
  else if(empty($email))
  {
    $error = "Please fill out  the required field email";
  } 
  

  if(!empty($error))
  {
    $_SESSION['email'] = $email;
    header("Location: ../register.php?error=".$error);
  }
  else
  {
    
      $hashPassword = password_hash($password, PASSWORD_DEFAULT);
      $user->registerAdmin($hashPassword, $email);
      unset($_SESSION['email']);
      $_SESSION['message'] = "User created successfully";
      header("Location: ../edit_course.php");
    }
  
  }
else
{
  echo "Invalid request please try again";
}