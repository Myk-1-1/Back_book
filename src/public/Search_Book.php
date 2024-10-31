<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пошук книги</title>
</head>
<body>
    <form method="post" action="Search_Book_handler.php" enctype="multipart/form-data">
        <p>Введіть назву книги</p>
        <input required type="text" name="title" placeholder="Назва книги">
        <p>Введіть автора книги</p>
        <input required type="text" name="author" placeholder="Автор">
        <p>Введіть рік видання книги</p>
        <input required type="text" name="year" placeholder="Рік видання"> 

        <p><input type="submit" value="Обрати"></p>   
    </form>

    <input type="button" value="Повернутись" onclick="location.href='form.php'"/> 
</body>
</html>