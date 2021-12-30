<?php
require_once("DBConnection.php");
use DB\DBConnection;

$HTMLPage = file_get_contents("../html/Recensioni.html");

if(!isset($_SESSION)) {
    session_start();
}

if(isset($_SESSION['login']) && $_SESSION['login'] == true){
    $HTMLPage = str_replace("<li><a href=\"login.php\" style=\"--i:7\">Login</a></li>", "<li><a href=\"logout.php\" style=\"--i:7\">Logout</a></li>", $HTMLPage);
    $HTMLPage = str_replace("writeACommentHidden", "writeAComment", $HTMLPage);
}

$connection = new DBConnection();
$connectionOK = $connection->openDBConnection();

if($connectionOK){
    $query = $connection->getComments();
    if($query){
        $i = 0;
        while($row = mysqli_fetch_assoc($query)){
            $finalComment = "";
            $commentHead = "<div class=\"comments\"><div class = \"userDetails\">";
            $commentName = "<h3>" +  $row["username"] + "</h3>";
            $stars


        }

    }else{
        $errorMSG = "<li>Problemi di connessione, ci scusiamo per il disagio</li>"; 
    }

}else{
    $errorMSG = "<li>Problemi di connessione, ci scusiamo per il disagio</li>";
}





if(isset($_POST["submit"])){

    $errorMSG = "";

    $comment = $_POST["commentBox"];
    if(!preg_match("/^[A-Z\d,.èéàò!?() ]{1,300}+$/i", $comment)){
        $errorMSG .= "<li>Commento non valido</li>";
    }

    $stars = $_POST["starsQuantity"];
    if($stars > 5 or $stars < 0){
        $errorMSG .= "<li>Stelle non valide</li>";
    }

    $username = $_SESSION['username'];


    if($errorMSG == ""){
        $connection = new DBConnection();
        $connectionOK = $connection->openDBConnection();

        if($connectionOK){
            $query = $connection->insertComment($username, $comment, $stars);
            if($query){
                header( "refresh:5; url=recensioni.php" ); 

            }else{
                $errorMSG = "<li>Problemi di connessione, ci scusiamo per il disagio</li>"; 
            }

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