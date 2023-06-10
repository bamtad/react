<?php

namespace DB;

use PDO;
use PDOException;

trait db_data
{
    // public static $db =Database::getConnection();
}
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
            $password = "mydatabase123";
            try {
                $db = new PDO("postgress:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
                Database::$con = $db;
            } catch (PDOException $e) {
                echo "Database Connection Error";
            }
        }
        return Database::$con;
    }
    public static function closeConnection()
    {
        if (Database::$con != null) {
            Database::$con->close();
        }
    }
    static function insert($table, $data)
    {
    }
    static function get($table, $data, $column, $q)
    {

        $db = Database::getConnection();

        $sql = "SELECT* FROM $table WHERE $column= :value";
        $stm = $db->prepare($sql);
        $stm->bindParam(":value", $q);

        $rs = $stm->execute();
    }
    static function update($table, $data)
    {
    }
    static function delete($table, $data)
    {
        // $db = Database::getConnection();
        // $sql = "Delete from $table  where $column= :value";
        // $stm->$db->prepare($sql);
        // $stm->bindParam(":value", $q);
        // $stm->execute();
    }
    static function filter($table, $data)
    {
        $sql = "SELECT* FROM $table WHERE";
        foreach ($data as $k => $v) {
            $sql += " AND $k=$v";
        }
        $db = Database::getConnection();
        $stm = $db->prepare($sql);
    }
}
