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
if(!($_GET['a'])){
$_SESSION['alert']='There is a problem.';    
header('location:../index.php');    
}
$action= $_GET['a'];
if($action=='latest'){
    $final_act=1;
}elseif ($action>0) {
    $final_act=2;
    $act_post=$action;
}else{
   $_SESSION['alert']='There is a problem.';    
    header('location:../index.php'); 
}




       
?>
<meta charset="utf-8">

   
    
<div style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
	font-size: 14px;
	line-height: 1.42857143;
	color: #333;">
<?php if($final_act==1): ?>
    <!-- MAIN -->
    <?php if($thethread->num_rows>0): ?>
    <?php $row = $thethread->fetch_object(); ?>
    <?php endif; ?>
    <?php $theposthread= Posts::allidthreads("po_thread_id", "$thread_tid",'created_at',"DESC");?>
        <?php if($theposthread->num_rows>0): ?>
            <?php $rowpost=$theposthread->fetch_object() ?>
    <div class="container" style="text-align: center;">
        <?php $content=$rowpost->content;?> 
        <?php $content= Ytube::translateyoutubepost($content); ?>    
        <?php echo $content; ?>
                  
    
    </div>
          
   <?php endif; ?>
<?php endif; ?>  
<?php if($final_act==2): ?>    
    <!-- MAIN -->
    <?php if($thethread->num_rows>0): ?>
    <?php $row = $thethread->fetch_object(); ?>
    <?php endif; ?>
    <?php $theposthread= Posts::oneidpost("post_id", "$act_post");?>
        <?php if($theposthread->num_rows>0): ?>
            <?php while ($rowpost=$theposthread->fetch_object()): ?>
    <div class="container" style="text-align: center;">
        <?php $content=$rowpost->content;?> 
        <?php $content= Ytube::translateyoutubepost($content); ?>    
        <?php echo $content; ?>
                  
    
    </div>
         <?php endwhile; ?> 
   <?php endif; ?>
    
   
<?php endif; ?> 
    
 <?php //var_dump($_SESSION['act_thr']);?>    
</div>




