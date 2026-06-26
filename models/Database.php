<?php

class Database
{
    private static ?PDO $instance = null;

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;

            try {
                self::$instance = new PDO($dsn, DB_USER, DB_PASS, DB_OPTIONS);
            } catch (PDOException $e) {
                if (DEBUG_MODE) {
                    die('Erreur de connexion à la base de données : ' . $e->getMessage());
                }

                die('Une erreur est survenue lors de la connexion à la base de données.');
            }
        }

        return self::$instance;
    }
}
