<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $users = loadData($usersFile);
    
    if (isset($users[$username])) {
        $error = 'Пользователь с таким логином уже существует.';
    } else {
        $users[$username] = [
            'password' => $password,
            'fullname' => $fullname,
            'phone' => $phone,
            'email' => $email
        ];
        saveData($usersFile, $users);
        header('Location: login.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Регистрация</h1>
    <a href="index.php" class="back-button bck">Назад на главную</a>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
    <form method="post">
        Логин: <input type="text" name="username" required><br>
        Пароль: <input type="password" name="password" required><br>
        ФИО: <input type="text" name="fullname" required><br>
        Телефон: <input type="text" name="phone" required><br>
        Email: <input type="email" name="email" required><br>
        <button type="submit" class="">Зарегистрироваться</button>
    </form>
</body>
</html>
