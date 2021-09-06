<?php
require("../confdb/db.php");

$login =  htmlspecialchars($_POST["login"],ENT_QUOTES, "UTF-8");
$password =  htmlspecialchars($_POST["password"],ENT_QUOTES, "UTF-8");


    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $user, $pass, $opt);//создание объекта
 

    $value = $pdo->prepare('SELECT *  FROM user WHERE login = :login AND password = :password');//Создание подготовленного запроса
    $value->execute(['login' => $login,'password' => $password]);// вставляем данные

    foreach ($value as $row){
        if ($value > 0) {
            session_start();// начало сессии
            $_SESSION['user'] = $row['login'];// если найден пользователь то записываем его в сессию и редиректим
            $SesUser = $_SESSION['user'];
            $array = array('status' => 'success'); // тернарный оператор с JSON
            echo 'Привет '.$SesUser.', Вы Авторизованы '.'<a href="/Script PHP/SessionExit.php">Выйти</a>'.json_encode($array,JSON_PRETTY_PRINT);
            exit();
            
        }
    }

    

    $user = $value->fetchAll();


    if (count($user) == 0) {
        $array = array('status' => 'error');
        echo $login.' '.'Такой пользователь не найден'.json_encode($array,JSON_PRETTY_PRINT); //вывод сообщения, если нет пользователя 
        exit();
    }

  
?>