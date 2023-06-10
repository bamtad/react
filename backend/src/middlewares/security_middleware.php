<?php
function method_not_allowed()
{
    $method = $_SERVER["REQUEST_METHOD"];
    $msg = array("detail" => "/" . $method . "/ Method Not allowed");
    $msg = json_encode($msg);
    echo $msg;
    exit;
}
