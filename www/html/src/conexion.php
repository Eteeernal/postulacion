<?php

$db ="mydb";
$user = "root";
$password = "secret";
$host = "mysql";

class Connection
{

    public static function make($host, $db, $user, $password)
    {
        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

        try {
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

            return new PDO($dsn, $user, $password, $options);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}

return Connection::make($host, $db, $user, $password);