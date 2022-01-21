<?php
if(!isset($_SESSION)) {
    session_start();
}

$HTMLPage = file_get_contents("../html/home.html");

if (isset($_SESSION['login']) && $_SESSION['login']) { 
    $username = $_SESSION['username'];
    $HTMLPage = str_replace("{{logged}}", "Ciao $username ! " , $HTMLPage);
    $HTMLPage = str_replace("{{login}}", "logout.php" , $HTMLPage);
    $HTMLPage = str_replace("{{areaPersonale}}", "<li><a href=\"areaPersonale.php\">Profilo</a></li>" , $HTMLPage);


}else{
    $HTMLPage = str_replace("{{logged}}", "" , $HTMLPage);
    $HTMLPage = str_replace("{{login}}", "login.php" , $HTMLPage);
    $HTMLPage = str_replace("{{areaPersonale}}", "" , $HTMLPage);
}

$HTMLPage = str_replace("{{footer}}", file_get_contents("../html/components/footer.html") , $HTMLPage);


echo $HTMLPage;
?>