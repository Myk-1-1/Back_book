<?php
namespace Library\App\Classes;

use Library\App\Classes\Database;

class DbBook{
    public static function fetchAll(){
        $db = Database::getInstance();

        $result = $db->getConnection()->query("SELECT * FROM AdBook");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public static function book_searcher($title, $author, $year){ // Шукає id книги по даним,
        $title = str_replace(';', '#', $title);         // в мене була думка, що при передачі даних string можна ввести sql ін'єкцію, аналоги прикладів вирішення цієї проблеми:
        $author = str_replace(';', '#', $author);       // https://stackoverflow.com/questions/34132575/check-if-a-string-contains-a-disallowed-sql-command-in-php
        $year =str_replace(';', '#', $year);    
        $db = Database::getInstance();                                              
        $stm= $db->getConnection()->prepare("SELECT id FROM AdBook WHERE title = ? AND author = ? AND year = ?");
        $stm -> bind_param('sss' , $title, $author, $year); // всі 3 параметри очікуються як string
        $stm -> execute();
        
        if($stm === false){
            throw new \Exception("Не вдалося здійснити операцію");
        }
        $result = $stm->get_result();
        $answer = $result->fetch_assoc();
        return $answer;
    }
    public static function book_droper($id){ // видаляє книгу по ID 
        $db = Database::getInstance();       
        $stm = $db->getConnection()->prepare("DELETE FROM AdBook WHERE id=?");
        $stm->bind_param('i',$id);
        $stm ->execute();
        if($stm === false){
            throw new \Exception("Не вдалося здійснити операцію");
        }
    }
    public static function book_by_id($book_id){//Пошук книги по ID
        $db = Database::getInstance(); 
        $stm = $db->getConnection()->prepare("SELECT * FROM AdBook WHERE id=?");
        $stm->bind_param('i', $book_id);
        $stm ->execute();
        if($stm === false){
            throw new \Exception("Не вдалося здійснити операцію");
        }
        $result = $stm->get_result();
        $answer = $result->fetch_assoc();
        return $answer;
    }
}
?>
