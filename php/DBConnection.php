<?php
namespace DB;

use mysqli;

class DBConnection{
    private const HOST_DB = "127.0.0.1";
    private const DATABASE_NAME = "nlazzari";
    private const USERNAME = "nlazzari";
    private const PASSWORD = "ooqu1SeeD0ohjoox";

    private $connection;

    public function openDBConnection(){
        $this->connection = mysqli_connect(DBConnection::HOST_DB, DBConnection::USERNAME, DBConnection::PASSWORD, DBConnection::DATABASE_NAME);
        if(mysqli_errno($this->connection)){
            return false;
        }else{
            mysqli_set_charset($this->connection,"utf8");
            return true;
        }
    }
    
    /* NEW USER FUNCTION */
    public function createNewUser($mail, $username, $pw, $name, $surname, $city){
        $createNewUserQuery = "INSERT INTO `user` (`email`,`username`, `password`, `name`, `surname`, `city`, `isAdmin`) values (\"$mail\", \"$username\", \"$pw\", \"$name\", \"$surname\", \"$city\", 0)";
        
        $queryResult = mysqli_query($this->connection, $createNewUserQuery) or die (mysqli_error($this->connection)); 
        if(mysqli_affected_rows($this->connection) > 0){
            return true;
        }else{
            return false;
        }
    }

    public function checkEmailOnDB($mail){
        $checkEmailQuery = "SELECT `email` from `user` WHERE `email` like \"$mail\"";
        $queryResult = mysqli_query($this->connection, $checkEmailQuery) or die (mysqli_error($this->connection)); 
        if(mysqli_num_rows($queryResult) > 0 ){
            return true;
        }else{
            return false;
        }
    }

    public function checkUsernameOnDB($username){
        $checkUsernameQuery = "SELECT `username` from `user` WHERE `username` like \"$username\"";
        $queryResult = mysqli_query($this->connection, $checkUsernameQuery) or die (mysqli_error($this->connection)); 
        if(mysqli_num_rows($queryResult) > 0 ){
            return true;
        }else{
            return false;
        }
    }










}
/*
QUERY EXAMPLE
    public function getUserList(){
            $query = "SELECT username FROM user";
            $queryResult = mysqli_query($this->connection, $query) 
            or die ("errore di non so che cosa: " . mysqli_errno($this->connection));

            if(mysqli_num_rows($queryResult) == 0){
                return null;
            }else{
                $result = array();
                while($row = mysqli_fetch_assoc($queryResult)){
                    array_push($result, $row);
                }
            }
            $queryResult->free();
            return $result;
    }
}
*/



?>