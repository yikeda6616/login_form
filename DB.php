<?php

class DB
{
    public static function connect()
    {
        try {
            $dbh = 'mysql:dbname=login_form;host=localhost;charset=utf8mb4';
            $pdo = new PDO(
                $dbh,
                'root',
                'root',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );

            return $pdo;
        } catch (PDOException $e) {
            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            exit($e->getMessage());
        }
    }
}
