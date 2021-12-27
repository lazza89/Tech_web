<?php

require_once("DBConnection.php");
use DB\DBAccess;

$paginaHTML = file_get_contents("Home.html");

$connessione = new DBAccess();
$connessioneOk = $connessione->openDBConnection();

$users = "";
$usersList = "";

if($connessioneOk){
    $users = $connessione->getUserList();
    $connessione->closeConnection();
    if($users != null){
        $usersList = '<dl id="userlist">';
        foreach($users as $user){
            $usersList .= '<dt>' .$user['username'] .'</dt>';
        }
        $usersList .= '</dl>';

    }else{
        $usersList = "<p> Non ci sono users. </p>";
    }
}else{
    $usersList = "<p>server al momento non raggiungibile.</p>";
}

echo str_replace("[test]", $usersList, $paginaHTML);









?>