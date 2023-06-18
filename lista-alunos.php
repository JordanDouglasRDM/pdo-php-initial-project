<?php

use Alura\Pdo\infrastructure\Persistence\ConnectionCreator;
use Alura\Pdo\infrastructure\Repository\PdoStudentRepository;

require_once 'vendor\autoload.php';
$pdo = ConnectionCreator::createConnection();
$repository = new PdoStudentRepository($pdo);

$studentList = $repository->allStudents();
var_dump($studentList);



