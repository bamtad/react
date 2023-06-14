<?php
header('Content-Type: application/json; charset=utf-8');
// header("Location: http://dev.temarico.com/");
// exit;
// header("status_code: 400");
// header("key: murad");
function success_ok()
{
    http_response_code(200);
    echo json_encode(array("detail" => "Success"));
    exit;
}
