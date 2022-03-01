<?php

class Connector
{
    private static bool $connected = false;
    private static string $dsn = "mysql:dbname=test;host=localhost";
    private static string $user = "root";
    private static string $password = "root";
    private static PDO $connection;

    public static function query(string $query, array $args = []): array|bool
    {
        if (!self::$connected) {
            self::connect();
        }

        try {
            $pdoQuery = self::$connection->prepare($query);
            foreach ($args as $index => $arg) {
                $pdoQuery->bindValue($index + 1, $arg);
            }
            $pdoQuery->execute();
        } catch (Exception $e) {
            Responser::response(false, [], $e->getMessage());
        }

        return $pdoQuery->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function connect(): void
    {
        try {
            self::$connection = new PDO(self::$dsn, self::$user, self::$password);
            self::$connected = true;
        } catch (Exception $e) {
            Responser::response(false, [], $e->getMessage());
        }
    }
}