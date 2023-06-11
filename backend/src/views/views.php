<?php

use DB\Database;

class API
{
    public $allowed_methods = array("GET");
    public $required_fields = array();
    public $fields = array();
    public $table;

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
                $req = array();
                foreach ($this->required_fields as $p) {
                    if (!in_array($p, array_keys($_POST))) {
                        array_push($req, array($p => "this field is required"));
                    }
                }
                if (count($req) != 0) {
                    $msg = array(...$req);
                    echo json_encode($msg);
                    exit;
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
                array_push($new_f, array($f => UploadHandler::uploader($f, array("png", "jpeg", "jpg", "gif"))));
            }
        }
        $data = array_merge($_POST, ...$new_f);

        Database::insert($this->table, $data);
    }
    function get()
    {
        $data = Database::filter($this->table, array("profile_pic" => "null"));
        echo json_encode($data);
        exit;
    }
    function patch()
    {
        try {
            $sub = get_path()[1];
            $usr = User::getObject((new User())->get(array("id" => $sub)));
        } catch (Exception $e) {
            http_response_code(404);
            $msg = array("detail" => "error updating");
        }
        (new User("", ""))->save();
    }
    function delete()
    {
    }
}
class APIView extends API
{
}
class UsersApi extends API
{
    public $allowed_methods = array("POST", "GET", "PATCH");
    public $required_fields = array("fname", "email", "password", "password2");
    public $fields = array("fname", "email", "password", "password2", "profile_pic");
    public $table = "user";


    function extras()
    {
        $pass1 = $_POST["password"];
        $pass2 = $_POST["password2"];
        unset($_POST["password2"]);

        if (strlen($pass1) < 6) {
            $msg = array("detail" => "Password is too short");
            http_response_code(400);
            echo json_encode($msg);
            exit;
        }
        if ($pass1 != $pass2) {
            $msg = array("detail" => "password fields must match");
            http_response_code(400);
            echo json_encode($msg);
            exit;
        }
    }
    // function get()
    // {
    // }
    function patch()
    {
        echo json_encode($_SERVER);
        exit;
    }
    function delete()
    {
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
        $usr = new User("", $email);

        $usr->password = $password;
        $json = $usr->get(array("email" => $email));


        $usr2 = User::getObject($json);

        if ($usr->password != $usr2->password) {
            http_response_code(404);
            $msg = array("detail" => "User with provided credentials is not found");
            echo json_encode($msg);
            exit;
        }
        $_SESSION["isloggedin"] = true;
        $_SESSION["userdata"] = $usr2->data;
    }
}
class DocumentsApi extends API
{
    public $allowed_methods = array("GET");

    function post()
    {
    }
    function get()
    {
        $msg = array("msg" => "Heloo");
        echo json_encode($msg);
    }
    function patch()
    {
    }
    function delete()
    {
    }
}
class LinksApi extends API
{
    public $allowed_methods = array("POST");


    function post()
    {
    }
    function get()
    {
    }
    function patch()
    {
    }
    function delete()
    {
    }
}
