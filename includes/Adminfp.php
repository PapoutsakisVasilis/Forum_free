<?php
class Admin {
    public static function findFp($value= 'id'){
            $sql = "SELECT * FROM frontend WHERE $value LIMIT 1";

            $db = new DB;
            return  $db->connection->query($sql)->fetch_object();
        }
        public static function ch_update($collumn_change,$change_value, $collumn, $value){
        $sql = "UPDATE frontend SET $collumn_change='$change_value' WHERE $collumn='$value'";
        
        $db = new DB;
        $result= $db->connection->query($sql);
        return $result;
        }

}