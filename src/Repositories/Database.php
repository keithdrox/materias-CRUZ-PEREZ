<?php
declare(strict_types=1);

class Database {
    private static ?PDO $instance = null;

    public static function getConnection(): PDO {
        if (self::$instance === null) {
            $host = getenv('DB_HOST') ?: 'db';
            $port = getenv('DB_PORT') ?: '5432';
            $dbName = getenv('DB_NAME') ?: 'materias_db';
            $user = getenv('DB_USER') ?: 'postgres';
            $pass = getenv('DB_PASSWORD') ?: 'postgres';

            $dsn = "pgsql:host=$host;port=$port;dbname=$dbName";
            
            try {
                self::$instance = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]);
            } catch (PDOException $e) {
                die("Error de conexión a la base de datos.");
            }
        }
        return self::$instance;
    }
}
