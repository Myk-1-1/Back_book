<?php

session_start();

use Library\App\сlasses\BookAdd;
use Library\App\сlasses\exceptions\ValidationException;

require __DIR__  . '/../vendor/autoload.php';

require __DIR__  . '/classes/BookAdd.php';


$title = $_POST['title'] ?? null;
$author = $_POST['author'] ?? null;
$year = $_POST['year'] ??null;
$image = $_FILES['image'] ??null;
$category = $_POST['category'] ??null;


try{

    $book = new BookAdd($title,$author,$year, $image, $category);
    header("Location: book_display.php?id=" . $book->GetIdValue());


} catch(ValidationException $e){
    error_log("Caught $e");
    exit;
}

?>