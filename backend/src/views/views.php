<?php

use Db\Database;
use Models\User;
use Models\Document;
use Models\Link;

class API
{
    public $allowed_methods = array("GET");
    public $required_fields = array();
    public $fields = array();
    public $table;
    public $path_field = "id";
    static public $model;
    function getModel()
    {
        return new User();
    }

    function view()
    {
        $method = $_SERVER["REQUEST_METHOD"];
        if (!in_array($method, $this->allowed_methods)) {
            method_not_allowed();
        }
        $this->validateColumn($_POST);
        $this->validateColumn(($_FILES));
        switch ($method) {
            case "POST":
                if (count(get_path()) != 1) {
                    method_not_allowed();
                }
                $req = array();
                foreach ($this->required_fields as $p) {
                    if (!in_array($p, array_keys($_POST))) {
                        array_push($req, array($p => "this field is required"));
                    }
                }
                if (count($req) != 0) {
                    $msg = array(...$req);
                    HttpResponse($msg);
                }
                $this->post();
                break;
            case "PATCH":
                $this->patch();

                break;
            case "DELETE":
                $this->delete();
                break;
            case "GET":
                $this->get();
                break;
            default:
                not_found();
        }
    }
    function validateColumn(&$incoming)
    {

        foreach ($incoming as $inc => $i) {
            if (!in_array($inc, $this->fields)) {
                unset($incoming[$inc]);
            }
        }
    }
    function extras()
    {
    }
    function post()
    {
        $this->extras();
        $new_f = array();

        if (count($_FILES) != 0) {
            foreach ($_FILES as $f => $k) {
                array_push($new_f, array($f => UploadHandler::uploader($f, array("png", "jpeg", "jpg", "gif", "pdf"))));
            }
        }
        $data = array_merge($_POST, ...$new_f);

        Database::insert($this->table, $data);
    }
    function get()
    {
        $this->extras();
        $path = get_path();
        if (count($path) != 1) {
            $bd = ($this->getModel()->get($this->path_field, $path[1]));
            if (count($bd) == 0) {
                HttpResponse(array("detail" => "not found"), 404);
            }
            HttpResponse($bd[0], 200);
        }
        HttpResponse(($this->getModel()->get("all")), 200);
    }

    function patch()
    {
        $this->extras();
        $path = get_path();
        if (count($path) != 1) {
            $up = ($this->getModel())->update($path[1]);
            HttpResponse($up, 200);
        } else {
            method_not_allowed();
        }
        not_found();
    }
    function delete()
    {
        $this->extras();
        $path = get_path();
        if (count($path) != 1) {
            if (($this->getModel())->delete($path[1])) {
                HttpResponse(array("detail" => "Deleted Succesfully"), 200);
            };
        } else {
            method_not_allowed();
        }
        not_found();
    }
}
class APIView extends API
{
}
class UsersApi extends API
{
    public $allowed_methods = array("POST", "GET", "PATCH", "DELETE");
    public $required_fields = array("fname", "email", "password", "password2");
    public $fields = array("fname", "email", "password", "password2", "profile_pic");
    public $table = "user";

    function getModel()
    {
        return new User();
    }


    function extras()
    {
        $pass1 = $_POST["password"];
        $pass2 = $_POST["password2"];
        unset($_POST["password2"]);
        $_POST["created_at"] = date('Y-m-d H:i:s', time());
        $_POST["updated_at"] = date('Y-m-d H:i:s', time());

        if (strlen($pass1) < 6) {
            $msg = array("detail" => "Password is too short");
            HttpResponse($msg, 400);
        }
        if ($pass1 != $pass2) {
            $msg = array("detail" => "password fields must match");
            HttpResponse($msg, 400);
        }
    }
}
class LoginApi extends API
{
    public $allowed_methods = array("POST");
    public $required_fields = array("email", "password");
    function post()
    {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $usr = (new User())->get("email", $email);

        if ($usr["password"] === $password) {
            $_SESSION["user"] = $usr;
            HttpResponse(array("detail" => "Login succesfull"));
        }
        HttpResponse(array("detail" => "Invalid Login Credentials"), 404);
    }
}
class DocumentsApi extends API
{
    public $allowed_methods = array("GET", "DELETE", "POST", "PATCH");
    public $required_fields = array("name",);
    public $fields = array("name", "owner", "issued_by", "password2", "profile_pic");
    public $table = "document";
    function getModel()
    {
        return new Document();
    }
    function extras()
    {
        $_POST["issued_by"] = getCurrentUser()["id"];
        $_POST["created_at"] = date("Y-m-d H:i:s", time());
        $_POST["updated_at"] = date("Y-m-d H:i:s", time());
    }
}
class LinksApi extends API
{
    public $allowed_methods = array("POST", "GET", "PATCH", "DELETE");
    public $required_fields = array();
    public $table = "link";
    public $fields = array();
    function getModel()
    {
        return new Link();
    }
    function extras()
    {
    }
}
