<?php

namespace Library\App\сlasses;

use Library\App\Classes\Database;
use Library\App\сlasses\Book;

require 'Book.php';
class BookAdd extends Book {
    public function __construct($title, $author, $year, $image, $category) {
        $year = $this->YearMaker($year);
        parent::__construct($title, $author, $year, $image, $category);
        $this->saveImage();
        $this->xssDestroyer();
        $this->check_copy();
        }
    
    public function save_session (){ // збереження сессій
        $_SESSION ['title'] = $this->title;
        $_SESSION ['author'] = $this->author;
        $_SESSION ['image'] = $this->image;
        $_SESSION ['category'] = $this->category;
        $_SESSION ['uploaded_image_path'] = $this->uploaded_image_path;
    }

    public function save_cookies (){ //збереження кукі
        setcookie("year", $this->year ,time()+3600);
        setcookie('uploaded_image_path', $this->uploaded_image_path, time()+ 3600);

    }
    private function xssDestroyer(){// вирізання спецсимволів та заміна ; на #, для додаткового запобігання від SQL ін'єкцій
        $this -> title = htmlspecialchars(strip_tags($this->title));
        $this -> author = htmlspecialchars(strip_tags($this->author));
        $this -> uploaded_image_path = htmlspecialchars(strip_tags($this->uploaded_image_path));
        $this -> title = str_replace(';', '#', $this->title);
        $this -> author = str_replace(';', '#', $this->author);
        $this -> uploaded_image_path =str_replace(';', '#', $this->uploaded_image_path);

    }
    public function YearMaker($year){//функція вирізання року з дати(може бути модифікована за бажанням для іншого формату)
        $new_year = substr($year,0,-6);
        return $new_year;
    }
    
    public function GetIdValue(){// збереження нового ID у объект, заміна функції insert_id, написав її раніше ніж побачив insert_id
                                            // оскільки це додатковий запит до бази даних, що робить додаткову нагрузку - не є еффективною
        $dbConnection = Database::getInstance()->getConnection();
        $result = $dbConnection->query("SELECT id FROM AdBook WHERE (title = '{$this->title}' AND author = '{$this->author}'); ");
        foreach ($result->fetch_all(MYSQLI_ASSOC) as $i => $value) {
            $answer = $value;
        }
        return $answer['id'];
    }

    public function check_copy(){//Перевірка на копії(такі самі книги в базі даних)
        $dbConnection = Database::getInstance()->getConnection();
        $result = $dbConnection->query("SELECT id FROM AdBook WHERE (title = '{$this->title}' AND author = '{$this->author}'); ");
        $answer = $result->fetch_all(MYSQLI_ASSOC);
        if(empty($answer)){
            $this->save_database();
        }
        else{
            foreach ($result->fetch_all(MYSQLI_ASSOC) as $i => $value) {
                $answer = $value;
            }
            print("copy");
        }
        
    }
        
    public function save_database (){//  збереження в базу даних
        $dbConnection = Database::getInstance()->getConnection();
        $stm = $dbConnection->prepare("INSERT INTO AdBook (title,author,year,category,image_path) VALUES (?,?,?,?,?)");
        $stm ->bind_param('sssss', $this->title, $this->author, $this->year, $this->category, $this->uploaded_image_path);
        $stm ->execute();
        if($stm === false){
            throw new \Exception("Не вдалося здійснити операцію");
        }
        $this->book_id = $dbConnection->insert_id;
        }
    public function saveImage(){// збереження зображення та шляху до нього
        if($this->image['error'] == 0){
            $tmpname = $this->image['tmp_name'];
            $name = $this->image['name'];
            $image_path = 'downloads' . "/" . $name;
        
            if (move_uploaded_file($tmpname, "downloads/$name")){//перевірка успішності завантаження файлу
                $this->uploaded_image_path = $image_path;
            }
        }else{
            throw new \Exception("Error of downloading a file");    
        }
    }
    public function data_form ($data_sess, $data_cook){
        $db= [''];
        return $db;
    }
    public function data_check ($data_sess, $data_cook) { // Повторна перевірка даних, надісланих з сесій та кукі - 1 додаткове завдання
            foreach ($data_sess as $key => $value) {
                if (strlen($key) == 0 || strlen($value) == 0) {
                    throw new \Exception("Some data error");
                }
                if (strlen($value) == 0 || strlen($value) == 0) {
                    throw new \Exception("Some data error");
                }

            }
            foreach ($data_cook as $key => $value) {
                if (strlen($key) == 0 || strlen($value) == 0) {
                    throw new \Exception("Some data error");
                }
                if (strlen($value) == 0 || strlen($value) == 0) {
                    throw new \Exception("Some data error");
                }

            }
   
        }
    }
?>
