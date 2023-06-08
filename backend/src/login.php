<?php
require("db/database.php");
function login($username,$password){
   
};
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username = $_POST["username"];
    $pass1=$_POST["pass1"];

    $db=Database::getConnection();


}else{

    $s="<!DOCTYPE html>
    <html lang=\"en\">
    <head>
        <meta charset=\"UTF-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <script defer src=\"index.js\"></script>
        <title>Cool</title>
    </head>
    <body>
        <form action=\"index.php\" method=\"post\" id=\"form1\">
            <h1>Login Form</h1>
            <label for=\"username\">Username</label>
            <input type=\"text\" name=\"username\" id=\"username\">
            <br>
            <label for=\"pass\">Password</label>
            <input type=\"password\" name=\"pass1\" id=\"pass1\">
            <br>
    <input type=\"submit\" value=\"Register\">
            
        </form>
    </body>
    </html>";
    echo $s;

}
