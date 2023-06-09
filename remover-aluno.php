<?php
$databasePath = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $databasePath);

$sqlDelete = 'DELETE FROM students WHERE id = ?;';
$prepareStatement = $pdo->prepare($sqlDelete);
$prepareStatement->bindValue(1,3,PDO::PARAM_INT);
var_dump($prepareStatement->execute());
