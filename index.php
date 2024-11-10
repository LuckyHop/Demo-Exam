<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Нарушениям.Нет</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="main btn-group">
        <div class="register">
            <a href="register.php" class="btn btn-primary" aria-current="page">Регистрация</a>
        </div>
        <div class="login">
            <a href="login.php" class="log btn btn-primary">Авторизация</a>
        </div>
        <div class="admin">
            <a href="admin.php" class="adm btn btn-primary">Панель администратора</a>
        </div>
        <div class="statements">
            <a href="statements.php" class="adm btn btn-primary">Заявления</a>
        </div>
    </div>
    <h1>Добро пожаловать на портал "Нарушениям.Нет"</h1>
    <p>Здесь вы можете сообщить о нарушениях правил дорожного движения.</p>
</body>
</html>