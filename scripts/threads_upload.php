<?php

session_start();
require_once '../functions.php';

    
    
if(isset($_SESSION['act_thr'])){
    $act_thread=$_SESSION['act_thr'];
    $status_t= Threads::id("$act_thread","thread_id");
    $status_t= $status_t->fetch_object();
    unset($_SESSION['act_thr']);
}    
    
if (isset($_SESSION['user'])){
    $status= $_SESSION['user'];
    
   } else {
       $_SESSION['alert'] = 'First Log In';
  header('location: ../users/index.php');  
}

$target_dir = "../assets/images/threads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 0;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 0;
    } else {
        $uploadOk = 1;
    }
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    
    $uploadOk = 2;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "jpeg") {
    
    $uploadOk = 3;
} else {
   $filename= $status_t->thread_id . '.' . $imageFileType;
   $final_filename= $target_dir . $filename; 
}

switch ($uploadOk) {
                case 1:
                    $_SESSION['alert']= "File is not an image.";
                    header("location: ../threads/thread_edit.php?t=$status_t->thread_id");
        
                    break;
                case 2:
                    $_SESSION['alert']= "Sorry, your file is too large.";
                    header("location: ../threads/thread_edit.php?t=$status_t->thread_id");
                    break;
                
                case 3:
                    $_SESSION['alert']= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    header("location: ../threads/thread_edit.php?t=$status_t->thread_id");
        
                    break;
                default:
                    if ($status_t->image_thread=="thread_default.png") {
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $final_filename)) {
                        $_SESSION['sucalert']="The file has been uploaded.";
                        $thread_tableR= Threads::thread_update('image_thread', $filename, 'thread_id', $status_t->thread_id);
                        header("location: ../threads/thread_edit.php?t=$status_t->thread_id");
                        break;
                        } else {
                            $_SESSION['alert']= "Sorry, there was an error uploading your file.";
                            header('location: ../index.php');
                            break;
                        }

                    } else {
                        $target_file_del=$target_dir . "$status_t->image_thread";
                        if (file_exists($target_file_del)) {
                            unlink($target_file_del);
                            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $final_filename)) {
                                $_SESSION['sucalert']="The file has been uploaded.";
                                $thread_tableR= Threads::thread_update('image_thread', $filename, 'thread_id', $status_t->thread_id);
                                header("location: ../threads/thread_edit.php?t=$status_t->thread_id");
                                break;
                            } else {
                                $_SESSION['alert']= "Sorry, there was an error uploading your file.";
                                header('location: ../index.php');
                                break;
                            }
                        }else{
                            $_SESSION['alert']= "There was an error changing your Thread image please contact Site Administrator."; 
                            header('location: ../index.php');
                            break;
                    }
                
            }
                    
}





