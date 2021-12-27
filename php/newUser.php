<?php
require_once("DBConnection.php");
use DB\DBConnection;

$HTMLPage = file_get_contents("../html/Register.html");

$mail = "";
$username = "";
$pw = "";
$name = "";
$surname = "";
$city = "";


if(isset($_POST["submit"])){

    $errorMSG = "";

    //regular expression generati con il sito regex101.com/r
    //deve essere in formato email, non può contenere caratteri speciali riferiti a linguaggi (html, sql)
    $mail = $_POST["REmail"];
    if(!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/",$mail)){
        $errorMSG .= "<li>Email non conforme</li>";
    }
    //deve essere almeno 3 caratteri e lunga 20, può contenere solo numeri e lettere
    $username = $_POST["RUsername"];
    if(!preg_match("/^[A-Z\d]{3,20}+$/i",$username)){
        $errorMSG .= "<li>Username non conforme</li>";
    }
    //PASSWORD lunga almeno 6 caratteri, deve contenere almeno un numero e una lettera, può contenere caratteri speciali ma non robe html e sql
    $pw = $_POST["RPassword"];
    if(!preg_match("/^(?=.*[0-9])(?=.*[a-z])[a-zA-Z0-9!.@#$%^&*]{6,16}$/",$pw)){   
        $errorMSG .= "<li>Password non conforme</li>";
    }
    //deve essere almeno 3 caratteri e lunga 30, può contenere solo lettere
    $name = $_POST["RName"];
    if(!preg_match("/^[A-Z]{2,30}+$/i",$name)){
        $errorMSG .= "<li>Nome non conforme</li>";
    }
    //deve essere almeno 3 caratteri e lunga 30, può contenere solo lettere
    $surname = $_POST["RSurname"];
    if(!preg_match("/^[A-Z]{2,30}+$/i",$surname)){
        $errorMSG .= "<li>Cognome non conforme</li>";
    }
    //deve essere almeno 3 caratteri e lunga 40, può contenere solo lettere
    $city = $_POST["RCity"];
    if(!preg_match("/^[A-Z]{2,40}+$/i",$city)){
        $errorMSG .= "<li>Città non conforme</li>";
    }

    if($errorMSG == ""){
        $connection = new DBConnection();
        $connectionOK = $connection->openDBConnection();

        $queryResult;
        if($connectionOK){
            if($connection->checkEmailOnDB($mail)){
                $errorMSG .= "<li>Email già associata ad un account</li>";
            }
            if($connection->checkUsernameOnDB($username)){
                $errorMSG .= "<li>Username già associato ad un account</li>";
            }

            if($errorMSG == ""){
                $queryResult = $connection->createNewUser($mail, $username, $pw, $name, $surname, $city);
                if($queryResult){
                    $mail = "";
                    $username = "";
                    $pw = "";
                    $name = "";
                    $surname = "";
                    $city = "";

                }else{
                    $errorMSG .= "<li>Problemi di connessione, ci scusiamo per il disagio</li>";
                }
            }

        } 
    }
    $HTMLPage = str_replace("<userInputErrors/>", $errorMSG, $HTMLPage);
    
 

}


$HTMLPage = str_replace("<emailValue />", $mail, $HTMLPage);
$HTMLPage = str_replace("<usernameValue />", $username, $HTMLPage);
$HTMLPage = str_replace("<nameValue />" , $name, $HTMLPage);
$HTMLPage = str_replace("<surnameValue />", $surname, $HTMLPage);
$HTMLPage = str_replace("<cityValue />", $city, $HTMLPage);

echo $HTMLPage;






?>