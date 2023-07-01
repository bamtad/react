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
    function get(array | string $field, $value = 0, bool $no_join = false)
    {
        $addon = $this->filters();
        if($no_join){
            $this->sql_f="SELECT * From \"$this->table\" ";
        }

        if (gettype($field) == "array") {
            return  Database::filter($this->table, $field,ini_str:$this->sql_f);
        }

        if ($field == "all") {
            if ("" != trim($addon)) {
                return  Database::fetch("$this->sql_f WHERE " . $addon);
            }
            return  Database::fetch("$this->sql_f");
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
    \"document\".\"doc_type\",s
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


   
    function extras()
    {
    }
}

class Spot extends Models
{
    public $table = "spot";
    public $sql_f = "SELECT
    \"spot\".\"id\",
    \"spot\".\"name\",
    \"spot\".\"description\",
    \"city\".\"id\" as \"city_id\",
    \"city\".\"name\" as \"city_name\",
    \"location\".\"lat\" as \"lat\",
    \"location\".\"long\" as \"long\"
from
    \"spot\"
    LEFT JOIN \"city\" on \"spot\".\"city\" = \"city\".\"id\"
    INNER JOIN \"location\" on \"location\".\"id\" = \"spot\".\"location\"";
}
class SpotType extends Models
{
    public $table = "spot_type";
    public $sql_f = "SELECT * FROM \"spot_type\"";
}
class Comment extends Models
{
    public $table = "comment";
    public $sql_f = "SELECT
    \"comment\".\"id\",
    \"comment\".\"body\",
    \"user\".\"id\" as \"user_id\",
    \"user\".\"fname\" as \"username\",
    \"file\".\"url\" as \"profile\",
    \"comment\".\"spot\"
from
    \"comment\"
    JOIN \"user\" on \"user\".\"id\" = \"comment\".\"user\"
    LEFT JOIN \"file\" on \"user\".\"profile_pic\" = \"file\".\"id\"";
}
class Rate extends Models
{
    public $table = "rate";
    public $sql_f = "SELECT * FROM \"rate\"";
}
class Images extends Models
{
    public $table = "image";
    public $sql_f = "SELECT * FROM \"image\"";
}
class City extends Models
{
    public $table = "city";
    public $sql_f = "SELECT * FROM \"city\"";
}
