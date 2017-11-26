<?php
session_start();
require_once '../functions.php';

if (isset($_SESSION['user'])){
    $status= $_SESSION['user'];
    
   } else {
       $_SESSION['alert'] = 'First Log In';
  header('location: ../../index.php');  
}
$checker= 0;
if(empty($_POST['email'])){
    
    } else {
       $email=$_POST['email'];
       $pass= Users::nicknameInput("email","$email");
       if($pass == 1){
        $_SESSION['alert']= 'Please change your E-mail because its already in use.';
        $checker=1;
        
            }
}

if(empty($_POST['password'])){
    
    } else {
       $password=md5($_POST['password']); 
}

if(empty($_POST['nickname'])){
    
   
    } else {
       $nickname =$_POST['nickname'];
       $nickname= str_replace(' ', '_', $nickname);
       
       $nick= Users::nicknameInput("nickname","$nickname");
       if($nick == 1){
        $_SESSION['alert']= 'Please change your nick-name because its already in use.';
        $checker=2;
        
        
       }
}

 switch ($checker) {
     case 1:
         header('location: ../users/user.php');
         
         break;
     case 2:
         
         header('location: ../users/user.php');

         break;

     default:
         unset($_SESSION['sucalert']);
         if(isset($email)){
            $result_email= Users::user_update('email', $email, 'id', $status->id);
            if (isset($result_email)){
            $_SESSION['sucalert'] = "Email was changed. ";
            }else{
            $_SESSION['alert'] = "No change was made. Please contact a site administrator.";
            header('location: ../users/user.php');
                    break;
                 }
           }
           
          if(isset($password)){
            
            $result_pass= Users::user_update('password', $password, 'id', $status->id);
            if (isset($result_pass)){
            $_SESSION['sucalert'] = $_SESSION['sucalert'] . "Password was changed. ";
            }else{
            $_SESSION['alert'] = "No change was made. Please contact a site administrator.";
            header('location: ../users/user.php');
                    break;
                 }
           } 
          
          if(isset($nickname)){
            
            $result_nick= Users::user_update('nickname', $nickname, 'id', $status->id);
            $result_nick_threads= Threads::allthreads_update('creator_nick',$status->nickname,'creator_nick',$nickname);
            $result_nick_posts= Posts::allposts_update('an_creator_nick', $status->nickname, 'an_creator_nick', $nickname);
            $rest = substr("$status->image_user",-4);
            $final_file=$nickname . $rest;
            if (isset($result_nick)&& $result_nick_threads<2&& $result_nick_posts<2){
                if($status->image_user=='user_default.png'){
                 $_SESSION['sucalert'] = $_SESSION['sucalert'] . "Nick-Name was changed. ";   
                } else {
                 rename("../assets/images/users/$status->image_user","../assets/images/users/$final_file");
                 $img_user= Users::user_update('image_user', $final_file, 'id', $status->id);
                 $_SESSION['sucalert'] = $_SESSION['sucalert'] . "Nick-Name was changed and all records updated.";
                }
            
            }else{
            $_SESSION['alert'] = "No change was made. Please contact a site administrator.";
            header('location: ../users/user.php');
                    break;
                 }
           }
           
           if (empty($email)&&empty($password)&&empty($nickname)){
              $_SESSION['alert'] = "No change was made at User $status->nickname.";
              header('location: ../users/user.php');
              break;
           }
           
  header('location: ../users/user.php');
  break;
 }
