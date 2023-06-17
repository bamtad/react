<?php
require(dirname(__DIR__) . "/models/user.php");
$content_type = explode(";", $_SERVER["CONTENT_TYPE"])[0];
if ($content_type != "application/json" && $content_type != "multipart/form-data" && $_SERVER["REQUEST_METHOD"] != "GET" && $_SERVER["REQUEST_METHOD"] === "PATCH") {
    HttpResponse(array("detail" => "Un supported media type", "mime" => $content_type), 415);
}

function method_not_allowed()
{
    header('Content-Type: application/json; charset=utf-8');
    $method = $_SERVER["REQUEST_METHOD"];
    $msg = array("detail" => "/" . $method . "/ Method Not allowed");
    HttpResponse($msg, 405);
}
function not_found()
{
    header('Content-Type: application/json; charset=utf-8');
    $msg = array("detail" => "Not Found");
    HttpResponse($msg, 404);
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
    header('Content-Type: application/json; charset=utf-8');
    $msg = array("detail" => "You don't have enough permission");
    HttpResponse($msg, 403);
}
