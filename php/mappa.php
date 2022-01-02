<?php
require_once("DBConnection.php");
use DB\DBConnection;

$HTMLPage = file_get_contents("../html/Mappa.html");

if(!isset($_SESSION)) {
    session_start();
}

if(isset($_SESSION['login']) && $_SESSION['login'] == true){
    $username = $_SESSION['username'];
    $HTMLPage = str_replace("<p>Ti trovi in: <a href=\"home.php\" lang=\"en\">Home</a> &gt; &gt; Mappa</p>", "<p>Ciao " . $username . "! Ti trovi in: <a href=\"home.php\" lang=\"en\">Home</a> &gt; &gt; Mappa</p>", $HTMLPage);
    $HTMLPage = str_replace("<li><a href=\"login.php\" style=\"--i:7\">Login</a></li>", "<li><a href=\"logout.php\" style=\"--i:7\">Logout</a></li>", $HTMLPage);
}


echo $HTMLPage;


?>