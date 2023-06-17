<?php

use Db\Database;
use Models\User;
use Models\Document;
use Models\Link;
use Models\File;

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
        $this->getPermission();
        $method = $_SERVER["REQUEST_METHOD"];
        if (!in_array($method, $this->allowed_methods)) {
            method_not_allowed();
        }
        switch ($method) {
            case "POST":
                $this->validateColumn($_POST);
                $this->validateColumn(($_FILES));
                if (count(get_path()) != 1) {
                    method_not_allowed();
                }
                $req = array();
                foreach ($this->required_fields as $p) {
                    if (!in_array($p, array_merge(array_keys($_POST), array_keys($_FILES)))) {
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
    function getPermission()
    {
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

        $id = Database::insert($this->table, $data);
        $data["id"] = $id;

        HttpResponse($data, 201);
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
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

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
}
class LoginApi extends API
{
    public $allowed_methods = array("POST");
    public $required_fields = array("email", "password");
    public $fields = array("email", "password");
    function post()
    {

        $email = $_POST["email"];
        $password = $_POST["password"];
        $usr = (new User())->get("email", $email, true);
        if (count($usr) == 0) {
            not_found();
        }
        $usr = $usr[0];

        if ($usr["password"] === $password) {
            $_SESSION["user"] = $usr;
            $_SESSION["logged_in"] = true;
            $_POST["last_login"] =  date("Y-m-d H:i:s", time());
            (new User())->update($usr["id"]);
            HttpResponse(array("detail" => "Login succesfull"));
        }
        HttpResponse(array("detail" => "Invalid Login Credentials"), 404);
    }
}
class LogoutApi extends API
{
    public $allowed_methods = array("GET");
    function get()
    {
        $_SESSION = array();

        // Destroy the session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // Destroy the session
        session_destroy();
        // Write HttpResponse
        HttpResponse(array("detail" => "Logout Succesfull"));
    }
}
class FileApi extends API
{
    public $allowed_methods = array("GET", "DELETE", "POST", "PATCH");
    public $required_fields = array("file");
    public $fields = array("file");
    public $table = "file";
    function getModel()
    {
        return new  File();
    }
}
class DocumentsApi extends API
{
    public $allowed_methods = array("GET", "DELETE", "POST", "PATCH");
    public $required_fields = array("name", "url");
    public $fields = array("name", "owner", "url", "description");
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
    function getPermission()
    {
        if (!getCurrentUser()) {
            HttpResponse(array("detail" => "needs authentication"), 401);
        }
        $path = get_path();
        if (count($path) != 1) {
            $bd = ($this->getModel()->get($this->path_field, $path[1]));
            if (count($bd) == 0) {
                HttpResponse(array("detail" => "not found"), 404);
            }
            if ($bd["issued_by"] != getCurrentUser()["id"]) {
                HttpResponse(array("detail" => "Not Allowed"), 403);
            }
        }
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
