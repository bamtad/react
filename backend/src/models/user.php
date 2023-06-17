<?php

namespace Models;

use DB\Database;

require(dirname(__DIR__) . "/db/database.php");
class Models
{
    public $table;
    private $id;
    public $data;
    public $sql_f;
    public $sql_i;
    public $sql_u = "UPDATE \"user\" set   \"profile_pic\" = 3
    where
        \"id\" <= 100";
    public $filter_field = "u";
    public $sql_d;
    function get($field, $value = 0, $no_join = false)
    {
        $addon = $this->filters();
        // HttpResponse(array("detail" => "SELECT* From \"$this->table\" WHERE \"$field\"='$value'" . " WHERE " . $addon));

        if ($field == "all" && !$no_join) {
            if ("" != trim($addon)) {
                return  Database::fetch("SELECT* From \"$this->table\" WHERE " . $addon);
            }
            return  Database::fetch("SELECT* From \"$this->table\"");
        } else if ($field == "all") {
            if ("" != trim($addon)) {
                return Database::fetch("SELECT* From \"$this->table\" WHERE \"$field\"='$value'" . " and " . $addon);
            }
            return Database::fetch("SELECT* From \"$this->table\" WHERE \"$field\"='$value'");
        }
        if ("" != trim($addon)) {
            return  Database::fetch($this->sql_f . " WHERE \"$this->table\".\"$field\"='$value'"  . " and " . $addon);
        }
        return  Database::fetch($this->sql_f . " WHERE \"$this->table\".\"$field\"='$value'");
    }
    public function filters()
    {
        return "";
    }
    function save()
    {
        $db = Database::insert($this->table, $this->data);
    }
    function delete($id)
    {
        $obj = $this->get("id", $id, true);

        if (!$obj || count($obj) == 0) {
            not_found();
        }

        $db = Database::delete($this->table, array("id" => $id));
        return true;
    }

    function update($id)
    {
        $data = json_decode(file_get_contents("php://input")) ?? array();
        $_POST = array_merge($_POST, $data);
        $ll = $this->get("id", $id, true)[0];
        if (!$ll || count($ll) == 0) {
            not_found();
        }
        foreach ($_POST as $key => $value) {
            $ll[$key] = $value;
        }
        $ll["id"] = $id;
        Database::update($this->table, $ll);

        return $ll;
    }
}
class User extends Models
{
    public $id;
    public $fname;
    public $lname;
    public $phone;
    public $email;
    public $profile_pic;
    public $bg_pic;
    public $address;
    public $userType;
    public $is_authenticated = false;
    public $table = "user";
    public $password;
    public $sql_f = "SELECT \"user\".\"id\",\"user\".\"fname\",\"user\".\"password\",\"user\".\"lname\",\"user\".\"email\",\"user\".\"phone\",\"user\".\"is_verified\",\"user\".\"user_type\",\"user\".\"last_login\",\"user\".\"updated_at\",\"user\".\"created_at\",\"file\".\"url\" as \"profile_pic\",\"file2\".\"url\" as \"bg_pic\" From \"user\" LEFT JOIN \"file\" on \"file\".\"id\" = \"user\".\"profile_pic\" LEFT JOIN \"file\" as \"file2\" on \"file2\".\"id\" = \"user\".\"bg_pic\" ";
}

class File extends Models
{
    public $sql_f = "SELECT* FROM \"file\" ";
    public $table = "file";
}
class Document extends Models
{
    public $table = "document";
    public $sql_f = "SELECT
    \"document\".\"id\" as \"id\",
    \"document\".\"name\",
    \"document\".\"owner\",
    \"document\".\"description\",
    \"document\".\"is_revoked\",
    \"document\".\"updated_at\",
    \"document\".\"doc_type\",
    \"document\".\"created_at\",
    \"document\".\"issued_at\",
    \"document\".\"issued_by\",
    \"file\".\"url\" as \"url\"
FROM
    \"document\"
    JOIN \"file\" on \"file\".\"id\" = \"document\".\"url\"";
    public function filters()
    {
        $owner = getCurrentUser()["id"];
        return " \"owner\" = $owner or \"issued_by\"=$owner";
    }
}
class Link extends Models
{
    public $table = "link";
    public $sql_f = "SELECT* FROM \"link\" ";


    private function gen_url($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $randomString;
    }
    function extras()
    {
    }
}
