<?php

use Alura\Pdo\infrastructure\Persistence\ConnectionCreator;
use Alura\Pdo\infrastructure\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

$connection = ConnectionCreator::createConnection();
$repository = new PdoStudentRepository($connection);

$studentList = $repository->studentsWithPhones();

var_dump($studentList);
