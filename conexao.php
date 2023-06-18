<?php
//pdo == PHP Data Objects - interface para acessar diversos drivers do banco de dados
$databasePath = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $databasePath);

echo "Conectado";

$pdo->exec("INSERT INTO phones (area_code, number, student_id)
                     VALUES ('18','9974552655',1),('18','988066496',1) ");
exit();

$createTableSql = '
    CREATE TABLE IF NOT EXISTS students (
        id INTEGER PRIMARY KEY,
        name TEXT,
        birth_date TEXT
    );
    CREATE TABLE IF NOT EXISTS phones (
        id INTEGER PRIMARY KEY,
        area_code TEXT,
        number TEXT,
        student_id INTEGER,
        FOREIGN KEY(student_id) REFERENCES students(id)
    );

';
$pdo->exec($createTableSql);