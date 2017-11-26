<?php
session_start();
require_once '../functions.php';

if (isset($_SESSION['user'])){
    $status=$_SESSION['user'];
   
} else {
  header('location: ../index.php');  
}
$contforan="";
if(isset($_SESSION['anpost'])){
    $contforan=$_SESSION['anpost'];
    unset($_SESSION['anpost']);
}

if(!empty($_POST['content'])){
    $threadid = $_SESSION['act_thr'];
    $content1 = $_POST['content'];
    $content="$contforan" . "$content1";
    $db= new DB;
         $sql = "INSERT posts (content,an_creator_nick,po_thread_id) VALUES ('".$content."','".$status->nickname."','".$threadid."')";
        
         $result=$db->connection->query($sql) or die (mysqli_error($db->connection));
         if (isset($result)){
         $_SESSION['sucalert'] = "Post was created.";
         unset($_SESSION['act_thr']);
         header('location: ../index.php');
         
        }else{
         $_SESSION['alert'] = "No record was made. Please contact a site administrator.";
         unset($_SESSION['act_thr']);
         header('location: ../index.php');
         
                }
}
