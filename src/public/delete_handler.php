<?php

session_start();

use Library\App\Classes\Category;
use Library\App\Classes\DbBook;

require __DIR__  . '/../vendor/autoload.php';

require __DIR__  . '/classes/BookAdd.php';


$category = $_POST['category'] ?? null;
$ID = $_POST['ID'] ?? null;


if($category === 'Cat'){
    Category::cat_droper($ID);
    header("Location: form.php");
}
elseif($category ==='Book'){
    DbBook::book_droper($ID);
    header("Location: form.php");
}else{
    header("Location: form.php");
}



?>