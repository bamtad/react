<?php

use DB\Database;

session_start();
require("middlewares/common_middleware.php");
require("middlewares/security_middleware.php");
require("views/views.php");

// Database::update("user", array("id" => 1, "fname" => "Murad", "lname" => "Hussen", "phone" => "0928808587"));
// exit;
function get_path()
{
    $path = $_SERVER["REQUEST_URI"];
    $params = explode("/", $path);
    $n_path = array();
    foreach ($params as $p) {
        if (trim($p) != "") {
            array_push($n_path, $p);
        }
    }
    return $n_path;
}
$path = get_path();
switch (array_shift($path)) {
    case "users":
        (new UsersApi())->view();
        break;
    case "login":
        (new LoginApi())->view();
        break;
    case "documents":
        (new DocumentsApi())->view();
        break;
    case "links":
        (new LinksApi)->view();
        break;
    case "address":
        break;
    case "":
        not_found();
        break;
    default:
        not_found();
}
