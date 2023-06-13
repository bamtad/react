<?php

use DB\Database;

require(dirname(__DIR__) . "/db/database.php");
class Models
{
    public $fields = array();
    public $table;
    private $id;
    public $data;
    function get($query)
    {
        $db = Database::get($this->table, $query);
        if (!$db) {
            not_found();
        }
        $this->data = $db;
        $this->id = $db["id"];
        return $db;
    }
    function save()
    {
        $db = Database::insert($this->table, $this->data);
    }
    function delete()
    {

        $db = Database::delete($this->table, array("id" => $this->id));
    }

    function update()
    {
    }
}
class User extends Models
{
    private $id;
    private $fname;
    private $lname;
    private $phone;
    private $email;
    private $profile_pic;
    private $bg_pic;
    private $address;
    private $userType;
    public $is_authenticated = false;
    public $table = "user";
    public $password;
    // function __construct($fname, $email)
    // {
    //     $this->fname = $fname;
    //     $this->email = $email;
    // }

    static function filter()
    {
    }

    static function getObject($arr)

    {
        $usr = new User($arr["fname"], $arr["email"]);
        $usr->id = $arr["id"];
        $usr->lname = $arr["lname"];
        $usr->phone = $arr["phone"];
        $usr->profile_pic = $arr["profile_pic"];
        $usr->bg_pic = $arr["bg_pic"];
        $usr->data = $arr;
        $usr->password = $arr["password"];

        return $usr;
    }
}
