<?php

require_once '../functions.php';

session_start();
if(isset($_SESSION['act_thr'])){
    unset($_SESSION['act_thr']);
}
if(!($_GET['t'])){
$_SESSION['alert']='There is a problem.';    
header('location:../index.php');    
}
$thread_tid= $_GET['t'];

$thethread= Threads::id($thread_tid);
if($thethread->num_rows==0){
    echo 'There is no such a Thread.';
} else {
    $_SESSION['act_thr'] = $thread_tid;
}
$thread_all= Threads::all();




       
?>
<meta charset="utf-8">

   
    
<div style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
	font-size: 14px;
	line-height: 1.42857143;
        color: #333;">
    <!-- MAIN -->
    <?php if($thethread->num_rows>0): ?>
    <?php while($row = $thethread->fetch_object()): ?>
    
<div class="container">
        <?php $content=$row->content;?> 
        <?php $content= Ytube::translateyoutube($content); ?>    
        <?php echo $content; ?>
                  
    
</div>
           
    <?php endwhile ?>
  
    
    <?php endif; ?>
   
 
 <?php //var_dump($_SESSION['act_thr']);?>    
</div>




