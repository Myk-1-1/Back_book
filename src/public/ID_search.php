<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Нова книга</title>
</head>
<body>

    <h1>ID книги</h1>
    <form method="post" action="ID_search_handler.php" enctype="multipart/form-data">
        <p>Введіть ID</p>
        <input required type="text" name="id" placeholder="id">
        <p><input type="submit" value="Знайти"></p>    

    </form>

    <input type="button" value="Повернутись" onclick="location.href='form.php'"/> 
</body>
</html>