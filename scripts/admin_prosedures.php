<?php
require_once '../functions.php';

session_start();
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
function deactivation($id)
{
   $result= Users::user_update('rank', '100', 'id', "$id");
   if (isset($result)) {
     $_SESSION['sucalert']='User Deactivated';
     header('location: ../admin/index.php');
    } else {
       $_SESSION['alert']='Something is wrong.';
       header('location: ../admin/index.php');
    }
    
}
if(isset($_POST['submitdea']))
{
    if(isset($_POST['id']))
        {
            $id=$_POST['id'];
            deactivation($id); 
        } else {
            $_SESSION['alert']='Something is wrong cant set the id value.';
            header('location: ../admin/index.php');
        }
    
} 

function activation($id)
{
   $result= Users::user_update('rank', '0', 'id', "$id");
   if (isset($result)) {
     $_SESSION['sucalert']='User Activated';
     header('location: ../admin/index.php');
    } else {
       $_SESSION['alert']='Something is wrong.';
       header('location: ../admin/index.php');
    }
    
}

if(isset($_POST['submitact']))
{
    if(isset($_POST['id']))
        {
            $id=$_POST['id'];
            activation($id); 
        } else {
            $_SESSION['alert']='Something is wrong cant set the id value.';
            header('location: ../admin/index.php');
        }
    
} 

function promote($id)
{
   $result= Users::user_update('rank', '1', 'id', "$id");
   if (isset($result)) {
     $_SESSION['sucalert']='User Promoted';
     header('location: ../admin/index.php');
    } else {
       $_SESSION['alert']='Something is wrong.';
       header('location: ../admin/index.php');
    }
    
}

if(isset($_POST['submitpro']))
{
    if(isset($_POST['id']))
        {
            $id=$_POST['id'];
            promote($id); 
        } else {
            $_SESSION['alert']='Something is wrong cant set the id value.';
            header('location: ../admin/index.php');
        }
    
} 

function unpromote($id)
{
   $result= Users::user_update('rank', '0', 'id', "$id");
   if (isset($result)) {
     $_SESSION['sucalert']='User Unpromoted';
     header('location: ../admin/index.php');
    } else {
       $_SESSION['alert']='Something is wrong.';
       header('location: ../admin/index.php');
    }
    
}

if(isset($_POST['submitunp']))
{
    if(isset($_POST['id']))
        {
            $answer= Users::rankuser('rank', '1');
            if(isset($answer)&&$answer==1){
                $id=$_POST['id'];
                unpromote($id);
            } else {
                $_SESSION['alert']='There must be at least one Admin.';
                header('location: ../admin/index.php');
            }
             
        } else {
            $_SESSION['alert']='Something is wrong cant set the id value.';
            header('location: ../admin/index.php');
        }
    
} 

function threadDel($id)
{
   $thread= Threads::delete("$id");
   $posts= Posts::allidthreads('po_thread_id', "$id");
   
   if (isset($posts)&&$posts->num_rows > 0){
        $delcount=2;
        $counter=0;
        $postsnum=$posts->num_rows;
      while ($row = $posts->fetch_object()) 
        {
       $deleter= Posts::delete("$row->post_id");
       if(isset($deleter)){
            $counter=$counter++;
            unset($deleter);
            }
       
        }
        
    }else{
        unset($delcount);
        $delcount=1;  
    }
    switch ($delcount) {
        
        case 2:
            $_SESSION['sucalert']= "One thread were deleted and $postsnum posts";
            header('location: ../admin/index.php');
            break;

        default:
            $_SESSION['sucalert']= 'One thread were deleted and there are no post in this thread.';
            header('location: ../admin/index.php');
            break;
    }
   
}

if(isset($_POST['submit_th_del']))
{
    if(isset($_POST['id']))
        {   $id=$_POST['id'];
            $che_th= Threads::id("$id");
            if(isset($che_th)){
                $id=$_POST['id'];
                threadDel($id);
            } else {
                $_SESSION['alert']='Cant find Thread.';
                header('location: ../admin/index.php');
            }
             
        } else {
            $_SESSION['alert']='Something is wrong cant set the id value.';
            header('location: ../admin/index.php');
        }
    
} 

if(isset($_POST['submitfre']))
{
    if(isset($_POST['fre']))
        {        unset($id);
            $id=$_POST['fre'];
            $result_fre= Admin::ch_update('choice', "$id", 'id', 1);
            
            if(isset($result_fre)){
                $_SESSION['sucalert']= "Front end Changed $id";
            header('location: ../admin/index.php');
            }else{
            $_SESSION['alert']= "Something Smells Bad.";
            header('location: ../admin/index.php');
            }
        }
            
    
} 