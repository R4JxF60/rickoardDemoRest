<?php

class Database {

    private static $dsn = 'mysql:host=localhost;dbname=rickoard_db';
    private static $username = 'root';
    private static $password = 'mysql';
    private static $DBConnection;

    public static function getDBConnection() {
        if(self::$DBConnection === null){
            self::$DBConnection = new PDO(self::$dsn, self::$username, self::$password);
            self::$DBConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$DBConnection;
    }
}