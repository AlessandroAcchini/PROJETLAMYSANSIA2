<?php

namespace App\Config;

use PDO;
use PDOException;

class Database
{
    // Connexion PDO unique (singleton simple)
    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {

            // ⚠ À ADAPTER à ta config Docker :
            $host     = '127.0.0.1';     // ou 'localhost'
            $port     = 3310;           // port MySQL (PAS le port phpMyAdmin 8030)
            $dbname   = 'db_sanctions'; // ex: 'projet_sanctions'
            $username = 'root';         // user MySQL
            $password = 'secret';         // mot de passe MySQL
            $charset  = 'utf8mb4';

            $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            try {
                self::$connection = new PDO($dsn, $username, $password, $options);
            } catch (PDOException $e) {
                // En dev : affiche l’erreur. En prod : log seulement.
                throw new PDOException(
                    'Erreur de connexion à la base de données : ' . $e->getMessage(),
                    (int) $e->getCode()
                );
            }
        }

        return self::$connection;
    }
}