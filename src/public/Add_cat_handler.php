<?php

session_start();

use Library\App\Classes\Category;


require __DIR__  . '/../vendor/autoload.php';

require __DIR__  . '/classes/BookAdd.php';


$data = $_POST['data'] ?? null;


if($data === null){
    header("Location: form.php");
}else{
    Category::cat_adder($data);
    header("Location: form.php");
}

?>