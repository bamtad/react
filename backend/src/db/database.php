<?php

namespace DB;

use PDO;
use PDOException;

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
            try {
                $db = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
                Database::$con = $db;
            } catch (PDOException $e) {
                echo "Database Connection Error" . $e;
                exit;
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
        $db = Database::getConnection();
        $columns = "";
        $values = "";
        $index = 0;
        foreach ($data as $column => $value) {
            if ($value == null) {
                continue;
            }
            if ($index != 0) {
                $columns = $columns . ",";
                $values = $values . ",";
            }
            $index += 1;

            $columns = $columns . " \"$column\"";
            $values = $values . " '$value'";
        }
        $sql = "INSERT INTO \"$table\" ($columns) VALUES ($values)";
        $stm = $db->prepare($sql);
        try {
            $stm = $stm->execute();
        } catch (PDOException $e) {
            http_response_code(400);
            if ($e->getCode() == 23505) {

                echo json_encode(array("detail" => $e->errorInfo[2]));
                exit;
            }

            echo json_encode(array("deatil" => $e->getMessage()));
        }
    }
    static function get($table, $data)
    {

        $db = Database::getConnection();

        $sql = "SELECT* FROM \"$table\" WHERE ";
        $addon = "";
        $index = 0;

        foreach ($data as $d => $v) {
            if ($index != 0) {
                $addon = $addon . " AND";
            }
            if (strtolower($v) == "null") {

                $addon = $addon . " \"$d\" is NULL";
            } else {
                $addon = $addon . " \"$d\" ILIKE '$v'";
            }
        }
        $sql = $sql . $addon;

        $stm = $db->prepare($sql);

        if (!$stm->execute()) {
            die("Error: " . $stm->errorInfo()[2]);
        }

        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) == 0) {
            return array();
        }

        return $result[0];
    }
    static function update($table, $data)
    {
        $columns = "";
        $index = 0;
        $id = $data["id"];
        unset($data["id"]);
        foreach ($data as $column => $value) {
            if ($value == null) {
                continue;
            }
            if ($index != 0) {
                $columns = $columns . ",";
            }
            $index += 1;

            $columns = $columns . " \"$column\"='$value'";
        }
        $sql = "UPDATE  \"$table\" set $columns where \"id\"= " . $id;
        $db = Database::getConnection();

        $stm = $db->prepare($sql);

        if (!$stm->execute()) {
            die("Error: " . $stm->errorInfo()[2]);
        }
    }
    static function delete($table, $data)
    {
        $db = Database::getConnection();

        $sql = "DELETE FROM \"$table\" WHERE ";
        $addon = "";
        $index = 0;

        foreach ($data as $d => $v) {
            if ($index != 0) {
                $addon = $addon . " AND";
            }
            $addon = $addon . " \"$d\" = '$v'";
        }
        $sql = $sql . $addon;

        $stm = $db->prepare($sql);

        if (!$stm->execute()) {
            die("Error: " . $stm->errorInfo()[2]);
        }
    }
    static function filter($table, $data)
    {

        $db = Database::getConnection();

        $sql = "SELECT* FROM \"$table\" WHERE ";
        $addon = "";
        $index = 0;

        foreach ($data as $d => $v) {
            if ($index != 0) {
                $addon = $addon . " AND";
            }
            if (strtolower($v) == "null") {

                $addon = $addon . " \"$d\" is NULL";
            } else {
                $addon = $addon . " \"$d\" ILIKE '$v'";
            }
        }
        $sql = $sql . $addon;

        $stm = $db->prepare($sql);

        if (!$stm->execute()) {
            die("Error: " . $stm->errorInfo()[2]);
        }

        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) == 0) {
            return array();
        }

        return $result;
    }
}
