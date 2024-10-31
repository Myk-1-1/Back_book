<?php

session_start();

use Library\App\Classes\DbBook;

require __DIR__  . '/../vendor/autoload.php';

require __DIR__  . '/classes/BookAdd.php';


$title = $_POST['title'] ?? null;
$author = $_POST['author'] ?? null;
$year = $_POST['year'] ??null;


if($title === null || $author === null || $year === null){
    header("Location: form.php");
}else{
    $book_id = DbBook::book_searcher($title,$author,$year);
    if($book_id["id"] === null){
    echo "<script>alert('Not Found')
    </script>";
        header("Location: form.php");
    }else{
        header("Location: book_display.php?id=" . $book_id["id"]);
    }
    
}
?>