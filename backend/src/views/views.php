<?php

use Db\Database;
use Models\User;
use Models\Document;
use Models\Link;
use Models\Spot;
use Models\File;
use Models\Comment;
use Models\Images;
use Models\Rate;
use Models\SpotType;
use Models\City;

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
        // HttpResponse($_POST);
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
                    HttpResponse($msg,400);
                }
                HttpResponse($this->post(), 201);
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
        if (!getCurrentUser()) {
            HttpResponse(array("detail" => "needs authentication"), 401);
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
    function isAuthenticated(){

    }
    function isAdminUser(){


    }
    function post()
    {
        $new_f = array();

        if (count($_FILES) != 0) {
            foreach ($_FILES as $f => $k) {
                array_push($new_f, array($f => UploadHandler::uploader($f, array("png", "jpeg", "jpg", "gif", "pdf"))));
            }
        }
        $data = array_merge($_POST, ...$new_f);

        $id = Database::insert($this->table, $data);
        $data["id"] = $id;

        return $data;
    }
    function get()
    {
        $path = get_path();

        if (count($path) != 1) {
            $bd = ($this->getModel()->get($this->path_field, $path[1]));
            if (count($bd) == 0) {
                HttpResponse(array("detail" => "not found"), 404);
            }
            HttpResponse($bd[0], 200);
        }
        if (count($_SERVER["argv"]) != 0) {
            $params = explode("&", $_SERVER["argv"][0]);
            $item = array();
            foreach ($params as $par) {
                $q = explode("=", $par);
                if (count($q) < 2) {
                    continue;
                }
                $item[$q[0]] = $q[1];
            }
            $this->validateColumn($item);
            if (count($item) != 0) {
                $bd = ($this->getModel()->get($item));
                HttpResponse($bd);
            }
        }

        HttpResponse(($this->getModel()->get("all")), 200);
    }

    function patch()
    {
        $path = get_path();
        $data = json_decode(file_get_contents("php://input")) ?? array();
        $_POST =$data;
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


    function post()
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
        parent::post();
    }
    function get()
    {
        $this->getPermission();
        parent::get();
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
            return array("detail" => "Login Succesfull");
        }
        HttpResponse(array("detail" => "Invalid Login Credentials"), 404);
    }
    function getPermission()
    {
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
    public $fields = array("file","user","spot");
    public $table = "file";
    function getModel()
    {
        return new  File();
    }
    function post(){
        $user=null;
        if(isset($_POST["user"])){
            $user=$_POST["user"];
            unset($_POST["user"]);
        }
        $data=parent::post();
        if($user!=null){
            Database::update("user",array("profile_pic"=>$data["id"]));
        }


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
    function post()
    {
        $_POST["issued_by"] = getCurrentUser()["id"];
        $_POST["created_at"] = date("Y-m-d H:i:s", time());
        $_POST["updated_at"] = date("Y-m-d H:i:s", time());
        return parent::post();
    }
    function getPermission()
    {
        parent::getPermission();
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
    public $required_fields = array("name","documents","users");
    public $table = "link";
    public $fields = array("name","documents","users");
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
    function getModel()

    {
        return new Link();
    }
    function post()
    {
        $_POST["url"]= $this->gen_url();
        $_POST["owner"]=getCurrentUser()["id"];
        $docs=$_POST["documents"];
        $usr=$_POST["users"];
        // HttpResponse($_POST);
        unset($_POST["documents"]);
        unset($_POST["users"]);
        $data=parent::post();
        foreach($docs as $did)
        Database::insert("doc_link",array("link"=>$data["id"],"document"=>$did));
        foreach($usr as $u)
        Database::insert("link_permission",array("user"=>$u,"link"=>$data["id"]));

        return $data;
    }
}

class SpotApi extends API
{
    public $allowed_methods = array("POST", "GET", "PATCH", "DELETE");
    public $required_fields = array("lat", "long", "name", "description", "spot_type");
    public $fields = array("lat", "long", "city", "name", "description", "spot_type");
    public $table = "spot";
    function getModel()
    {
        return new Spot();
    }
    function post()
    {
        $type = $_POST["spot_type"];
        unset($_POST["spot_type"]);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $location = Database::insert("location", array("lat" => $_POST["lat"], "long" => $_POST["long"], "city" => isset($_POST["city"]) ? $_POST["city"] : null));
            unset($_POST["lat"]);
            unset($_POST["long"]);
            $_POST["location"] = $location;
        }
        $data = parent::post();
        Database::insert("spot_type_spot", array("spot" => $data["id"], "type" => $type));
        $data["spot_type"] = $type;
        return $data;
    }
    function getPermission()
    {
    }
    function patch()
    {
        // HttpResponse($_POST);
        return parent::patch();
    }
}

class SpotTypeApi extends API
{
    public $allowed_methods = array("POST", "GET", "PATCH", "DELETE");
    public $required_fields = array("name");
    public $fields = array("name");
    public $table = "spot_type";
    function getModel()
    {
        return new SpotType();
    }
    function getPermission()
    {
        
    }
}
class CityApi extends API
{
    public $allowed_methods = array("POST", "GET", "PATCH", "DELETE");
    public $required_fields = array("name");
    public $fields = array("name");
    public $table = "city";
    function getModel()
    {
        return new City();
    }
}
class CommentApi extends API
{
    public $allowed_methods = array("POST", "GET", "PATCH", "DELETE");
    public $required_fields = array("spot", "body");
    public $fields = array("spot", "body");
    public $table = "comment";

    function getModel()
    {
        return new Comment();
    }
    function post(){
        $id=getCurrentUser()["id"];
        $_POST["user"]=$id;
        return parent::post();
    }
    function getPermission()
    {
        
    }
}
class RateApi extends API
{
    public $allowed_methods = array("POST", "GET", "PATCH", "DELETE");
    public $required_fields = array("spot", "rate_num");
    public $fields = array("spot", "rate_num", "id");
    public $table = "rate";

    function getModel()
    {
        return new Rate();
    }
    function getPermission()
    {
        
    }
    
}
class ImagesApi extends API
{
    public $allowed_methods = array("POST", "GET", "PATCH", "DELETE");
    public $required_fields = array("images");
    public $fields = array("images", "city", "spot");
    public $table = "image";

    function getModel()
    {
        return new Images();
    }
    function post()
    {
        $ids = UploadHandler::uplaod_many($this->table . "s", array("png", "jpeg", "jpg", "gifs"), table: $this->table);
        $url = array();
        foreach ($ids as $id) {
            Database::update($this->table, array("id" => $id, "spot" => isset($_POST["spot"]) ? $_POST["spot"] : null, "city" => isset($_POST["city"]) ? $_POST["city"] : null));
            array_push($url, (new Images())->get("id", $id));
        }

        return array_merge($_POST, array("images" => $url));
    }
    function getPermission(){

    }
}
