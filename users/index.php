

<?php

session_start();
require_once '../functions.php';

if(isset($_SESSION['alert'])){
    $alert = $_SESSION['alert'];
    unset($_SESSION['alert']);
}
if (isset($_SESSION['user'])){
    header('location: user.php');
}

?>
<html>
<head>
    
    
  
    <title>Sign Up</title>
  
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
    
</header>

    <!-- if NOT loged in -->
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
        <div class="panel-heading"><h3><p>  Currently you are Guest but soon you will be User. </p></h3>
            <h4><p>Welcome to our Forum <a href="../index.php" class="btn-info btn-sm">Home</a></p></h4></div>
            <div class="panel-body"><form action="../scripts/sign_in.php" method="post">
                <div class="form-group">
                    <input type="email" placeholder="Email" class='form-control' name="email" required>
                </div>

                <div class="form-group">
                    <input type="password" placeholder="Password" class='form-control'  name="password" required>
                </div>
                
                <div class="form-group">
                    <input type="text" placeholder="Nick Name" class='form-control' name="nickname" required>
                </div>    

                    <button type="submit" class="btn btn-primary btn-block">Sign up</button>

            </form> 
        </div>
        
        </div>
        
    </div>
   
</main>

  
<footer>
    <div class="container"></div>
</footer>
</body>
</html>

