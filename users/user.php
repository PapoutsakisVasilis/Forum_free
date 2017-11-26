


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
  header('location: ../index.php');  
}

?>
<html>
<head>
   <?php header("Refresh");?>
    <title>User Interface</title>
   
    
   
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
                <a href="user_thread_viewer.php" class="btn-info btn-sm">User Threads</a>
                <a href="image_user.php" class="btn-info btn-sm">Image</a></h2>
            <p>Please choose only what infos you want to change.</p>

            <div class="panel-body">
                <form action="../scripts/user_update.php" method="post">
                <div class="form-group">
                    <input type="email" placeholder="Email" class='form-control' name="email" >
                </div>

                <div class="form-group">
                    <input type="password" placeholder="Password" class='form-control'  name="password" >
                </div>
                
                <div class="form-group">
                    <input type="text" placeholder="Nick Name" class='form-control' name="nickname" >
                </div>    

                    <button type="submit" class="btn btn-primary btn-block">Update Infos</button>

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


