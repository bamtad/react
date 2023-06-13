<?php
class UploadHandler
{

    static function uploader($field, $filexts, $limit = 200000)
    {
        $target_dir = "/medias/";
        $target_file = $target_dir . basename($_FILES[$field]["name"]);
        $type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if ($_FILES[$field]["size"] > $limit) {
            http_response_code(400);
            echo json_encode(array("detail" => "Uploaded file is too large"));
            exit;
        }
        if (!in_array($type, $filexts)) {
            http_response_code(400);
            echo json_encode(array("detail" => "File type not allowed"));
            exit;
        }
        if (file_exists($target_file)) {
            $target_file = strstr($target_file, "." . $type, true) . time() . ".$type";
        }

        if (move_uploaded_file($_FILES[$field]["tmp_name"], $target_file)) {
        } else {
            http_response_code(400);
            echo "Some kind of error";
            exit;
        }
        return $target_file;
    }
}
