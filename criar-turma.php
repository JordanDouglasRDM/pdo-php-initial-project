<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\infrastructure\Persistence\ConnectionCreator;
use Alura\Pdo\infrastructure\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

try{
    $connection = ConnectionCreator::createConnection();
    $studentRepository = new PdoStudentRepository($connection);

//realizo processos de definição da turma
    $connection->beginTransaction();// inicia a transação
    $aStudent = new Student(
        null,
        'Nico Steppat',
        new \DateTimeImmutable('1985-05-01')
    );

    $studentRepository->save($aStudent);

    $anotherStudent = new Student(
        null,
        'Jordan Douglas',
        new \DateTimeImmutable('2000-11-16')
    );
    $studentRepository->save($anotherStudent);
    $connection->commit();//salva e executa a transação
}catch (\RuntimeException $e) {
    echo $e->getMessage();
    $connection->rollBack();// desfaz alterações da minha transação
}

//inserir os alunos da turma