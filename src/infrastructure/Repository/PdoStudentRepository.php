<?php

namespace Alura\Pdo\infrastructure\Repository;

use Alura\Pdo\Domain\Model\Student;

use Alura\Pdo\Domain\Repository\StudentRepository;

use PDO;

class PdoStudentRepository implements StudentRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }
    public function allStudents(): array
    {
        $allQuery = 'SELECT * FROM students;';
        $stmt = $this->connection->query($allQuery);

        return $this->hydrateStudentList($stmt);
    }

    public function studentsBirthAt(\DateTimeImmutable $birthDate): array
    {
        $dateQuery = 'SELECT * FROM students WHERE birth_date = ?';
        $stmt = $this->connection->prepare($dateQuery);
        $stmt->bindValue(1, $birthDate->format('Y-m-d'));
        $stmt->execute();
        return $this->hydrateStudentList($stmt);
    }

    public function hydrateStudentList(\PDOStatement $stmt): array
    {
        $studentDataList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $studentList = [];

        foreach ($studentDataList as $studentData) {
            $studentList = new Student(
                $studentData['id'],
                $studentData['name'],
                new \DateTimeImmutable($studentData['birth_date'])
            );
        }
        return $studentList;
    }


    public function save(Student $student): bool
    {
        if ($student->id() === null) {
            return $this->insert($student);
        }
        return $this->update($student);
    }

    public function insert(Student $student): bool
    {
        $insertQuery = 'INSERT INTO students (name, birth_date) VALUES (:name, :birth_date);';
        $stmt = $this->connection->prepare($insertQuery);

        $success = $stmt->execute([
           ':name' => $student->name(),
            ':birth_date' => $student->birthDate()->format('Y-m-d'),
        ]);
        if ($success) {
            $student->defineId($this->connection->lastInsertId());
        }
        return $success;
    }

    public function update(Student $student)
    {
        $updateQuery = 'UPDATE students SET nam = :name, birth_date = :birth_date WHERE id = :id;';
        $smtp = $this->connection->prepare($updateQuery);
        $smtp->bindValue(':name', $student->name());
        $smtp->bindValue(':birth_date', $student->birthDate()->format('Y-m-d'));
        $smtp->bindValue(':id', $student->id(), PDO::PARAM_INT);

        return $smtp->execute();
    }
    public function remove(Student $student): bool
    {
        $statement = $this->connection->prepare('DELETE FROM students WHERE id = ?');
        $statement->bindValue(1,$student->id(), PDO::PARAM_INT);
        return $statement->execute();
    }
}

