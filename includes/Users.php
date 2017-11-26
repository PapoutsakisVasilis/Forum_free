<?php

class Users {
    public static function all($collumn='created_at', $order ="ASC"){
        $sql = "SELECT * FROM users ORDER BY $collumn $order";
        
        $db = new DB;
        return  $db->connection->query($sql);
    }
    
    
    public static function findBy($value= "id"){
        $sql = "SELECT * FROM users WHERE $value LIMIT 1";
        
        $db = new DB;
        return  $db->connection->query($sql)->fetch_object();
    }

    

    public static function delete($id){
        $sql = "DELETE FROM users WHERE id = '$id'";
        
        $db = new DB;
        return $db->connection->query($sql);
    }
    
    public static function findBythread($collumn, $value){
        $sql = "SELECT * FROM users WHERE $collumn= '$value' LIMIT 1";
        
        $db = new DB;
        return  $db->connection->query($sql)->fetch_object();
    }
    
    public static function nicknameInput($collumn, $value){
        $sql = "SELECT * FROM users WHERE $collumn='$value'";
        
        $db = new DB;
        $statusnick= $db->connection->query($sql);
        $statusnick->fetch_object();
        
        
        if ($statusnick->num_rows > 0){
            return $answer= 1;
            
        }else{
            return $answer= 0;
        }
        
    }
    public static function user_update($collumn_change,$change_value, $collumn, $value){
        $sql = "UPDATE users SET $collumn_change='$change_value' WHERE $collumn='$value'";
        
        $db = new DB;
        $result= $db->connection->query($sql);
        return $result;
        
    }
    public static function rankuser($collumn, $value){
        $sql = "SELECT * FROM users WHERE $collumn='$value'";
        
        $db = new DB;
        $result= $db->connection->query($sql);
        $result->fetch_object();
        
        
        if ($result->num_rows < 2){
            return $answer= 0;
        }else{
            return $answer= 1;
        }
        
    }
    
    
    
}