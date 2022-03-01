<?php

class Connector
{
    private static bool $connected = false;
    private static string $dsn = "mysql:dbname=test;host=localhost";
    private static string $user = "root";
    private static string $password = "root";
    private static PDO $connection;

    public static function query(string $query, ...$args): array|bool
    {
        if (!self::$connected) {
            self::connect();
        }

        try {
            $pdoQuery = self::$connection->prepare($query);
            $pdoQuery->execute($args);
        } catch (Exception $e) {
            Responser::response(false, [], $e->getMessage());
        }

        return $pdoQuery->fetchAll();
    }

    private static function connect(): void
    {
        try {
            self::$connection = new PDO(self::$dsn, self::$user, self::$password);
        } catch (Exception $e) {
            Responser::response(false, [], $e->getMessage());
        }
    }
}