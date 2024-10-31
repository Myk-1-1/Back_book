<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Нова книга</title>
</head>
<body>
    <form method="post" action="delete_handler.php" enctype="multipart/form-data">
        <input required type="text" name="ID" placeholder="ID">
        <p>Видалити категорію або книгу</p>
        <select required name = "category">
        <option value="Cat"> Категорія</option>
        <option value="Book"> Книга </option>
        </select>
        <p><input type="submit" value="Обрати"></p>    

    </form>

    <input type="button" value="Повернутись" onclick="location.href='form.php'"/> 
</body>
</html>