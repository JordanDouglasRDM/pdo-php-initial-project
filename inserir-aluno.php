<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$databasePath = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $databasePath);

$student = new Student(null, 'Amanda Ester', new \DateTimeImmutable('2003-03-24'));

$sqlInsert = "INSERT INTO students (name, birth_date) VALUES  (?, ?)";

$statememnt = $pdo->prepare($sqlInsert);
$statememnt->bindValue(1,$student->name());
$statememnt->bindValue(2,$student->birthDate()->format('Y-m-d'));

if ($statememnt->execute()) {
    echo "Aluno incluido";
}