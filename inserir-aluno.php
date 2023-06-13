<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\infrastructure\Persistence\ConnectionCreator;

require_once 'vendor/autoload.php';

$pdo = ConnectionCreator::createConnection();

$student = new Student(null, 'Amanda Ester', new \DateTimeImmutable('2003-03-24'));

$sqlInsert = "INSERT INTO students (name, birth_date) VALUES  (?, ?)";

$statement = $pdo->prepare($sqlInsert);
$statement->bindValue(1,$student->name());
$statement->bindValue(2,$student->birthDate()->format('Y-m-d'));

if ($statement->execute()) {
    echo "Aluno incluido";
}