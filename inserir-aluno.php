<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$databasePath = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $databasePath);

$student = new Student(null, 'Jordan Douglas', new \DateTimeImmutable('2000-11-16'));

$sqlInsert = "INSERT INTO students (name, birth_date) VALUES  ('{$student->name()}', '{$student->birthDate()->format('Y-m-d')}')";

$pdo->exec($sqlInsert);