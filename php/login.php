<?php
require_once("DBConnection.php");
use DB\DBConnection;

$HTMLPage = file_get_contents("../html/Login.html");


if(isset($_POST["submit"])){
    $errorMSG = "";

    $username = $_POST["LUsername"];
    if(!preg_match("/^[A-Z\d]{1,20}+$/i",$username)){
        $errorMSG = "<li>username non conforme</li>";
    }
    $password = $_POST["LPassword"];
    if(!preg_match("/^[A-Z\d]{1,20}+$/i",$password)){   
        $errorMSG .= "<li>password non conforme</li>";
    }

    if($errorMSG == ""){
        $connection = new DBConnection();
        $connectionOK = $connection->openDBConnection();

        if($connectionOK){
            $query = $connection->checkLoginCredentials($username, $password);
            if($query != ""){

                if(!isset($_SESSION['login'])) {
                    
                    session_start();
                    $_SESSION['login'] = true;
                    
    
                    $_SESSION['email'] = $query['email'];
                    $_SESSION['username'] = $query['username'];
                    $_SESSION['password'] = $query['password'];
                    $_SESSION['name'] = $query['name'];
                    $_SESSION['surname'] = $query['surname'];
                    $_SESSION['city'] = $query['city'];
                    
                    $HTMLPage = str_replace("loggedNotSuccessful", "loggedSuccessful", $HTMLPage);
                    $HTMLPage = str_replace("loginBox", "loginBoxHidden", $HTMLPage);
    
                    header( "refresh:5; url=home.php" ); 

                }else{
                    $errorMSG = "<li>Login error, Riprova</li>";
                    session_destroy();
                }

               
            }else{
                $errorMSG = "<li>Username e Password non corretti</li>";
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

    $HTMLPage = str_replace("<userInputErrors/>", $errorMSG, $HTMLPage);


}




echo $HTMLPage;
















?>