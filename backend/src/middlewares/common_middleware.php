<?php
function success_ok()
{
    http_response_code(200);
    echo json_encode(array("detail" => "Success"));
    exit;
}
function HttpResponse($body, $status_code = 200)
{
    header('Content-Type: application/json; charset=utf-8');
    http_response_code($status_code);
    echo json_encode($body);
    exit;
}
function multiparser(array &$a_data)
{
    // read incoming data
    $input = file_get_contents('php://input');

    // grab multipart boundary from content type header
    preg_match('/boundary=(.*)$/', $_SERVER['CONTENT_TYPE'], $matches);
    $boundary = $matches[1];

    // split content by boundary and get rid of last -- element
    $a_blocks = preg_split("/-+$boundary/", $input);
    array_pop($a_blocks);

    // loop data blocks
    foreach ($a_blocks as $id => $block) {
        if (empty($block))
            continue;


        if (strpos($block, 'application/octet-stream') !== FALSE) {
            // match "name", then everything after "stream" (optional) except for prepending newlines 
            preg_match("/name=\"([^\"]*)\".*stream[\n|\r]+([^\n\r].*)?$/s", $block, $matches);
        }
        // parse all other fields
        else {
            // match "name" and optional value in between newline sequences
            preg_match('/name=\"([^\"]*)\"[\n|\r]+([^\n\r].*)?\r$/s', $block, $matches);
        }
        $a_data[$matches[1]] = $matches[2];
    }
}

function getCurrentUser()
{
    if (isset($_SESSION['user'])) {

        return $_SESSION["user"];
    }
    return false;
}
