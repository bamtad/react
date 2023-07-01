<?php 
session_start();
if(!isset($_SESSION["usr"])){
    header("Location: test1.php");
}
?>
<h1> <?php echo $_SESSION["usr"]["email"] ?></h1><br/>
<h1> <?php echo $_SESSION["usr"]["fname"] ?></h1><br/>
;
