<?php session_start();
?>
<?php function validate($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}
?>
<?php if($_SERVER["REQUEST_METHOD"]=="GET"){?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>
        body{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form{
            display: "flex";
            align-items:stretch;
            justify-content: center;
        }
    </style>
</head>
<body>
    <form action="test.php" method="post">
        <label for="email">Email*</label>
        <br/>
        <input required name="email" type="email"><br/>
        <label  for="fname">Name*</label>
        <br/>
        <input required name="fname" type="text"/>
        <br/>
        <label  for="fname">Suggestion*</label>
        <br/>
        <textarea name="sug"></textarea>
        <br/>
        <label for="gender">Gender*</label> <br/>
        <input type="radio" value="1" name="gender">
        <input type="radio" value="1" name="gender">
        <br/>
        <select name="dep[]" multiple>  
            <option  value="cse">CSE</option>
            <option  value="ece">ECE</option>
            <option  value="ecep">ECTP</option>
        </select>
        <br/>
        <input type="submit"/>
        


    </form>
    
</body>
</html>
<?php }?>
<?php 
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
function add($email,$fname,$sug,$gen){
    $con=getCo();
    $sql = "INSERT INTO \"test\" (\"email\",\"fname\",\"des\",\"gender\") VALUES (?,?,?,?)";
    $stmt=$con->prepare($sql);
    $stmt->bindParam(1,$email);
    $stmt->bindParam(2,$fname);
    $stmt->bindParam(3,$sug);

    $stmt->bindParam(4,$gen);
    $stmt->execute();

    $con=null;
    $stmt=null;

}
?>
<?php if($_SERVER["REQUEST_METHOD"]=="POST") {
    $email = validate($_POST["email"]);
    $fname = validate($_POST["fname"]);
    $sugg = validate($_POST["sug"]);
    $gen=validate($_POST["gender"]);

    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        die("Invalid email");
    }
    add($email,$fname,$sugg,$gen);


};

?>