<?php

use DB\Database;
use Imagick\Imagick;

class UploadHandler
{

    static function uploader($field, $filexts, $limit = 20000000)
    {
        $target_dir = "/medias/";
        $target_file = $target_dir . basename(strtolower(str_replace(" ", "", $_FILES[$field]["name"])));
        $type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if ($_FILES[$field]["size"] > $limit) {
            HttpResponse(array("detail" => "Uploaded file is too large"), 413);
        }
        if (!in_array($type, $filexts)) {
            HttpResponse(array("detail" => "File type not allowed"), 400);
        }
        if (file_exists($target_file)) {
            $target_file = strstr($target_file, "." . $type, true) . time() . ".$type";
        }

        if (move_uploaded_file($_FILES[$field]["tmp_name"], $target_file)) {
            $id = Database::insert("file", array("url" => $target_file));
            return $id;
        } else {
            error_log("File upload error: " . $_FILES[$field]["error"]);
            error_log("Target file: " . $target_file);
            HttpResponse(array("detail" => "Bad Request"), 400);
        }
    }
    static function uplaod_many($field, $filexts, $limit = 20000000, $table = "file")
    {
        $target_dir = "/medias/";
        $up = array();
        for ($i = 0; $i < count($_FILES[$field]["name"]); $i++) {
            $target_file = $target_dir . basename(strtolower(str_replace(" ", "", $_FILES[$field]["name"][$i])));
            $type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if ($_FILES[$field]["size"][$i] > $limit) {
                HttpResponse(array("detail" => "Uploaded file is too large"), 413);
            }
            if (!in_array($type, $filexts)) {
                HttpResponse(array("detail" => "File type not allowed"), 400);
            }
            if (file_exists($target_file)) {
                $target_file = strstr($target_file, "." . $type, true) . time() . ".$type";
            }

            if (move_uploaded_file($_FILES[$field]["tmp_name"][$i], $target_file)) {
                $id = Database::insert($table, array("url" => $target_file));
                $up[$i] = $id;
            } else {
                error_log("File upload error: " . $_FILES[$field]["error"]);
                error_log("Target file: " . $target_file);
                HttpResponse(array("detail" => "Bad Request"), 400);
            }
        }
        return $up;
    }
}
