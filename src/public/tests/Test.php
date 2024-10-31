<?php
namespace Library\App\Tests;

use PHPUnit\Framework\TestCase;
use Library\App\сlasses\Book;
use Library\App\Classes\Database;

class Test extends TestCase{
    private $db;
    public function BStest(){
        $title = "John Wick";
        $author = "Me";
        $year = "2024";
        $db = Database::getInstance();                                              
        $stm= $db->getConnection()->prepare("SELECT id FROM AdBook WHERE title = ? AND author = ? AND year = ?");
        $stm -> bind_param('sss' , $title, $author, $year); 
        $stm -> execute();
        $result = $stm->get_result();
        $saved = $result->fetch_assoc();
        $this->assertEquals($title, $saved["title"]);
        $this->assertEquals($author, $saved["author"]);
        $this->assertEquals($year, $saved["year"]);
    }

    public function testGetInfo(){
        $book = new Book('Title','Author', '2000', ['image' => 'image.jpg', 'tmp_name' => 'tmp_name'], 'cat');    
        $this->assertEquals('Title', $book->getTitle());
    }
    public function test_instance(){
        $book = new Book('Title','Author', '2000', ['image' => 'image.jpg', 'tmp_name' => 'tmp_name'], 'cat');    
        $this ->assertInstanceOf(Book::class, $book);
    }
    public function testSetUp(){
        $this->db = new Database();
    }
    public function testDB_con(){
        $this -> assertNotNull($this->db->getConnection());
    }
    
    
}
?>