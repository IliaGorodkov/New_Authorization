<?php
session_start();
require("confdb/db.php");
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script src="ajax.js"></script>
        <title>Authorization</title>
    </head>

<body>
<div id="Session_Information"></div>

    <div class = "Flex border indent">
        <div><h1>Форма Входа</h1></div>
        <form id="form_id"  method="POST" required>
            <label for="login">Введите ваш Логин &ensp;</label> <input type="text" id="login" name="login" style="width: 50%;" required><br><br>
            <label for="password">Введите ваш Пороль </label><input type="password" id="password" name="password" style="width: 50%;" required><br><br>
            <button class="Button" type="submit">Авторизироваться</button>
        </form>
    </div>
       
   <script>
            $(document).ready(function () {
            $("form").submit(function () {
                // Получение ID формы
                var formID = $(this).attr('id');
                // Добавление решётки к имени ID
                var formNm = $('#' + formID);
                var login = $('input[name="login"]').val();// вставляем данные из  поля login в созданную переменную 
                var password = $('input[name="password"]').val();// вставляем данные из  поля password в созданную переменную 
                $.ajax({
                    type: "post", // тип запроса
                    url: '/Script PHP/script.php',// куда пойдет запрос
                    data: {login:login,password:password},// что отправляем
                    success: function(data){
                        $('#Session_Information').html(data);// что получили выводим в div с id = "aaa"
                    }
                });
                return false;
            });
        });
     </script>
    
</body>
</html>