<?php
class Models extends Database{
  public $conn, $table, $fields, $orderColumn, $order; 
  
  public  function getAll($table,  $orderColumn, $order, array $fields){
    $this->table = $table;
    $field = implode(',', $fields);
    $sql = "SELECT $field  FROM $table ORDER BY $orderColumn $order ";
    $stmt = $this->conn->prepare($sql);
    if(!$stmt)
    {
      echo " Error ". $this->conn->error;
      exit();
      
    }
    
    if(!$stmt->execute())
    {
      echo " Error ". $this->conn->error;
      exit();
    }
     $result = $stmt->get_result();   
     
     if($result->num_rows > 0)
     {
       $result = $result->fetch_all( MYSQLI_ASSOC);
       return  $result;
     }
     else  {
      $result = '';
      return $result;
    } 
  }
  public  function getCourseById($courseId){
    
    $sql = "SELECT course_id   FROM `courses_information` WHERE course_id = ?";
    $stmt = $this->conn->prepare($sql);
    if(!$stmt)
    {
      echo " Error ". $this->conn->error;
      exit();
    }
    if(!$stmt->bind_param('i',$courseId))
    {
      echo " Error ". $this->conn->error;
      exit();
    }
    
    if(!$stmt->execute())
    {
      echo " Error ". $this->conn->error;
      exit();
    }
     $result = $stmt->get_result();   
     
     if($result->num_rows > 0)
     {
       $result = $result->fetch_all( MYSQLI_ASSOC);
       return  $result;
     }
     else  {
      $result = '';
      return $result;
    } 
  }
  public  function getAllCouserFieldsById($courseId){
    $sql = sprintf('SELECT amount, course_image FROM courses_information WHERE course_id in("%s")', $courseId);
    $result = $this->conn->query($sql);
    if(mysqli_num_rows($result) > 0){
      $result = $result->fetch_assoc();
    }else{
      $result = '';
    }
    return $result;
  }
  public  function getCourseByImagePath($courseId){
    
    $sql = "SELECT course_image   FROM `courses_information` WHERE course_id = ?";
    $stmt = $this->conn->prepare($sql);
    if(!$stmt)
    {
      echo " Error ". $this->conn->error;
      exit();
    }
    if(!$stmt->bind_param('i',$courseId))
    {
      echo " Error ". $this->conn->error;
      exit();
    }
    
    if(!$stmt->execute())
    {
      echo " Error ". $this->conn->error;
      exit();
    }
     $result = $stmt->get_result();   
     
     if($result->num_rows > 0)
     {
       $result = $result->fetch_assoc();
       return  $result;
     }
     else  {
      $result = '';
      return $result;
    } 
  }
  public  function getTransactionByReferenceID($trans_id){
    
    $sql = "SELECT transaction_id   FROM `transactions` WHERE transaction_id = ?";
    $stmt = $this->conn->prepare($sql);
    if(!$stmt)
    {
      echo " Error ". $this->conn->error;
      exit();
    }
    if(!$stmt->bind_param('i',$trans_id))
    {
      echo " Error ". $this->conn->error;
      exit();
    }
    
    if(!$stmt->execute())
    {
      echo " Error ". $this->conn->error;
      exit();
    }
     $result = $stmt->get_result();   
     
     if($result->num_rows > 0)
     {
       $result = $result->fetch_all( MYSQLI_ASSOC);
       return  $result;
     }
     else  {
      $result = '';
      return $result;
    } 
  }
  public  function getCoursesSingle($courseId){


    $sql = "SELECT *  FROM `courses_information` WHERE 'id' = ? ";
    $stmt = $this->conn->prepare($sql);
    if(!$stmt)
    {
      echo " Error ". $this->conn->error;
      exit();
      
    }
    if(!$stmt->bind_param('i', $courseId))
    {
      echo " Error ". $this->conn->error;
      exit();
      
    }

    
    if(!$stmt->execute())
    {
      echo " Error ". $this->conn->error;
      exit();
    }
     $result = $stmt->get_result();   
     
     if($result->num_rows > 0)
     {
       $result = $result->fetch_all( MYSQLI_ASSOC);
       return  $result;
     }
     else  {
      $result = '';
      return $result;
    } 
  }

  // public function insert($table, array $fields, array $values, $placeholder, $bindingStrin){
  //   $field = implode(',',$fields);
  //   $value = implode(',',$values);
  //   $placeholder = implode(',',$placeholder);
    
  //   // $result_string = "'" . str_replace(",", "','", $mystring) . "'";
  //   $bindingStrin = "'" . str_replace(",", "','", $bindingStrin) . "'";
  //   $value = "'" . str_replace(",", "','", $value) . "'";
  //   $sql = "INSERT INTO $table ($field) VALUES($placeholder)";
  //     $stmt = $this->conn->prepare($sql);
  //     echo $bindingStrin;
  //     print_r($sql);
      
  //     if($stmt === false)
  //     {
  //       echo " Error ". $this->conn->error;
  //       exit();
  //     }

  //     if(!$stmt->bind_param($bindingStrin,$value)){

  //       echo " Error, could not bind parameter ". $this->conn->error;
  //       exit();
  //     }
  //     if(!$stmt->execute())
  //     {
  //       echo " Error ". $this->conn->error;
  //       exit();
  //     }
      
  //     else
  //     {
  //       return;
  //     }
  //   }
  
  public function insert($courseId, $shortname,$fullname, $summary, $amout, $couse_image){
    $sql = sprintf('INSERT INTO courses_information (course_id,shortname,fullname,summary,amount,course_image) VALUES("%s","%s","%s","%s","%s","%s")'
    ,$courseId, $shortname,$fullname, $summary, $amout, $couse_image);
  
    if($this->conn->query($sql)===true){
      return true;
    }else{

      echo " Error here ". $this->conn->error; exit;

    }
    }
  
  public function insert2($courseId, $shortname,$fullname, $summary, $amout, $couse_image)
  {
    
    $sql = "INSERT INTO courses_information (course_id, shortname, fullname, amount, summary, course_image) VALUES (?,?,?,?,?,?)";
      $stmt = $this->conn->prepare($sql);
      
      if($stmt === false)
      {
        echo " Error ". $this->conn->error;
        exit();
      }
      if(!$stmt->bind_param('ssssss',$courseId, $shortname, $fullname, $amout,$summary,$couse_image))
      {
        echo " Error ". $this->conn->error;
        exit();
      }
      if(!$stmt->execute())
      {
        echo " Error ". $this->conn->error;
        exit();
      }
      
      else
      {
        return;
      }
    }

    public function updateCourse($amount, $image, $course_id){
      $sql = "UPDATE `courses_information` SET amount = ?, course_image = ? WHERE course_id = ?";  
      $stmt = $this->conn->prepare($sql);
      
      if($stmt === false)
      {
        echo " Error ". $this->conn->error;
        exit();
      }
      if(!$stmt->bind_param('ssi', $amount, $image, $course_id))
      {
        echo " Error ". $this->conn->error;
        exit();
        
      }
      if(!$stmt->execute())
      {
        echo " Error ". $this->conn->error;
        exit();
      }
      
      else
      {
        return;
      }    
    }
    

  
    public function insertTransaction($trans_id, $fname,$lname, $amout, $email, $curr,$courses)
    {
     
    
      $sql = "INSERT INTO transactions (transaction_id, fname, lname, grand_total, currency, email,courses) VALUES (?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        
        if($stmt === false)
        {
          echo " Error ". $this->conn->error;
          exit();
        }
        if(!$stmt->bind_param('sssdsss',$trans_id, $fname, $lname, $amout,$curr,$email,$courses
        ))
        {
          echo " Error ". $this->conn->error;
          exit();
        }
        if(!$stmt->execute())
        {
          echo " Error ". $this->conn->error;
          exit();
        }
        
        else
        {
          return;
        }
      }

      public function registerAdmin($password, $admin_name)
      {
        $this->password = $password;
        $this->admin_name = $admin_name;
        $sql = "INSERT INTO admin(password, admin_name) VALUES (?,?)";
        $stmt = $this->conn->prepare($sql);
        
        if($stmt === false)
        {
          echo " Error ". $this->conn->error;
          exit();
        }
        if(!$stmt->bind_param('ss', $password, $admin_name))
        {
          echo " Error ". $this->conn->error;
          exit();
          
        }
        if(!$stmt->execute())
        {
          echo " Error ". $this->conn->error;
          exit();
        }
        
        else
        {
          echo true;
        }
      }
    
    
       public function checkIfAUserExist($admin_name){
        $this->admin_name = $admin_name;
        $sql = "SELECT *  FROM admin WHERE admin_name = ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $admin_name);
        $stmt->execute();
        $result = $stmt->get_result();    
        return $result;
      } 
      
      public  function getPaymentHistory(){
        $sql = 'SELECT * FROM transactions';
        $result = $this->conn->query($sql);
        if(mysqli_num_rows($result) > 0){
          $result = $result->fetch_all(MYSQLI_ASSOC);
        }else{
          $result = '';
        }
        return $result;
      }
  }
  

