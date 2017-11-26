<?php

session_start();
require_once '../functions.php';

$checker= 0;


if(!empty($_POST['email']) && !empty($_POST['password'])&& !empty($_POST['nickname'])){
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $nickname =$_POST['nickname'];
    $nickname= str_replace(' ', '_', $nickname);
    } else {
        $checker=2;
        
        header('location: ../users/index.php');
} 

$nick= Users::nicknameInput("nickname","$nickname");
$pass= Users::nicknameInput("email","$email");
if($nick == 1){
        $_SESSION['alert']= 'Please change your nick-name because its already in use.';
        $checker=1;
        header('location: ../users/index.php');
            
 } 
 if($pass == 1){
        $_SESSION['alert']= 'Please change your E-mail because its already in use.';
        $checker=1;
        header('location: ../users/index.php');
            
 }

 switch ($checker) {
     case 1:
         header('location: ../users/index.php');
         
         break;
     case 2:
         $_SESSION['alert'] = "Please fill all fields";
         header('location: ../users/index.php');

         break;

     default:
         $db= new DB;
         $sql = "INSERT users (email,password,nickname) VALUES ('".$email."','".$password."','".$nickname."')";
        
         $result=$db->connection->query($sql) or die (mysqli_error($db->connection));
         if (isset($result)){
         $_SESSION['alert'] = "Record ok";
         header('location: ../index.php');
        }else{
         $_SESSION['alert'] = "No record was made. Please contact a site administrator.";
         header('location: ../users/index.php');
                }      
         break;
 }



   
        
   
  
   


    