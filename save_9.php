<?php

$text = $_POST["simpleinput"];

$connection = new PDO("mysql:host=localhost; dbname=inputbase", "root", "");
$sql = "INSERT INTO inputtable VALUES (:data)";
$statement = $connection->prepare($sql);
$statement->execute(["data" => $text]);

header("Location: /task_9.php");