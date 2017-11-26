<?php
session_start();
require_once '../functions.php';

if (isset($_SESSION['user'])){
    $status=$_SESSION['user'];
   
} else {
  header('location: ../index.php');  
}


if(!empty($_POST['title']) && !empty($_POST['content'])){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $start="(load)https://www.youtube.com/watch?v=";
    $end="(/load)";
    $utube= Ytube::get_string_between($content, $start, $end);
    if($utube!=0){
        
    }
    $db= new DB;
         $sql = "INSERT threads (title,content,creator_nick) VALUES ('".$title."','".$content."','".$status->nickname."')";
        
         $result=$db->connection->query($sql) or die (mysqli_error($db->connection));
         if (isset($result)){
         $_SESSION['sucalert'] = "Tread was created.";
         header('location: ../index.php');
        }else{
         $_SESSION['alert'] = "No record was made. Please contact a site administrator.";
         header('location: ../users/index.php');
                }
}
