<?php 

require __DIR__ . '//../vendor/autoload.php';

use Library\App\Classes\DbBook;
use Library\App\Classes\Category;

if(!isset($_GET['id'])){
    header("Location: form.php");
    exit;
}
$book = DbBook::book_by_id($_GET['id']);
$cat = Category::get_id_name($book["category"]);
    echo "<h1> Ваша Книга <h1>";
    echo "Назва книги " .$book['title'] . "<br>";
    echo "Автор " .$book['author'] . "<br>";
    echo "Рік видання " .$book["year"] . "<br>";
    echo "Категорія " .$cat["name"] . "<br>";
    echo "Зображенння обкладинки: <img src='" . $book['image_path'] . "'/><br>";

?>  
<input type="button" value="Повернутись" onclick="location.href='form.php'"/> 