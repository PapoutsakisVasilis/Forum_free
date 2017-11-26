
<?php

session_start();
require_once '../functions.php';
if(isset($_SESSION['act_thr'])){
    unset($_SESSION['act_thr']);
}

if(isset($_SESSION['alert'])){
    $alert = $_SESSION['alert'];
    unset($_SESSION['alert']);
}
if(isset($_SESSION['sucalert'])){
    $sucalert = $_SESSION['sucalert'];
    unset($_SESSION['sucalert']);
    
}
if (isset($_SESSION['user'])){
    $status=$_SESSION['user'];
} else {
  header('location: index.php');  
}

?>
<html>
<head>
    <?php header("Refresh");?>
    <title>Image User</title>
   
   
   
    <meta charset="utf-8">

    <meta name="keywords" content="111">
    <meta name="description" content="111">
    
    
    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-theme.css">
    <script src="../assets/js/bootstrap.js"></script>
    
    
    <script src="../assets/js/modal.js"></script>
    <script src="../assets/js/collapse.js"></script>
    <script src="../assets/js/dropdown.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/jquery-ui.min.js"></script>
    
    
    
    
    
</head>
<body>
<!-- Header -->
<header>
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
    
</header>
     
     <main> 
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
            
        <div class="container">
            <h2><a href="user.php" class="btn-info btn-sm">User Infos</a>  
                
            <a href="user_thread_viewer.php" class="btn-info btn-sm">User Threads</a></h2>
            <p>User icon set.</p>

            <div class="panel-body">
                <form action="../scripts/user_upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form> 
        </div>
              </div>
         </div>
       </div>
     </main> 
        

  
<footer>
    <div class="container"></div>
</footer>
</body>
</html>


