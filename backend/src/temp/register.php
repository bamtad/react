<?php

use DB\Database;

require("db/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    Database::insert("user", array("fname" => $_POST["fname"], "password" => $_POST["pass1"], "email" => $_POST["email"]));
    echo "Succesfully registered";
}
