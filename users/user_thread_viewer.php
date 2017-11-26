
<?php

require_once '../functions.php';

session_start();
if(isset($_SESSION['act_thr'])){
    unset($_SESSION['act_thr']);
}
if(isset($_SESSION['user'])){
    $status = $_SESSION['user'];
    
    
} else {
    $_SESSION['alert']= 'First Log In';
    header('location:../index.php');
}

if(isset($_SESSION['alert'])){
    $alert = $_SESSION['alert'];
    unset($_SESSION['alert']);
}
if(isset($_SESSION['sucalert'])){
    $sucalert = $_SESSION['sucalert'];
    unset($_SESSION['sucalert']);
}



$threadsnick= Threads::allthreads('creator_nick', "$status->nickname",'created_at',"DESC");

       
?>
<html>
<head>
    <title>User Threads</title>
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
                    welcome to your thread portofolio. </p></h3>
            <h4><p>Welcome aboard. <a href="../index.php" class="btn-info btn-sm">Home</a></p></h4></div>
        </div>
        <div class="panel-body">
            <h2><a href="../users/user.php" class="btn-info btn-sm">User Infos</a>
                
                <a href="../users/image_user.php" class="btn-info btn-sm">Image</a></h2>
        </div>
    </div>
       
    </div>  
    
    
    <!-- MAIN -->
   <?php if($threadsnick->num_rows > 0): ?>
    <?php while($row = $threadsnick->fetch_object()): ?>
    
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
        
        
        <div class="col-xs-6 col-md-4" style=""><div class="well well-sm"><h4 style="text-align:center;">Posts <?php $posthread= Posts::allidthreads("po_thread_id", "$row->thread_id");?> 
                  <?php echo "$posthread->num_rows" ?></h4></div>
            <?php if ($posthread->num_rows >0):?>
            <div class="well well-sm"><h4><p style="text-align:center;">Latest Post </h4><?php $posthread= Posts::allidthreads('po_thread_id', "$row->thread_id",'created_at',"DESC");?> 
                  <?php $rowpost=$posthread->fetch_object();?>
                <h5 style="text-align:center;"><?php echo $rowpost->content; ?></h5></p></div><p style="text-align:center;"><a href="../posts/index.php?t=<?php echo $row->thread_id;?>" class="btn-primary btn-lg">New Post</a>  
                    <a href="../threads/thread_edit.php?t=<?php echo $row->thread_id;?>"  class="btn-primary btn-lg" >Thread Edit</a></p>
                    
                  
            <?php else:?>
            <div class="well well-sm"><h4><p style="text-align:center;">Latest Post </h4>
                  <h5 style="text-align:center;">No Posts in this Tread yet</h5></p></div>
                  <p style="text-align:center;"><a href="../posts/index.php?t=<?php echo $row->thread_id;?>" class="btn-primary btn-lg">Create a Post</a>
                      <a href="../threads/thread_edit.php?t=<?php echo $row->thread_id;?>"  class="btn-primary btn-lg" >Thread Edit</a></p>
                  
            <?php endif; ?>
        </div>
  </div>
            
        </div>
    
</div>
    <?php endwhile ?>
    <?php else :?>
    <div class="container">
        <div class="well well-lg">
            <h3 style="text-align:center;">YOU HAVE NO THREADS YET CREATED!!!</h3> 
        </div>
         </div>
        <?php endif ?>
    
 <?php// var_dump($_SESSION['act_thr']);?>
</main>

<footer>
    <div class="container"></div>
</footer>
</body>
</html>






