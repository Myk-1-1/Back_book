<?php

namespace Library\App\сlasses;

use Library\App\сlasses\exceptions\ValidationException;
use Library\App\Classes\Database;

class Book{
    protected $title;
    protected $author; 
    protected $year;
    protected $category; 
    protected $image; 


    private $data = [];

    protected $uploaded_image_path;

    protected $book_id;

    public function __construct($title, $author, $year, $image, $category){
        $allowed_types = ['image/jpeg', 'image/png', 'image/jfif'];
        $this->validate($title, $author, $year, $image, $allowed_types, $category);
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
        $this->category = $category;
        $this->image = $image;
    }
    protected function validate($title, $author, $year, $image, $allowed_types, $category ){// Валідація даних
        if (empty($title) || empty($author) || empty($year) || empty($category)) {// перевірка текстових полей форми
            throw new ValidationException("Будь ласка, заповніть всі поля форми.");
        }
        if ($image['size'] == 0) { // перевірка на пустий файл
            throw new ValidationException("Немає зображення"); 
        }
        if (!in_array(mime_content_type($image['tmp_name']), $allowed_types)) { // перевірка типу файлу
            throw new ValidationException ("Файл повинен бути зображенням типу JPG або PNG.");
        }
        if ($image['size'] > 5000000) { // обмеження на 5 МБ
            throw new ValidationException ("Розмір файлу перевищує допустимий ліміт у 5 МБ.");
        }
    }

    public function getTitle(){ // гетери
        return $this->title;
    }
    public function getAuthor(){ // гетери
        return $this->author;
    }
    public function getYear(){ // гетери
        return $this->year;
    }
    
    public function __set($name, $value){//магічний метод set
        $this->$name = $value;
    }
    public function __get($name){//магічний метод get
        return $this-> data[$name];
    }
    public function fetch_by_id($id){
        $dbConnection = Database::getInstance()->getConnection();
        $result = $dbConnection->query("SELECT * FROM AdBook WHERE id = '{$id}';");
        if($result === false){
            throw new \Exception("No book with this id"); 
        }else{
            $book = $result->fetch_assoc();
            if($book === null){
                throw new \Exception("No book with this id"); 
            }
            return $book;
        }
    }

}
?>