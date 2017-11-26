
<?php
session_start();
require_once '../functions.php';

if (isset($_SESSION['user'])){
    $status=$_SESSION['user'];
   
} else {
  header('location: ../index.php');  
}
if (isset($_SESSION['act_thr'])){
    $act_thr=$_SESSION['act_thr'];
    $thethread= Threads::id($act_thr);
    $conThethread=$thethread->fetch_object();
   
} else {
    $_SESSION['alert']='Contact Admin Please.';
  header('location: ../index.php');  
}
if(!empty($_POST['title'])){
   $title = $_POST['title']; 
}else{
    $title= $conThethread->title;
}
if(!empty($_POST['content'])){
   $content = $_POST['content']; 
}else{
    $content= $conThethread->content;
}
if(!empty($title) && !empty($content)){
 $collumn_title='title';   
 $collumn_content='content';
 $collumn_crnick='creator_nick';
 $change_nick =$status->nickname;
 $column='thread_id';        
    $db= new DB;
         $sql = "UPDATE threads SET $collumn_title='$title',$collumn_content='$content',$collumn_crnick='$change_nick' WHERE $column='$act_thr' ";
         $result=$db->connection->query($sql) or die (mysqli_error($db->connection));
         if (isset($result)){
         $_SESSION['sucalert'] = "Thread was updated.";
         header('location: ../index.php');
        }else{
         $_SESSION['alert'] = "No record was made. Please contact a site administrator.";
         header('location: ../users/index.php');
                }
}
