<?php
require_once("DBConnection.php");
use DB\DBConnection;

$HTMLPage = file_get_contents("../html/Home.html");

if(!isset($_SESSION)) {
    session_start();
}

if(isset($_SESSION['login']) && $_SESSION['login'] == true){
    $username = $_SESSION['username'];
    $HTMLPage = str_replace("<li><a href=\"login.php\" style=\"--i:6\">Login</a></li>", "<li><a href=\"logout.php\" style=\"--i:6\">Logout</a></li>", $HTMLPage);
    $HTMLPage = str_replace("<p>Ti trovi in: <span lang=\"en\">Home</span></p>", "<p>Ciao " . $username . "! Ti trovi in: <span lang=\"en\">Home</span></p>", $HTMLPage);
}


echo $HTMLPage;


?>