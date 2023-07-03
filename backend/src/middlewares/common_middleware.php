<?php

use Imagick\Imagick;

function success_ok()
{
    http_response_code(200);
    echo json_encode(array("detail" => "Success"));
    exit;
}
function HttpResponse($body, $status_code = 200)
{
    header('Content-Type: application/json; charset=utf-8');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
    http_response_code($status_code);
    echo json_encode($body);
    exit;
}
function multiparser(&$a_data)
{
    // $a_data=array();
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

function pdf_image($path)
{
    $pdf = new Imagick($path);

    $pdf->setResolution(300, 300);

    // // Loop through each page of the PDF and convert it to an image
    foreach ($pdf as $page) {
        // Convert the PDF page to an image
        $image = clone $page;
        $image->setImageFormat('png');

        // Save the image file
        $filename = 'page_' . $page->getIndex() . '.png';
        $image->writeImage('/medias/' . $filename);
    }

    $pdf->destroy();
}
// if($_SERVER["REQUEST_METHOD"]=="PATCH"){
//     $type=$_SERVER["CONTENT_TYPE"];
//     $type=explode(";",$type);
//     HttpResponse($type);
// }
// function some()
// {

//     if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
//         $CHUNK = 8192;



//         try {

//             if (!($putData = fopen("php://input", "r")))

//                 throw new Exception("Can't get PUT data.");


//             // now the params can be used like any other variable


//             $tot_write = 0;

//             $tmpFileName = "/var/tmp/PUT_FILE";

//             // Create a temp file

//             if (!is_file($tmpFileName)) {

//                 fclose(fopen($tmpFileName, "x")); //create the file and close it

//                 // Open the file for writing

//                 if (!($fp = fopen($tmpFileName, "w")))

//                     throw new Exception("Can't write to tmp file");



//                 // Read the data a chunk at a time and write to the file

//                 while ($data = fread($putData, $CHUNK)) {

//                     $chunk_read = strlen($data);

//                     if (($block_write = fwrite($fp, $data)) != $chunk_read)

//                         throw new Exception("Can't write more to tmp file");



//                     $tot_write += $block_write;
//                 }



//                 if (!fclose($fp))

//                     throw new Exception("Can't close tmp file");



//                 unset($putData);
//             } else {

//                 // Open the file for writing

//                 if (!($fp = fopen($tmpFileName, "a")))

//                     throw new Exception("Can't write to tmp file");



//                 // Read the data a chunk at a time and write to the file

//                 while ($data = fread($putData, $CHUNK)) {

//                     $chunk_read = strlen($data);

//                     if (($block_write = fwrite($fp, $data)) != $chunk_read)

//                         throw new Exception("Can't write more to tmp file");



//                     $tot_write += $block_write;
//                 }



//                 if (!fclose($fp))

//                     throw new Exception("Can't close tmp file");



//                 unset($putData);
//             }



//             if ($tot_write != $file_size)

//                 throw new Exception("Wrong file size");



//             $md5_arr = explode(' ', exec("md5sum $tmpFileName"));

//             $md5 = $md5sum_arr[0];

//             if ($md5 != $md5sum)

//                 throw new Exception("Wrong md5");
//         } catch (Exception $e) {

//             echo '', $e->getMessage(), "\n";
//         }
//     }
// }
