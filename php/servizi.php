<?php
require_once("DBConnection.php");
use DB\DBConnection;

$HTMLPage = file_get_contents("../html/Servizi.html");

if(!isset($_SESSION)) {
    session_start();
}

if(isset($_SESSION['login']) && $_SESSION['login'] == true){
    $username = $_SESSION['username'];
    $HTMLPage = str_replace("<li><a href=\"login.php\" style=\"--i:7\">Login</a></li>", "<li><a href=\"logout.php\" style=\"--i:7\">Logout</a></li>", $HTMLPage);
    $HTMLPage = str_replace("<p>Ti trovi in: <a href=\"home.php\" lang=\"en\">Home</a> &gt; &gt; Servizi</p>", "<p>Ciao " . $username . "! Ti trovi in: <a href=\"home.php\" lang=\"en\">Home</a> &gt; &gt; Servizi</p>", $HTMLPage);
}


echo $HTMLPage;


?>