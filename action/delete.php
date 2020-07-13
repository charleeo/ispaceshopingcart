<?php
require_once('../config/Database.php');
require_once('../query/GetData.php');
require_once('../config/confi.php');
$models = new Models();
if(isset($_GET['course_id'])){
  $courseId = checkInput($_GET['course_id']);
  if( $models->deleteCourse($courseId) == true){
    $_SESSION['message'] = "Course Deleted Successfully";
    headerRedirect('../index.php');
  }
  
}