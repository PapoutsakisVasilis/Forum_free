<?php

class Posts {
    public static function all($collumn='created_at',$order="ASC"){
        $sql = "SELECT * FROM posts ORDER BY $collumn $order";
        
        $db = new DB;
        return  $db->connection->query($sql);
    }
    public static function allidthreads($collumn ,$value, $created_at= 'created_at', $order="ASC"){
        $sql = "SELECT * FROM posts WHERE $collumn = '$value' ORDER BY $created_at $order";
        
        $db = new DB;
        return  $db->connection->query($sql);
    }
     public static function post_count($value){
         $num_rows =$value->num_rows; 
        return $num_rows;
    }
    public static function delete($id){
        $sql = "DELETE FROM posts WHERE post_id =$id";
        
        $db = new DB;
        return $db->connection->query($sql);
    }
    public static function allposts_update($collumn ,$value,$collumn_change,$change_value){
        $sql = "SELECT * FROM posts WHERE $collumn='$value'";
        
        $db = new DB;
        $contain_posts= $db->connection->query($sql);
        if(isset($contain_posts)){
            $num_rows_po= $contain_posts->num_rows;
        }
        if($num_rows_po<1){
            return 0;
        } 
        if($num_rows_po>0){
            $counter=0;
            while ($row = $contain_posts->fetch_object()) {
              $collumn1='post_id';
              $value1=$row->post_id;
              $sqlu = "UPDATE posts SET $collumn_change='$change_value' WHERE $collumn1='$value1'";
              $db = new DB;
              $update_thread= $db->connection->query($sqlu);
              $counter=($counter+1);
            }
        }
        if($counter==$num_rows_po){
            return 1;
        } else {
            return 2;
        }
        
    }
    public static function oneidpost($collumn ,$value){
        $sql = "SELECT * FROM posts WHERE $collumn = '$value' LIMIT 1";
        
        $db = new DB;
        return  $db->connection->query($sql);
    }
}

