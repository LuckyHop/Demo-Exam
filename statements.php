<?php
include 'db.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];
$statements = loadData($statementsFile);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_number = $_POST['car_number'];
    $description = $_POST['description'];

    $statements[] = [
        'username' => $username,
        'car_number' => $car_number,
        'description' => $description,
        'status' => 'Новое'
    ];

    saveData($statementsFile, $statements);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Заявления</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Ваши Заявления</h1>
    <a href="index.php" class="back-button bck">Назад на главную</a>
    <form method="post">
        Номер автомобиля: <input type="text" name="car_number" required><br>
        Описание нарушения: <textarea name="description" class="txtarea" required></textarea><br>
        <button type="submit" class="">Подать заявление</button>
    </form>
    
    <h2>Ваши заявления</h2>
    <form method="post">
        <ul>
            <?php foreach ($statements as $statement): ?>
                <?php if ($statement['username'] === $username): ?>
                    <li><?php echo $statement['car_number'] . ' - ' . $statement['description'] . ' (Статус: ' . $statement['status'] . ')'; ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </form>
</body>
</html>