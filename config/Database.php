<?php

class Database{
  public $conn;
  public function __construct(){
    $this->conn = new mysqli("127.0.0.1", "root", "", "ispaceshopping");
    
    if($this->conn->connect_error)
    {
       
        exit("Connection fails ".$this->conn->connect_error);
    }else{
    
       return true;
    }
  }
}

session_start();
