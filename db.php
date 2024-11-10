<?php
session_start();

// Хранение пользователей в массиве
$usersFile = 'users.json';
$statementsFile = 'statements.json';

// Загрузка данных
function loadData($filename) {
    return file_exists($filename) ? json_decode(file_get_contents($filename), true) : [];
}

// Сохранение данных
function saveData($filename, $data) {
    file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
}
?>