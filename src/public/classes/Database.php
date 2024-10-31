<?php
namespace Library\App\Classes;

use mysqli;
class Database
{

    private $mysqli;
    private static $instance; 

    public function __construct(){
        $this->mysqli = new \mysqli('mysql', 'default', 'secret', 'default');

        if($this->mysqli->connect_error){
            die("connection error");
        }
    }
    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;

    }
    public function getConnection(){
        return $this->mysqli;
    }
}
?>
