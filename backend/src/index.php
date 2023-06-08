<?php
require("db/database.php");
function register($username,$pass1,$email){

    $db=Database::getConnection();
    $sql = "INSERT INTO \"user\" (username, password, email) VALUES ($1, $2, $3)";

    $stm = pg_prepare($db, "my_query", $sql);
    $result = pg_execute($db, "my_query", array("{$username}", "{$pass1}", "{$email}"));
if (!$db) {
    die("Connection error: " . pg_last_error($db));
}
if (!$result) {
    die("Query execution error: " . pg_last_error($db));
} else {
    echo "Data inserted successfully.";
}
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST["username"];
    $pass1=$_POST["pass1"];
    $pass2=$_POST["pass2"];
    $email=$_POST["email"];
    register($username,$pass1,$email);



}
