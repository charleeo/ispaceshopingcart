<?php
require_once('../config/Database.php');
require_once('../query/GetData.php');
require_once('../config/confi.php');
$data = new GetData();
$models = new Models();

$dbPath = '';
$errors = '';
if(isset($_POST['update_course'])){
  $amount = checkInput($_POST['amount']);
  $courseId = checkInput($_POST['course_id']);
  $summary = checkInput($_POST['summary']);
  $fullname = checkInput($_POST['fullname']);
  $shortname = checkInput($_POST['shortname']);
  $result = $data->getCourseById($courseId);
  $imageString = $data->getCourseByImagePath($courseId);
  $imagePath = $imageString['course_image'];

  if(isset($_FILES['course_image'])){
    $errors= array();
    $file_name = $_FILES['course_image']['name'];
    $file_size = $_FILES['course_image']['size'];
    $file_tmp = $_FILES['course_image']['tmp_name'];
    $file_type = $_FILES['course_image']['type'];
    
    $file_ext= (explode('.',$file_name));
    $fe = ($file_ext[1]);
    $fileExtensionInLowerCase = strtolower($fe);

    $fileNameToUpload = time().'.'.$fileExtensionInLowerCase;

    $extensions= array("jpeg","jpg","png");
    
    if(!in_array($fileExtensionInLowerCase, $extensions)){
       $errors ="extension not allowed, please choose a JPEG or PNG file.";
    }
    
    if($file_size > 1097152) {
       $errors ='File size must be excately 1 MB or less';
      }
      if(empty($amount)){
        $errors ='Amount is required';

    }
    if(empty($errors)==true) {
      // echo $imagePath; exit;
      if(file_exists('../'.$imagePath)){
        unlink('../'.$imagePath);
      }
      move_uploaded_file($file_tmp,"../assets/images/".$fileNameToUpload);
      $dbPath = "assets/images/$fileNameToUpload";
      if($result != null OR $result != '' OR !empty($result) && $result == $courseId){
        
        $models->updateCourse($amount, $dbPath, $courseId);
      }else{ 
        
        
          // $models->insert2($courseId,$shortname,$fullname,$summary,$amount,$dbPath);
          $models->insert($courseId,$shortname,$fullname,$summary,$amount,$dbPath);
        }
        
      $_SESSION['message'] = "Course Updated Successfully";
       headerRedirect('../edit_course.php');
      }else{
        $_SESSION['error'] = $errors;
        $_SESSION['amount'] = $amount;
        headerRedirect('../edit_course.php');
    }
 }
}