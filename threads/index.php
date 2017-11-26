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
    header('location:../index.php');
} else {
    $_SESSION['act_thr'] = $thread_tid;
}
$thread_all= Threads::all();



if(isset($_SESSION['alert'])){
    $alert = $_SESSION['alert'];
    unset($_SESSION['alert']);
}
if(isset($_SESSION['sucalert'])){
    $sucalert = $_SESSION['sucalert'];
    unset($_SESSION['sucalert']);
}
if(isset($_SESSION['user'])){
    $status = $_SESSION['user'];
    
} else {
    $_SESSION['alert']= 'First Log In';
    header('location:../index.php');
}
       
?>
<html>
<head>
    <title>Thread Viewer</title>
    <meta charset="utf-8">

    <meta name="keywords" content="11">
    <meta name="description" content="11">
    
    
    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-theme.css">
    <script src="../assets/js/bootstrap.js"></script>
    
    
    <script src="../assets/js/modal.js"></script>
    <script src="../assets/js/collapse.js"></script>
    <script src="../assets/js/dropdown.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/jquery-ui.min.js"></script>
    <script>
  function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }
    </script>
    
    
    
    
</head>
<body>
<!-- Header -->
<header>

</header>

<main>
    <?php if(isset($alert)): ?>
        <div class="alert alert-warning">
            <?php echo $alert; ?>
        </div>
            <?php endif; ?>
     <?php if(isset($sucalert)): ?>
        <div class="alert alert-success">
            <?php echo $sucalert; ?>
        </div>
            <?php endif; ?>
    
    <!-- if loged in -->
    
   
    <div class="container">
    <div class="panel panel-primary">
        <div class="well well-sm">
            <div class="media">
                <div class="media-left">
                    <img src="../assets/images/logo.png" class="media-object" style="width:60px">
                </div>
     <div class="media-body">
        <h4 class="media-heading">Forum Creations By Freedom</h4>
        <p></p>
    </div>
            </div>
        </div>   
        <div class="panel-heading">
            <div class="panel-heading">
            <h3><p><img src="../assets/images/users/<?PHP echo $status->image_user;?>"  style="width:60px">  Dear <?php echo $status->nickname;?>
                    welcome to the user options page. </p></h3>
            <h4><p>Welcome aboard. <a href="../index.php" class="btn-info btn-sm">Home</a></p></h4></div>
        </div>
        <div class="panel-body">
                
            
       
            </div>
    </div>
       
    </div>  
    
    
    <!-- MAIN -->
    <?php if($thethread->num_rows>0): ?>
    <?php while($row = $thethread->fetch_object()): ?>
    
<div class="container">
    <div class="well well-lg">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-8">
            <div class="well well-sm">
                <div class="media">
                <div class="media-left">
                    <?php $imguserthread=Users::findBythread("nickname", $row->creator_nick)?>
                    
                    <img src="../assets/images/users/<?php echo $imguserthread->image_user;?>" class="media-object" style="width:70px">
                    <img src="../assets/images/threads/<?php echo $row->image_thread;?>" class="media-object" style="width:70px">
                    
                </div>
                <div class="media-body">
                    <p style="text-align:left;">Created By <?php echo $row->creator_nick ?></p>
                  <?php echo $row->created_at ?>
                  <h4 class="media-heading"><br>TITLE <br> <?php echo $row->title ?><br><br></h4>
                  
                  <p><iframe style="border:none; overflow: hidden;" src="../threads/sh_di_index.php?t=<?php echo $row->thread_id;?>"frameborder="0" scrolling="no" onload="resizeIframe(this)"width="650"></iframe></p>
                  
                </div>
                </div>
            </div>
            
        </div>
        
        <div class="col-xs-6 col-md-4">
            <div class="well well-sm"><h4><p style="text-align:center;">Posts <?php $posthread= Posts::allidthreads("po_thread_id", "$row->thread_id");?> 
                  <?php echo "$posthread->num_rows" ?></p></h4>
            </div>
            <?php if ($posthread->num_rows >0):?>
            <div class="well well-sm"><h4><p style="text-align:center;">Latest Post </h4><?php $posthread= Posts::allidthreads('po_thread_id', "$row->thread_id",'created_at',"DESC");?> 
                  <?php $rowpost=$posthread->fetch_object();?>
                  <h5 style="text-align:center;"><iframe style="border:none; overflow: hidden;" src="../posts/latest_post_viewer.php?t=<?php echo $row->thread_id;?>&a=latest"width="316" height="150"></iframe></h5></p></div><p style="text-align:center;"><a href="../posts/index.php?t=<?php echo $row->thread_id;?>" class="btn-primary btn-lg">New Post</a></p>
                  
            <?php else:?>
            <div class="well well-sm"><h4><p style="text-align:center;">Latest Post </h4>
                  <h5 style="text-align:center;">No Posts in this Thread yet</h5></p></div><p style="text-align:center;"><a href="../posts/index.php?t=<?php echo $row->thread_id;?>" class="btn-primary btn-lg">Create a Post</a></p>
                  
            <?php endif; ?>
        </div>
  
    </div>
    </div>
    </div>
    
    
                   
    <?php endwhile ?>
    <?php endif ?>
    <?php $thethread= Threads::id($thread_tid);
          $row = $thethread->fetch_object()  ;?>
    <?php if($thethread->num_rows>0): ?>
    <?php $theposthread= Posts::allidthreads("po_thread_id", "$thread_tid",'created_at',"DESC");?>
        <?php if($theposthread->num_rows>0): ?>
            <?php while( $rowpost=$theposthread->fetch_object()): ?>
            <?php $cr_post= Users::findBythread('nickname', $rowpost->an_creator_nick)?>
    <div class="container">
    <div class="panel panel-default">
  <div class="panel-heading"><img src="../assets/images/users/<?php echo $cr_post->image_user;?>" class="media-object" style="width:70px">
                    <p style="text-align:left;">Created By <?php echo $cr_post->nickname ?></p><?php echo $rowpost->created_at ?>
                                          <form action="../posts/index.php?t=<?php echo $row->thread_id;?>" method="post">
                                              <input type="hidden" name="id" value="<?php echo $rowpost->post_id;?>">
                                              <button type="submit" class="btn btn-primary btn-danger" name="submit_poid">Answer</button>
                                          </form>
                    </div>
                <div class="panel-body">
                    <div class="media-left">
                    
                    <div class="container" style="padding-left:250px">
                    <div class="col-xs-6">
                        <h5> <iframe style="border:none; overflow: hidden;" src="../posts/latest_post_viewer.php?t=<?php echo $row->thread_id;?>&a=<?php echo $rowpost->post_id;?>" width="316" height="150"></iframe></h5></div></div></div>
                </div>
                </div>
    </div>
    <?php endwhile ?>
    <?php else:?>
    
    <?php endif; ?>

<?php else:?>  
    
<?php endif; ?>   

    
    
 
 <?php //var_dump($_SESSION['act_thr']);?>    
</main>

<footer>
    <div class="container"></div>
</footer>
</body>
</html>




