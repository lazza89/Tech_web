<?php
require_once("DBConnection.php");
use DB\DBAccess;

$HTMLPage = file_get_contents("../html/Register.html");

$mail = "";
$username = "";
$pw = "";
$name = "";
$surname = "";
$city = "";

$errorMSG = "";

if(isset($_POST["submit"])){

    $mail = $_POST["REmail"];
    if(strlen($mail)==0){
        $errorMSG .= "<p>Mail non presente</p>";
    }

    $username = $_POST["RUsername"];
    if(strlen($username)==0){
        $errorMSG .= "<p>username non presente</p>";
    }

    $pw = $_POST["RPassword"];
    if(strlen($pw)==0){
        $errorMSG .= "<p>pw non presente</p>";
    }

    $name = $_POST["RName"];
    if(strlen($name)==0){
        $errorMSG .= "<p>name non presente</p>";
    }

    $surname = $_POST["RSurname"];
    if(strlen($surname)==0){
        $errorMSG .= "<p>surname non presente</p>";
    }

    $city = $_POST["RCity"];
    if(strlen($city)==0){
        $errorMSG .= "<p>city non presente</p>";
    }

    if($errorMSG==""){
        $mail = 0;
        $username = 0;
        $pw = 0;
        $name = 0;
        $surname = 0;
        $city = 0;
    }


    //$connessione = new DBAccess();
    $connessioneOk = $connessione->openDBConnection();

    if($connessioneOk){
        $queryResult = $connessione->createNewUser($mail, $username, $pw, $name, $surname, $city);
    }

    if($queryResult){
        $errorMSG = "<h1 id=\"registrati\">LESGHEREE</h1>";
    }
    
    $HTMLPage = str_replace("<h1 id=\"registrati\">Registrati</h1>", $errorMSG, $HTMLPage);

}


$HTMLPage = str_replace("<emailValue />", $mail, $HTMLPage);
$HTMLPage = str_replace("<usernameValue />", $username, $HTMLPage);
$HTMLPage = str_replace("<nameValue />" , $pw, $HTMLPage);
$HTMLPage = str_replace("<surnameValue />", $name, $HTMLPage);
$HTMLPage = str_replace("<cityValue />", $surname, $HTMLPage);

echo $HTMLPage;



































?>