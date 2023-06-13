<?php
require(dirname(__DIR__) . "/models/user.php");
$content_type = explode(";", $_SERVER["CONTENT_TYPE"])[0];
if ($content_type != "application/json" && $content_type != "multipart/form-data" && $_SERVER["REQUEST_METHOD"] != "GET") {
    echo json_encode(array("detail" => "Un supported media type", "mime" => $content_type));
    exit;
}
function method_not_allowed()
{
    $method = $_SERVER["REQUEST_METHOD"];
    $msg = array("detail" => "/" . $method . "/ Method Not allowed");
    $msg = json_encode($msg);
    http_response_code(405);
    echo $msg;
    exit;
}
function not_found()
{
    http_response_code(404);
    $msg = array("detail" => "Not Found");
    echo json_encode($msg);
    exit;
}
function is_authenticated()
{
    if (isset($_SESSION["userdata"]) && $_SESSION["isloggedin"]) {
        return true;
    }
    return false;
}
function un_authorized()
{
    $msg = array("detail" => "You don't have enough permission");
    http_response_code(403);
    echo json_encode($msg);
    exit;
}
