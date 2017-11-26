<?php

class DB {
    public $connection;
    
    public function __construct() {
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        
        if($mysqli->connect_errno){
            echo $mysqli->connect_error;
        }else{
            $this->connection = $mysqli;
        }
    }
    
    public function insert_user($email,$password,$nickname)
 {
  $res = mysqli_query("INSERT users (email, password, nickname) VALUES ('$email', '$password', '$nickname')");
  return $res;
}

public function __destruct() {
        $this->connection->close();
    }
 }