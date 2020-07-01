<?php

class Database2{
  public $conn;
  public function __construct(){
    $this->conn = new mysqli("172.104.239.222", "root", "linux", "ispacedb");
    
    if($this->conn->connect_error)
    {
       
        exit("Connection fails ".$this->conn->connect_error);
    }else{
      echo "Connected";
       return true;
    }
  }
}
$database2 = new Database2();

session_start();
