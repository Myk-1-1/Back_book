<?php
namespace Library\App\Classes;

use Library\App\Classes\Database;

class Category{
    public static function fetchAll(){
        $db = Database::getInstance();

        $result = $db->getConnection()->query("SELECT * FROM categories");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public static function get_id_name($id){ // замінює ID категорії на її name                                                 
        $db = Database::getInstance();                      
        $result = $db->getConnection()->query("SELECT name FROM categories WHERE id= '{$id}'");
        $answer = $result->fetch_assoc();
        return $answer;
    }
    public static function cat_droper($id){ // видаляє категорію по ID
        $db = Database::getInstance();       
        $stm = $db->getConnection()->prepare("DELETE FROM categories WHERE id=?");
        $stm ->bind_param('i',$id);
        $stm ->execute();
        if($stm === false){
            throw new \Exception("Не вдалося здійснити операцію");
        }
    }
    public static function cat_adder($data){ // додає категорію 
        $data = str_replace(';', '?', $data); // заміна спецсимволу ;   
        $db = Database::getInstance();       
        $stm = $db->getConnection()->prepare("INSERT INTO categories (name) VALUES (?);");
        $stm ->bind_param('s', $data);
        $stm ->execute();
        if($stm === false){
            throw new \Exception("Не вдалося здійснити операцію");
        }
    }
}
?>
