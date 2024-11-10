<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['login'] === 'copp' && $_POST['password'] === 'password') {
    $_SESSION['admin'] = true;
}

if (!isset($_SESSION['admin'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = $_POST['login'];
        $password = $_POST['password'];
        if ($login === 'copp' && $password === 'password') {
            $_SESSION['admin'] = true;
        } else {
            $error = 'Неверные логин или пароль';
        }
    }
}

if (isset($_SESSION['admin'])) {
    $statements = loadData($statementsFile);
    if (isset($_POST['update'])) {
        $index = $_POST['index'];
        $statements[$index]['status'] = $_POST['status'];
        saveData($statementsFile, $statements);
        header('Location: admin.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Панель администратора</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Панель администратора</h1>
    <a href="index.php" class="back-button bck">Назад на главную</a>
    <?php if (!isset($_SESSION['admin'])): ?>
        <form method="post">
            Логин: <input type="text" name="login" required><br>
            Пароль: <input type="password" name="password" required><br>
            <button type="submit">Войти</button>
        </form>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
    <?php else: ?>
        <h2>Заявления</h2>
        <ul>
            <?php foreach ($statements as $index => $statement): ?>
                <li>
                <?php echo $statement['username'] . ' - ' . $statement['car_number'] . ' - ' . $statement['description'] . ' (Статус: ' . $statement['status'] . ')'; ?>
                <form method="post" style="display:inline; background-color: rgb(139, 0, 219);">
                    <input type="hidden" name="index" value="<?php echo $index; ?>">
                    <select name="status">
                        <option value="Новое" <?php echo ($statement['status'] === 'Новое') ? 'selected' : ''; ?>>Новое</option>
                        <option value="Подтверждено" <?php echo ($statement['status'] === 'Подтверждено') ? 'selected' : ''; ?>>Подтверждено</option>
                        <option value="Отклонено" <?php echo ($statement['status'] === 'Отклонено') ? 'selected' : ''; ?>>Отклонено</option>
                    </select>
                    <br>
                    <button type="submit" name="update">Обновить статус</button>
                </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>      