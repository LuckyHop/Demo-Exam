<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $users = loadData($usersFile);

    if (isset($users[$username]) && password_verify($password, $users[$username]['password'])) {
        $_SESSION['username'] = $username;
        header('Location: statements.php');
        exit;
    } else {
        $error = 'Неверный логин или пароль.';
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Авторизация</h1><br>
    <a href="index.php" class="back-button bck">Назад на главную</a>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
    <form method="post">
        Логин: <input type="text" name="username" required><br>
        Пароль: <input type="password" name="password" required><br>
        <button type="submit" class="">Войти</button>
    </form>
</body>
</html>