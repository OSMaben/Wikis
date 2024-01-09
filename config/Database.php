<?php

namespace app\config;

class Database
{
    private \PDO $connect;

    public function __construct($dbName = "wikis", $hostName = "localhost", $dbpass = "", $dbUser = "root")
    {
        try {
            $this->connect = new \PDO("mysql:host={$hostName};dbname={$dbName}", $dbUser, $dbpass);
        } catch (\PDOException $e) {
            echo "Failed to connect: " . $e->getMessage();
        }
    }

    public function prepare($sql)
    {
        return $this->connect->prepare($sql);
    }
}
