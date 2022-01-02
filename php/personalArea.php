<?php
require_once("DBConnection.php");
use DB\DBConnection;

$HTMLPage = file_get_contents("../html/AreaPersonale.html");

if(!isset($_SESSION)) {
    session_start();
}

if(isset($_SESSION['login']) && $_SESSION['login'] == true){

    $mail = $_SESSION['email'];
    $username = $_SESSION['username'];
    $pw = $_SESSION['password'];
    $name = $_SESSION['name'];
    $surname = $_SESSION['surname'];
    $city = $_SESSION['city'];


    if(isset($_POST["submit"])){

        $errorMSG = "";

        //regular expression generati con il sito regex101.com/r
        //deve essere in formato email, non può contenere caratteri speciali riferiti a linguaggi (html, sql)
        $mail = $_POST["PEmail"];
        if(!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/",$mail)){
            $errorMSG .= "<li>Email non conforme</li>";
        }
        //deve essere almeno 3 caratteri e lunga 20, può contenere solo numeri e lettere
        $username = $_POST["PUsername"];
        if(!preg_match("/^[A-Z\d]{3,20}+$/i",$username)){
            $errorMSG .= "<li>Username non conforme</li>";
        }
        //PASSWORD lunga almeno 6 caratteri, deve contenere almeno un numero e una lettera, può contenere caratteri speciali ma non robe html e sql
        $pw = $_POST["PPassword"];

        //deve essere almeno 3 caratteri e lunga 30, può contenere solo lettere
        $name = $_POST["PName"];
        if(!preg_match("/^[A-Z]{2,30}+$/i",$name)){
            $errorMSG .= "<li>Nome non conforme</li>";
        }
        //deve essere almeno 3 caratteri e lunga 30, può contenere solo lettere
        $surname = $_POST["PSurname"];
        if(!preg_match("/^[A-Z]{2,30}+$/i",$surname)){
            $errorMSG .= "<li>Cognome non conforme</li>";
        }
        //deve essere almeno 3 caratteri e lunga 40, può contenere solo lettere
        $city = $_POST["PCity"];
        if($city && !preg_match("/^[A-Z]{2,40}+$/i",$city)){
            $errorMSG .= "<li>Città non conforme</li>";
        }



        if($errorMSG == ""){
            $connection = new DBConnection();
            $connectionOK = $connection->openDBConnection();

            if($connectionOK){
                if($_SESSION["email"] != $mail && $connection->checkEmailOnDB($mail)){
                    $errorMSG .= "<li>Email o Username già associato ad un account</li>";
                }
                if($_SESSION["username"] != $username && $connection->checkUsernameOnDB($username)){
                    $errorMSG .= "<li>Email o Username già associato ad un account</li>";
                }
                
                if($errorMSG == ""){
                    $queryResultDelete = $connection->deleteUser($_SESSION["username"]);
                    $queryResultNew = $connection->createNewUser($mail, $username, $pw, $name, $surname, $city);
                    if($queryResultNew && $queryResultDelete){
                        
                        $_SESSION['email'] = $mail;
                        $_SESSION['username'] = $username;
                        $_SESSION['password'] = $pw;
                        $_SESSION['name'] = $name;
                        $_SESSION['surname'] = $surname;
                        $_SESSION['city'] = $city;
                        
                        $mail = "";
                        $username = "";
                        $pw = "";
                        $name = "";
                        $surname = "";
                        $city = "";

                        $HTMLPage = str_replace("modificationNotDone", "modificationDone", $HTMLPage);
                        $HTMLPage = str_replace("personalAreaBox", "personalAreaBoxHidden", $HTMLPage);
                        
                        header( "refresh:4; url=personalArea.php" ); 
                    }else{
                        $errorMSG = "<li>Problemi di connessione, ci scusiamo per il disagio</li>";
                    }
                }
                $connection->closeDBConnection();
            }else{
                $errorMSG = "<li>Problemi di connessione, ci scusiamo per il disagio</li>";
            }
        }

        if($errorMSG){
            $openList = "<ul>";
            $closeList = "</ul>";
            $openList .= $errorMSG .= $closeList;
            $errorMSG = $openList;
        }

        $HTMLPage = str_replace("<!-- <userInputErrors/> -->", $errorMSG, $HTMLPage);
    

    }

    $HTMLPage = str_replace("<emailValue />", $mail, $HTMLPage);
    $HTMLPage = str_replace("<usernameValue />", $username, $HTMLPage);
    $HTMLPage = str_replace("<nameValue />" , $name, $HTMLPage);
    $HTMLPage = str_replace("<surnameValue />", $surname, $HTMLPage);
    $HTMLPage = str_replace("<cityValue />", $city, $HTMLPage);
    $HTMLPage = str_replace("<password />", $city, $HTMLPage);


}else{
$HTMLPage = "<p>HEY CHE CI FAI QUI??<p>";
}


echo $HTMLPage;

?>