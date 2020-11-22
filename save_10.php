<?php
session_start();

$text = $_POST['simpleinput'];
$connection = new PDO("mysql:host=localhost; dbname=inputbase; charset=utf8", "root", "");

// проверка наличия такой записи в базе
$sql = "SELECT * FROM inputtable WHERE data = :data";
$statement = $connection->prepare($sql);
$statement->execute(["data" => $text]);
$task = $statement->fetch(PDO::FETCH_ASSOC);

// если такая запись в базе есть, то выводим сообщение
if (!empty($task)) {
    $danger = "You should check in on some those fields below.";
    $_SESSION['danger'] = $danger;

    header("Location: /task_10.php");
    exit;
}

// если такой записи нет, то вносим её в базу
$sql = "INSERT INTO inputtable VALUES (:data)";
$statement = $connection->prepare($sql);
$statement->execute(["data" => $text]);

$success = "Record added to database";
$_SESSION['success'] = $success;

header("Location: /task_10.php");