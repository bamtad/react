<?php
class Database

{
    private static $con;
    public static function getConnection()
    {
        if (Database::$con == null) {
            $host = "db";
            $port = "5432";
            $dbname = "myphpdb";
            $user = "mure_ko";
            $password = "mypassword123";
            $db = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
            Database::$con = $db;
        }
        return Database::$con;
    }
}
