<?php
require("middlewares/common_middleware.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
} else {
    $msg = json_encode(array("detail" => $_SERVER["REQUEST_METHOD"] . " Method Not Allowed"));
    $msg = json_encode($_SERVER);

    http_response_code(405);
    echo $msg;
    exit;
}
