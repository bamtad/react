<?php session_start();
    function  getCo(){
        $host = "db";
                $port = "5432";
                $dbname = "myphpdb";
                $user = "mure_ko";
                $password = "mypassword123";
                try {
                    $db = new PDO("pgsql:host=$host ;port=$port;dbname=$dbname;user=$user;password=$password");
                    return $db;
                } catch (PDOException $e) {
                    echo "Database Connection Error" . $e;
                    exit;
                }
    }
    function get($email){
        $sql="SELECT * from \"test\" where \"email\"='$email' ";
        $con=getCo();
        $stm=$con->prepare($sql);
        $stm->execute();
        return $stm->fetch(PDO::FETCH_ASSOC);
    }
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(!isset($_POST["email"])){
        die("Email is Required");
    }
    // if(!isset($_POST["password"])){
    //     die("Password is Required");

    // }
    $usr=get($_POST["email"]);
    // if($usr["password"]!=$_POST["password"]){
    //     die("Invalid Login Credentials");
    // }

    
    if($usr){
        $_SESSION["usr"]=$usr;
        // echo json_encode($usr);
        header("Location: test3.php");
    }



}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<form action="test1.php" method="post">
        <label for="email">Email*</label>
        <br/>
        <input required name="email" type="email"><br/>
        <label  for="fname">Name*</label>
        <br/>
        <!-- <input required name="fname" type="text"/> -->
        <br/>
        <input type="submit"/>

    </form>
    
</body>
</html>