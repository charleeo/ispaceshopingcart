<?php

class Database{
  public $conn;
  public function __construct(){
    // $this->conn = new mysqli("localhost", "root", "linux", "moodle");
    // $this->conn = new mysqli("localhost", "root", "", "ispaceshopping");
    
    if($this->conn->connect_error)
    {
       
        exit("Connection fails ".$this->conn->connect_error);
    }else{
    
       return true;
    }
  }
}

session_start();
