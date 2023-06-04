<?php
require("db/database.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

Database::getConnection();
$name = $_GET["name"];
$l = json_encode(array("kool" => getallheaders()));
echo $l;
