<?php
require_once("DBConnection.php");
use DB\DBConnection;

$HTMLPage = file_get_contents("../html/Recensioni.html");

if(!isset($_SESSION)) {
    session_start();
}

if(isset($_SESSION['login']) && $_SESSION['login'] == true){
    $username = $_SESSION["username"];
    $HTMLPage = str_replace("<li><a href=\"login.php\" style=\"--i:7\">Login</a></li>", "<li><a href=\"logout.php\" style=\"--i:7\">Logout</a></li>", $HTMLPage);
    $HTMLPage = str_replace("<p>Ti trovi in: <a href=\"home.php\" lang=\"en\">Home</a> &gt; &gt; Recensioni</p>", "<p>Ciao " . $username . "! Ti trovi in: <a href=\"home.php\" lang=\"en\">Home</a> &gt; &gt; Recensioni</p>", $HTMLPage);

    $HTMLPage = str_replace("writeACommentHidden", "writeAComment", $HTMLPage);
}

$connection = new DBConnection();
$connectionOK = $connection->openDBConnection();

$connectionERR = "";
if($connectionOK){
    $query = $connection->getComments();
    if($query){
        while($row = mysqli_fetch_assoc($query)){
            $finalComment = "";
            $commentHead = "<div class=\"comments\"><div class = \"userDetails\">";
            $commentName = "<h3>" .  $row["username"] . "</h3>";
            $stars = "";
            for($i = 0; $i < $row["stars"]; $i++){
                $stars .= "<div class=\"gold_star\"></div>";
            }
            for($i = 5; $i > $row["stars"]; $i--){
                $stars .= "<div class=\"grey_star\"></div>";
            }
            $dateComment = "</div><p class =\"commentDate\">" . $row["date"] . "</p>";
            $commentItself = "<p class =\"comment\">" . $row["comment"] . "</p></div><!--<comments/>-->";

            $finalComment .= $commentHead .= $commentName .= $stars .= $dateComment .= $commentItself;
            $HTMLPage = str_replace("<!--<comments/>-->", $finalComment, $HTMLPage);
        }


    }else{
        $connectionERR = "<p>Problemi di connessione, ci scusiamo per il disagio</p>"; 
    }
    
    $connection->closeDBConnection();
}else{
    $connectionERR = "<p>Problemi di connessione, ci scusiamo per il disagio</p>";
}

if($connectionERR != ""){
    $HTMLPage = str_replace("<!--<connectionError/>-->", $connectionERR, $HTMLPage);
}


/*
<div class="comments">
			<div class = "userDetails">
				<h3>Genoveffo semplice</h3>
				<div class="gold_star"></div>
				<div class="gold_star"></div>
				<div class="gold_star"></div>
				<div class="gold_star"></div>
				<div class="grey_star"></div>
			</div>
			<p class ="commentDate">12/11/2021 - 10:54</p>
			<p class ="comment">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
		</div>	
*/




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
                header( "refresh:0; url=recensioni.php" ); 

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

    $HTMLPage = str_replace("<!--<userInputErrors/>-->", $errorMSG, $HTMLPage);



}



echo $HTMLPage;


?>