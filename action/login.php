<?php
  require_once('../config/Database.php');
  require_once('../query/GetData.php');
  require_once('../config/confi.php');

  $error = '';

  $userObject = new Models();
if(isset($_POST['login']))
{
  $admin_name = checkInput($_POST['admin_name']);
  $password = checkInput($_POST['password']);
  $user = $userObject->checkIfAUserExist($admin_name);
  $user = $user->fetch_assoc();
  
  
  if(empty($password) || empty($admin_name) )
  {
    $error= "All fields are required";
  }
  else if(!$user)
  {
    $error = "No User with this  record is found";
  }
  
  else if(!password_verify($password, $user['password']))
  {
    $error = "Invalid Credentials, please check your inputs";
    
  }
  if(!empty($error))
  {

    $_SESSION['admin_name'] = $admin_name;
    $_SESSION['error'] = $error;
    
    header("Location: ../login.php");
  }
  else
  {
    unset($_SESSION['admin_name']);
    $_SESSION['admin_id']= $user['admin_id'];
    $_SESSION['message'] = "Login  successful";
    header('Location: ../edit_course.php');
  }
}