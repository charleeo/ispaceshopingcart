<?php

require_once('config/Database.php');
require_once('config/confi.php');
if(is_logged_in()){
  unset($_SESSION['admin_id']);
  $_SESSION['success_message'] = "Logged Out Successful";
  header('Location: index.php');
}else{
  $_SESSION['error'] = "You don't have the permission to perform this action";
  header('Location: index.php');
}