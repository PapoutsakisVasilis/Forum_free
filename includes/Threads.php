<?php

class Threads {
    public static function all($collumn='created_at',$order="DESC"){
        $sql = "SELECT * FROM threads ORDER BY $collumn $order";
        
        $db = new DB;
        return  $db->connection->query($sql);
    }
     public static function thread_count($value){
         $num_rows =$value->num_rows; 
        return $num_rows;
    }
    public static function delete($id){
        $sql = "DELETE FROM threads WHERE thread_id =$id";
        
        $db = new DB;
        return $db->connection->query($sql);
    }
    public static function id($value,$collumn="thread_id"){
        $sql = "SELECT * FROM threads WHERE $collumn=$value LIMIT 1";
        
        $db = new DB;
        return $db->connection->query($sql);
    }
    
    public static function allthreads($collumn ,$value, $created_at= 'created_at', $order="DESC"){
        $sql = "SELECT * FROM threads WHERE $collumn = '$value' ORDER BY $created_at $order";
        
        $db = new DB;
        return  $db->connection->query($sql);
    }
    public static function thread_update($collumn_change,$change_value, $collumn, $value){
        $sql = "UPDATE threads SET $collumn_change='$change_value' WHERE $collumn='$value'";
        
        $db = new DB;
        $result= $db->connection->query($sql);
        return $result;
        
    }
     public static function allthreads_update($collumn ,$value,$collumn_change,$change_value){
        $sql = "SELECT * FROM threads WHERE $collumn='$value'";
        
        $db = new DB;
        $contain_thread= $db->connection->query($sql);
        if(isset($contain_thread)){
            $num_rows_th= $contain_thread->num_rows;
        }
        if($num_rows_th<1){
            return 0;
        } 
        if($num_rows_th>0){
            $counter=0;
            while ($row = $contain_thread->fetch_object()) {
              $collumn1='thread_id';
              $value1=$row->thread_id;
              $sqlu = "UPDATE threads SET $collumn_change='$change_value' WHERE $collumn1='$value1'";
              $db = new DB;
              $update_thread= $db->connection->query($sqlu);
              $counter=($counter+1);
            }
        }
        if($counter==$num_rows_th){
            return 1;
        } else {
            return 2;
        }
        
    }
    
}

