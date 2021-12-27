<?php

$HTMLPage = file_get_contents("../html/Login.html");

if(!isset($_SESSION))
  session_start();
if(isset($_SESSION['login']) && !$_SESSION['login']) {
  // L'UNTENTE è GIA LOGGATO
}



































?>