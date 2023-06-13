<?php

namespace Alura\Pdo\infrastructure\Persistence;

use PDO;

class ConnectionCreator
{
    public static function createConnection(): PDO //Padrão Static Creation Method
    {
        $databasePath = __DIR__ . '/../../../banco.sqlite';
        return new PDO('sqlite:' . $databasePath);
    }
}