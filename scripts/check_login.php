<?php

session_start();
require_once '../functions.php';



if(!empty($_POST['email']) && !empty($_POST['password'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    
    $db = new DB;
    
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
    
    $result = $db->connection->query($sql);
    
    
    if($result->num_rows > 0){
        //$nickname = $result->fetch_object('nickname');
        $rankchecker = $result->fetch_object();
        if($rankchecker->rank == 100){
            $_SESSION['alert'] = 'User with current credentials is deactivated';
            header('location: ../index.php');
            } else {
                unset($_SESSION['user']);
            $_SESSION['user'] = $rankchecker;
            header('location: ../index.php');
                } 
    }else {
            $_SESSION['alert'] = 'User with current credentials does not exist';
            header('location: ../index.php');
                }
        
    
}else{
    $_SESSION['alert'] = 'Please fill all fields';
    header('location: ../index.php'); 
}
