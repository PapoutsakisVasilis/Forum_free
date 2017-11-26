


<?php

session_start();
require_once '../functions.php';

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
   
    <title>Thread Creator</title>
   
    
   
    <meta charset="utf-8">

    <meta name="keywords" content="111">
    <meta name="description" content="111">
    
    
    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-theme.css">
    <script src="../assets/js/bootstrap.js"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
    
    <script src="../assets/js/modal.js"></script>
    <script src="../assets/js/collapse.js"></script>
    <script src="../assets/js/dropdown.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/jquery-ui.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   
  
<script type="text/javascript">
         //$(document).onload(function(){ $('#youTubeform').toggle(600);});
         $(document).ready(function() {
             $('#youTubeTxtfld').css("width","350");
             $('#deployer').bind('click', function(){ 
             $('#youTube').toggle(600); 
             });
             });
    </script>
   <script type="text/javascript">
         //$(document).onload(function(){ $('#youTubeform').toggle(600);});
        $(document).ready(function() { 
            
         $('#includer').bind('click', function(){
            var content = ''; 
            var contentUT = '';
            content = tinymce.get('textarea').getContent();;
            contentUT = $('#youTubeTxtfld').val();
            contentUT = contentUT.trim();
            contentUT = contentUT.replace(/\ /g, '');
            
            
            if ((contentUT.toLowerCase().indexOf("https://www.youtube.com/") >= 0)) {
            contentUT = '(load)' + contentUT + '(/load)';
            var result = content + '<br>' + contentUT;
            //var = content+contentUT;
            tinyMCE.activeEditor.setContent(result);
            $('#youTubeTxtfld').val('');
            } else {
                alert('Sorry but its not a valid URL');
                $('#youTubeTxtfld').css('border-width','4');
                $('#youTubeTxtfld').css('border-color','blue');
                $('#includer').css('border-width','4');
                $('#includer').css('border-color','blue');
                
                }
            });
            $('#mainForm').submit(function(event){ 
                var contentUT = $('#youTubeTxtfld').val();
                
                if (contentUT.length > 0) {
                    alert('In order to use a You Tube video please press the YTube Button.')
                    event.preventDefault();
   
                    } else {
                    }
                });
            });
    </script>
    
    
    
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
                    its time to create a Thread. </p></h3>
            <h4><p>Welcome aboard. <a href="../index.php" class="btn-info btn-sm">Home</a></p></h4></div>
        </div>
            
        <div class="container">
            
               
            <p><?php echo $status->nickname;?> dont forget to fill the content-thread.</p>
            
            <h4><button id="deployer" class="btn-info btn-sm" >Use You Tube videos.</button></h4>
            <div class="container" id="youTube">
                
                    <input type="text" placeholder="URL" id="youTubeTxtfld" class='form-control' > 
                    <button id="includer" class="btn-info btn-sm" >Include YTube video.</button>
                
            </div>
            
        </div>
            <div class="panel-body">
              
                <form action="../scripts/thread_create.php" method="post" id="mainForm">
                <div class="form-group">
                    <input type="text" placeholder="Title" class='form-control' name="title" >
                      
                </div>

                <div class="form-group">
                    <textarea class='form-control' name="content" id="textarea">Content-thread.</textarea>
                    
                </div>    

                    <button type="submit" class="btn btn-primary btn-block">Create Thread</button>

            </form> 
       
            </div>
              
         </div>
       </div>
     </main> 
        

  
<footer>
    
</footer>

</body>

</html>


var i = 0;
            var contentUTtest='';
            while (i < contentUT.length) {
                contentUTtest = contentUT.replace(' ','');
                i = i + 1 ;
    
                }
            contentUT = contentUTtest;