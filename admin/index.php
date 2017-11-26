<?php

require_once '../functions.php';

session_start();
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

if(isset($_SESSION['user'])){
    $status=$_SESSION['user'];
    if($status->rank==1){
       
    } else {
    header('location: ../index.php');    
    }
} else{
    $_SESSION['alert'] = 'First Log In';
    header('location: ../index.php');
}
$users= Users::all();
$threads= Threads::all();
?>

<html>
<head>
   <?php header("Refresh");?>
    <title>Admin CP</title>
   
    
   
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
                    Welcome to the Admin Control Panel. </p></h3>
            <h4><p>Welcome aboard. <a href="../index.php" class="btn-info btn-sm">Home</a></p></h4></div>
        </div>
           <div class="panel panel-info">
                <div class="panel-heading"><h4>USERS REGISTRY</h4></div>
                <div class="panel-body" style="max-height:300px; overflow-y:auto;">
                    
                    <ul class="list-group">
                        
                        <li class="list-group-item list-group-item-info"> 
                            <div class="table-responsive">          
                                <table class="table" style="text-align: center">
                                  <thead style="text-align: center">
                                    <tr>
                                      <th style="text-align: center">NICKNAME</th>
                                      <th style="text-align: center">CREATED AT</th>
                                      <th style="text-align: center">DEACTIVATION</th>
                                      <th style="text-align: center">USER UPGRADE</th>
 
                                    </tr>
                                  </thead>
                                  <?php while($row_user = $users->fetch_object()): ?>
                                  <tbody>
                                    <tr>
                                      <td><h4><?php echo "$row_user->nickname";?></h4></td>
                                      <td><h4><?php echo "$row_user->created_at";?></h4></td>
                                      <?php if($row_user->rank==100): ?>
                                      <td>
                                          <form action="../scripts/admin_prosedures.php" method="post">
                                              <input type="hidden" name="id" value="<?php echo $row_user->id;?>">
                                              <button type="submit" class="btn btn-primary btn-danger" name="submitact">Activate User</button>
                                          </form>
                                      </td>
                                      <?php elseif($row_user->rank==1): ?>
                                      <td>
                                          <form action="../scripts/admin_prosedures.php" method="post">
                                              <input type="hidden" name="id" value="<?php echo $row_user->id;?>">
                                              <button type="submit" class="btn btn-primary btn-info" name="submitunp">Unpromote User</button>
                                          </form>
                                      </td>
                                      <?php else: ?>
                                      <td>
                                          <form action="../scripts/admin_prosedures.php" method="post">
                                              <input type="hidden" name="id" value="<?php echo $row_user->id;?>">
                                              <button type="submit" class="btn btn-primary btn-info" name="submitdea">Diactivate User</button>
                                          </form>
                                      </td>    
                                      <?php endif; ?>   
                                      <?php if($row_user->rank==0): ?>
                                      <td>
                                          <form action="../scripts/admin_prosedures.php" method="post">
                                              <input type="hidden" name="id" value="<?php echo $row_user->id;?>">
                                              <button type="submit" class="btn btn-primary btn-info" name="submitpro">promote User</button>
                                          </form>
                                      </td>
                                      <?php elseif($row_user->rank==1): ?>
                                      <td>
                                              <button type="" class="btn btn-primary btn-success" name="">ADMIN</button>
                                      </td>
                                      <?php else: ?>
                                      <td>
                                              <button type="" class="btn btn-primary btn-danger" name="">DEACTIVATED</button>
                                      </td>
                                           
                                      <?php endif; ?>
                                    </tr>
                                  </tbody>
                                  <?php endwhile; ?>
                                </table>
                            </div>
                            
                     
                        </li>
                        
                    </ul>
                    
                </div>
           </div>
        <p></p>
        <br>
           <div class="panel panel-info">
               <div class="panel-heading"><h4>THREADS REGISTRY</h4></div>
                <div class="panel-body" style="max-height:300px; overflow-y:auto;">
                    
                    <ul class="list-group">
                        
                        <li class="list-group-item list-group-item-info"> 
                            <div class="table-responsive">          
                                <table class="table" style="text-align: center">
                                  <thead style="text-align: center">
                                    <tr style="text-align: center">
                                      <th style="text-align: center">TITLE</th>
                                      <th style="text-align: center">CREATED AT</th>
                                      <th style="text-align: center">DELETE</th>

                                    </tr>
                                  </thead>
                                  <?php while($row_thread = $threads->fetch_object()): ?>
                                  <tbody>
                                    <tr>
                                      <td><h4><?php echo "$row_thread->title"; ?></h4></td>
                                      <td><h4><?php echo "$row_thread->created_at"; ?></h4></td>
                                      <td>
                                          <form action="../scripts/admin_prosedures.php" method="post">
                                              <input type="hidden" name="id" value="<?php echo $row_thread->thread_id;?>">
                                              <button type="submit" class="btn btn-primary btn-info" name="submit_th_del">Delete Thread</button>
                                          </form>
                                      </td>
                                    </tr>
                                  </tbody>
                                  <?php endwhile; ?>
                                </table>
                            </div>
                            
                     
                        </li>
                        
                    </ul>
                    
                </div>
           </div>
        
         </div>
       </div>
     </main> 
        

  
<footer>
    <div class="container" style="text-align: center"><div class="panel panel-default">
  <div class="panel-heading">FORUM DISPLAY OPTIONS</div>
  <div class="panel-body"><form action="../scripts/admin_prosedures.php" method="post">
                                                <input type="radio" name="fre" value='0'>Well Display     <br>
                                                <input type="radio" name="fre" value='1'>Table Display<br>
                                               <button type="submit" class="btn btn-primary btn-info" name="submitfre">Submit</button>
                                          </form></div>
</div></div>
</footer>
</body>
</html>




