<?php

use Alura\Pdo\infrastructure\Persistence\ConnectionCreator;

$pdo = ConnectionCreator::createConnection();

$sqlDelete = 'DELETE FROM students WHERE id = ?;';
$prepareStatement = $pdo->prepare($sqlDelete);
$prepareStatement->bindValue(1,3,PDO::PARAM_INT);
var_dump($prepareStatement->execute());
