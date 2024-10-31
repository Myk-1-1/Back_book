<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Нова книга</title>
</head>
<body>

    <h1>Внесення нової Категорії</h1>
    <form method="post" action="Add_cat_handler.php" enctype="multipart/form-data">
        <p>Введіть назву Категорії</p>
        <input required type="text" name="data" placeholder="data">
        <p><input type="submit" value="Додати"></p>    

    </form>

    <input type="button" value="Повернутись" onclick="location.href='form.php'"/> 
</body>
</html>