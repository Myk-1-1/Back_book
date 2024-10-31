<?php

session_start();


require __DIR__  . '/../vendor/autoload.php';

require __DIR__  . '/classes/BookAdd.php';


$id = $_POST['id'] ?? null;


if($id === null){
    header("Location: form.php");
    }else{
        header("Location: book_display.php?id=" . $id);
    }
?>