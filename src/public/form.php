<?php 

// require __DIR__  . '/../vendor/autoload.php';
use Library\App\Classes\Category;
use Library\App\Classes\DbBook;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/table.css" rel="stylesheet" />
    <title>Нова книга</title>
</head>
<body>

    <?php
    
    $categories = Category::fetchAll();
    ?>
    <h1>Внесення нової книги</h1>
    <form method="post" action="book_handler.php" enctype="multipart/form-data">
        <p>Введіть назву книги</p>
        <input required type="text" name="title" placeholder="Назва книги">
        <p>Введіть автора книги</p>
        <input required type="text" name="author" placeholder="Автор">
        <p>Введіть рік видання книги</p>
        <input required type="date" name="year" placeholder="Рік видання"> 
        <p>Виберіть зображення обкладинки</p>
        <input required type="file" name="image">
        <p>Категорія</p>
        <select required name = "category">
            <?php foreach ($categories as $category) { ?>
                <option value="<?php echo $category['id'];  ?>" ><?php echo $category['name']; ?></option>
            <?php } ?>
        </select>
        <p><input type="submit" value="Занести"></p>
    </form>

    <input type="button" value="Видалення категорії/книги по id" onclick="location.href='Deleter.php'"/> 
    <!-- Deleter.php -> Delete_handler -->
    <p>      </p>
    <input type="button" value="Додати категорію" onclick="location.href='Add_category.php'"/>
    <!-- Add_category -> Add_cat_handler -->
    <p>      </p>
    <input type="button" value="Знайти книгу по даним книги" onclick="location.href='Search_Book.php'"/>
    <!-- Search_Book -> Search_Book_handler -->
    <p>      </p>
    <input type="button" value="Знайти інформацію про книгу по ID" onclick="location.href='ID_Search.php'"/>
    <!-- ID_search -> ID_search_handler -->
    <p>      </p>
                <div>
                <table>
  <caption>
    <h1>Books</h1> 
  </caption>
  <thead>
    <tr>
      <th scope="col" class="id">ID</th>
      <th scope="col" class ="title">Title</th>
      <th scope="col" class ="author">Author</th>
      <th scope="col" class ="year">Year</th>
      <th scope="col" class ="image_path">Image_path</th>
      <th scope="col" class ="cat">Category</th>
      <th scope="col" class ="create">Created at</th>
    </tr>
  </thead>
  <tbody>
    <tr><?php
        $Books = DbBook::fetchAll();
        foreach ($Books as $book){
        $cat = Category::get_id_name($book["category"])
        ?>
      <td class = "id"><?php echo $book["id"] ?> </td>
      <td class ="title"><?php echo $book["title"] ?></td>
      <td class ="author"><?php echo $book["author"] ?></td>
      <td class ="year"><?php echo $book["year"] ?></td>
      <td class ="image_path"><?php echo $book["image_path"] ?></td>
      <td class ="cat"><?php echo $cat["name"] ?></td>
      <td class ="create"><?php echo $book["created_at"] ?></td>
    </tr>
    <?php
    }
        ?>
</table>
                </div>
    
</body>
</html>