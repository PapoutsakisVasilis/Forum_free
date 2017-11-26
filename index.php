<?php

require_once 'functions.php';

session_start();
if(isset($_SESSION['act_thr'])){
    unset($_SESSION['act_thr']);
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
    
}
if(isset($front)){
    unset($front);
    unset($choice_fp);
}
$id=1;
$front= Admin::findFp("$id");
$choice_fp= $front->choice;
unset($front);


?>

<html>
<head>
    <title>Forum</title>
    <meta charset="utf-8">

   
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/bootstrap-theme.css">
    
    <script src="assets/js/bootstrap.js"></script>
    
    
    <script src="assets/js/modal.js"></script>
    <script src="assets/js/collapse.js"></script>
    <script src="assets/js/dropdown.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    

    
    
    
    
</head>

<body>
<div id="fb-root"></div>
<div id="fb-root"></div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8&appId=";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>    
<!-- Header -->
<header>

</header>

<main>
    
   <?php if($choice_fp>0): ?>
    <!-- if fp 1 -->
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
    
    <?php if(isset($status)): ?>
    <div class="container">
    <div class="panel panel-primary">
        <div class="well well-sm">
            <div class="media">
                <div class="media-left">
                    <img src="assets/images/logo.png" class="media-object" style="width:60px">
                </div>
     <div class="media-body">
         <h4 class="media-heading">Forum Creations By Freedom</h4>
        <p></p>
    </div>
            </div>
        </div>   
        <div class="panel-heading"><h3><img src="assets/images/users/<?PHP echo $status->image_user?>"  style="width:60px"><?php echo " You are currently loged in as $status->nickname" ?></h3></div>
        <div class="panel-body"><?php if(($status->rank)==1): ?>
            <a href="admin/index.php" class="btn-primary btn-lg">Admin Panel</a>
                                <?php endif; ?>
                <a href="threads/thread_creator.php" class="btn-primary btn-lg">New Thread</a>
            <a href="users/user.php" class="btn-primary btn-lg">User Options</a>
            <a href="scripts/logout.php" class="btn-primary btn-lg">Log Out</a>
        </div>
    </div>
       
    </div>  
    <?php else : ?>
    <!-- if NOT loged in -->
    <div class="container">
    <div class="panel panel-primary">
        <div class="well well-sm">
            <div class="media">
                <div class="media-left">
                    <img src="assets/images/logo.png" class="media-object" style="width:60px">
                </div>
     <div class="media-body">
        <h4 class="media-heading">Forum Creations By Freedom</h4>
        <p>Fighter</p>
    </div>
            </div>
        </div>
        <div class="panel-heading"><h3><p>  Currently you are Guest, if you want to post please log in. </p></h3>
            <h4><p>If dont have an account Please <a href="users/index.php" class="btn-info btn-sm">Sign up</a></p></h4></div>
        <div class="panel-body"><form action="scripts/check_login.php" method="post">
                <div class="form-group">
                    <input type="email" placeholder="Email" class='form-control' name="email" required>
                </div>

                <div class="form-group">
                    <input type="password" placeholder="Password" class='form-control' name="password" required>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Log in</button>

            </form> 
        </div>
        
        </div>
        </div>
        <?php endif; ?>
    
    <!-- MAIN -->
    <?php if($thread_all->num_rows>0): ?>
    <?php while($row = $thread_all->fetch_object()): ?>
    <div class="container table-responsive">
       <table class="table table-striped table-hover">
           <?php $imguserthread=Users::findBythread("nickname", $row->creator_nick)?>
           <?php $posthread= Posts::allidthreads('po_thread_id', "$row->thread_id",'created_at',"DESC");?>
    <thead>
      <tr>
        <th style="width: 60%; max-height: 80px; text-align: left;"><div class="media">
  <div class="media-left">
       <img src="assets/images/users/<?php echo $imguserthread->image_user;?>" class="media-object" style="width:30px; height:30px;">
       
  </div>
    <div class="media-body" style=" font-size: 10;">
    <?php echo $row->creator_nick ?>
    <p><?php echo $row->created_at ?></p>
  </div>
</div>
 </th>
        <th style="width: 30%; text-align: center;">Latest Post</th>
        <th style="width: 10%; text-align: center;">Posts</th>
        
      </tr>
    </thead>
    <tbody>
      <tr>
          <td style="max-height:72px; width: 60%;"><div class="media">
  <div class="media-left" style="width: 73px;">
    <img src="assets/images/threads/<?php echo $row->image_thread;?>" class="media-object" style="width:72px; height:72px;">
    <div class="fb-like" data-href="http://forum_f/threads/index.php?t=<?php echo $row->thread_id;?>" 
         data-layout="box_count" data-action="like" data-size="large" data-show-faces="false" 
         data-share="true" style="padding-left: 5px; padding-top: 2px;">
    </div>
  </div>
                  
                  <div class="media-body" style="max-width: 650px;">
    <h5 class="media-heading"><a href="threads/index.php?t=<?php echo $row->thread_id;?>" class=""><?php echo $row->title ?></a></h5>
    <p><h6> <iframe style="border:none; overflow: hidden;" src="threads/sh_di_index.php?t=<?php echo $row->thread_id;?>"width="600" height="150"></iframe> </h6></p>
  </div>
</div></td>
<td style=" text-align:center; width: 30%; max-height: 150px;"><?php if ($posthread->num_rows >0):?><?php $rowpost=$posthread->fetch_object();?>
    <h6 style= "font-size: 10;"><p><?php echo $rowpost->created_at; ?></p></h6>
    <br>
    <iframe style="border:none; overflow: hidden;" src="posts/latest_post_viewer.php?t=<?php echo $row->thread_id;?>&a=latest"width="316" height="150"></iframe>
        <?php else:?>
        <h5 style=" text-align:center;">No Posts in this Tread yet</h5>    
        <?php endif; ?>    
        </td>
        <td style="text-align:center; " ><p><div class="well"><?php echo "$posthread->num_rows" ?></div></p></td>
        
      </tr>
      
    </tbody>
  </table> 
    </div>
    

            
    
    <?php endwhile ?>
    <?php endif ?>

<?php else : ?>
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
    
    <?php if(isset($status)): ?>
    <div class="container">
    <div class="panel panel-primary">
        <div class="well well-sm">
            <div class="media">
                <div class="media-left">
                    <img src="assets/images/logo.png" class="media-object" style="width:60px">
                </div>
     <div class="media-body">
        <h4 class="media-heading">Forum Creations By Freedom</h4>
        <p></p>
    </div>
            </div>
        </div>   
        <div class="panel-heading"><h3><img src="assets/images/users/<?PHP echo $status->image_user?>"  style="width:60px"><?php echo " You are currently loged in as $status->nickname" ?></h3></div>
        <div class="panel-body"><?php if(($status->rank)==1): ?>
            <a href="admin/index.php" class="btn-primary btn-lg">Admin Panel</a>
                                <?php endif; ?>
                <a href="threads/thread_creator.php" class="btn-primary btn-lg">New Thread</a>
            <a href="users/user.php" class="btn-primary btn-lg">User Options</a>
            <a href="scripts/logout.php" class="btn-primary btn-lg">Log Out</a>
        </div>
    </div>
       
    </div>  
    <?php else : ?>
    <!-- if NOT loged in -->
    <div class="container">
    <div class="panel panel-primary">
        <div class="well well-sm">
            <div class="media">
                <div class="media-left">
                    <img src="assets/images/logo.png" class="media-object" style="width:60px">
                </div>
     <div class="media-body">
        <h4 class="media-heading">Forum Creations By Freedom</h4>
        <p>Fighter</p>
    </div>
            </div>
        </div>
        <div class="panel-heading"><h3><p>  Currently you are Guest, if you want to post please log in. </p></h3>
            <h4><p>If dont have an account Please <a href="users/index.php" class="btn-info btn-sm">Sign up</a></p></h4></div>
        <div class="panel-body"><form action="scripts/check_login.php" method="post">
                <div class="form-group">
                    <input type="email" placeholder="Email" class='form-control' name="email" required>
                </div>

                <div class="form-group">
                    <input type="password" placeholder="Password" class='form-control' name="password" required>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Log in</button>

            </form> 
        </div>
        
        </div>
        <?php endif; ?>
    </div>
    <!-- MAIN -->
    <?php if($thread_all->num_rows>0): ?>
    <?php while($row = $thread_all->fetch_object()): ?>
    
<div class="container">
    <div class="well well-lg">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-8">
            <div class="well well-sm">
                <div class="media">
                <div class="media-left">
                    <?php $imguserthread=Users::findBythread("nickname", $row->creator_nick)?>
                    
                    <img src="assets/images/users/<?php echo $imguserthread->image_user;?>" class="media-object" style="width:70px; height:70px;">
                    <img src="assets/images/threads/<?php echo $row->image_thread;?>" class="media-object" style="width:70px; height:70px;">
                    
                </div>
                <div class="media-body">
                    <p style="text-align:left;">Created By <?php echo $row->creator_nick ?></p>
                  <?php echo $row->created_at ?>
                    <h4 class="media-heading"><br>TITLE <br> <a href="threads/index.php?t=<?php echo $row->thread_id;?>" class=""><?php echo $row->title ?></a><br><br></h4>
                  
                    <p><div style="max-width: 485px;"><iframe style="border:none; overflow: hidden;" src="threads/sh_di_index.php?t=<?php echo $row->thread_id;?>"width="650" height="150"></iframe></div></p>
                  
                </div>
                </div>
            </div>
            
        </div>
        
        <div class="col-xs-6 col-md-4"><div class="well well-sm"><h4><p style="text-align:center;">Posts <?php $posthread= Posts::allidthreads("po_thread_id", "$row->thread_id");?> 
                  <?php echo "$posthread->num_rows" ?></p></h4></div>
            <?php if ($posthread->num_rows >0):?>
            <div class="well well-sm" ><h4><p style="text-align:center;">Latest Post </h4><?php $posthread= Posts::allidthreads('po_thread_id', "$row->thread_id",'created_at',"DESC");?> 
                  <?php $rowpost=$posthread->fetch_object();?>
                  <h5 style="text-align:center;"><iframe style="border:none; overflow: hidden;" src="posts/latest_post_viewer.php?t=<?php echo $row->thread_id;?>&a=latest" width="316" height="150"></iframe></h5></p></div>
                  <p style="text-align:center;"><a href="posts/index.php?t=<?php echo $row->thread_id;?>" class="btn-primary btn-lg">New Post</a></p>
            <?php else:?>
            <div class="well well-sm"><h4><p style="text-align:center;">Latest Post </h4>
                  <h5 style="text-align:center;">No Posts in this Tread yet</h5></p></div>
                  <p style="text-align:center;"><a href="posts/index.php?t=<?php echo $row->thread_id;?>" class="btn-default btn-lg">Create a Post</a></p>
            <?php endif; ?>
        </div>
  
    </div>
    </div>
</div>
            
    
    <?php endwhile ?>
    <?php endif ?>
   
<?php endif; ?>   
</main>


<footer>
    <div class="container"></div>
</footer>
</body>
</html>




