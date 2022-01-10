<?php
require_once("DBConnection.php");
use DB\DBConnection;

if(!isset($_SESSION)) {
    session_start();
}

$queryUpdateResult = "";
$errorMSG = "";

$connection = new DBConnection();
$connectionOK = $connection->openDBConnection();

if(isset($_SESSION['login']) && $_SESSION['login'] == true){

    $mail = $_SESSION['email'];
    $username = $_SESSION['username'];
    $pw = "";
	$oldPw = "";
    $name = $_SESSION['name'];
    $surname = $_SESSION['surname'];
    $city = $_SESSION['city'];


    if(isset($_POST["submit"])){


        //regular expression generati con il sito regex101.com/r
        //deve essere in formato email, non può contenere caratteri speciali riferiti a linguaggi (html, sql)
        $mail = $_POST["PEmail"];
        if(!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/",$mail)){
            $errorMSG .= "<li>Email non conforme</li>";
        }
        //deve essere almeno 3 caratteri e lunga 20, può contenere solo numeri e lettere
        $username = $_POST["PUsername"];
        if(!preg_match("/^[A-Z\d]{3,20}+$/i",$username)){
            $errorMSG .= "<li>Username non conforme</li>";
        }
        //PASSWORD lunga almeno 3 caratteri, deve contenere almeno un numero e una lettera, può contenere caratteri speciali ma non robe html e sql
        $pw = $_POST["PPassword"];
		if($pw != "" && !preg_match("/^[A-Z\d]{3,20}+$/i",$pw)){   
			$errorMSG .= "<li>Password non conforme</li>";
		}

		$oldPw = $_POST["POldPassword"];
		if(!preg_match("/^[A-Z\d]{3,20}+$/i",$oldPw)){   
			$errorMSG .= "<li>Password non conforme</li>";
		}else{
			if($connection->checkLoginCredentials($_SESSION['username'], $oldPw) == ""){
				$errorMSG .= "<li>Password attuale errata</li>";
			}
		}

        //deve essere almeno 3 caratteri e lunga 30, può contenere solo lettere
        $name = $_POST["PName"];
        if(!preg_match("/^[A-Z]{2,30}+$/i",$name)){
            $errorMSG .= "<li>Nome non conforme</li>";
        }
        //deve essere almeno 3 caratteri e lunga 30, può contenere solo lettere
        $surname = $_POST["PSurname"];
        if(!preg_match("/^[A-Z]{2,30}+$/i",$surname)){
            $errorMSG .= "<li>Cognome non conforme</li>";
        }
        //deve essere almeno 3 caratteri e lunga 40, può contenere solo lettere
        $city = $_POST["PCity"];
        if($city && !preg_match("/^[A-Z]{2,40}+$/i",$city)){
            $errorMSG .= "<li>Città non conforme</li>";
        }


        if($errorMSG == ""){
            if($connectionOK){
                if($_SESSION["username"] != $username && $connection->checkUsernameOnDB($username)){
                    $errorMSG .= "<li>Email o Username già associato ad un account</li>";
                }
                
                if($errorMSG == ""){
					if($pw == ""){
						$pw = $oldPw;
					}
                    $queryUpdateResult = $connection->updateUser($_SESSION['id'], $mail, $username, $pw, $name, $surname, $city);
                    if($queryUpdateResult){

                        $_SESSION['email'] = $mail;
                        $_SESSION['username'] = $username;
                        $_SESSION['name'] = $name;
                        $_SESSION['surname'] = $surname;
                        $_SESSION['city'] = $city;
                        
                        header( "refresh:4; url=areaPersonale.php" ); 
                    }else{
                        $errorMSG = "<li>Problemi di connessione, ci scusiamo per il disagio</li>";
                    }
                }
                $connection->closeDBConnection();
            }else{
                $errorMSG = "<li>Problemi di connessione, ci scusiamo per il disagio</li>";
            }
        }
    
    }
}else{
	$errorMSG = "<li>Hey tu!, che ci fai qui?</li>";
	header( "refresh:3; url=home.php" );
}

if($errorMSG){
	$openList = "<ul>";
	$closeList = "</ul>";
	$openList .= $errorMSG .= $closeList;
	$errorMSG = $openList;
}

?>

<!DOCTYPE html>
<html lang="it">

<head>
	<meta charset="utf-8" />
	<title>Profilo - Crystal Ski</title>
	<meta name="keywords" content="Profilo, Area Riservata, Crystal Ski, monte Cristallo" />
	<meta name="description" content="Profilo" />
	<meta name="author" content="Crystal Ski" />
	<link rel="stylesheet" href="../css/style.css" />
	<link rel="stylesheet" media="screen and (max-width:600px), only screen and (max-width:600px)" href="../css/mini.css"/>

	<script src="../javascript/script.js"></script>

</head>

<body>
	<header>
		<a id="salta" href="#personalArea">Vai al contenuto</a>
		<h1 lang="en">Crystal Ski</h1>
	</header>

	<div id="breadcrumb">
	<?php if (isset($_SESSION['login']) && $_SESSION['login']) { ?>
		<p>Ciao <?=$_SESSION['username']?>! Ti trovi in: <a href="home.php" lang="en">Home</a> &gt; &gt; Area Personale</p>
		<a href="logout.php">Logout</a>
	<?php } else { ?>
		<p>Ti trovi in: <a href="home.php" lang="en">Home</a> &gt; &gt; Area Personale</p>
		<a href="login.php">Login</a>
	<?php } ?>
	</div>

    <input type="checkbox" id="menu-hamburger" class="menu-toggle" />
	<label for="menu-hamburger" class="hamburger"><span class="sr-only">menu</span></label>
	<nav id="menu">
		<ul>
			<li><a href="home.php">Home</a></li>
			<li><a href="tariffe.php">Tariffe</a></li>
			<li><a href="mappa.php">Mappa</a></li>			
			<li><a href="servizi.php">Servizi</a></li>
			<li><a href="eventi.php">Eventi e Gare</a></li>
			<li><a href="recensioni.php">Recensioni</a></li>
			<li>Profilo</li>
		</ul>
	</nav>

	<div id="personalArea">

		<?php if($queryUpdateResult){ ?>

			<div id="modificationDone">
				<h2>Modifica dati effettuata!</h2>
				<h2>Ti mando alla pagina Area Personale...</h2>
			</div>
		<?php }else{ ?>

			<div id="personalAreaBox">
				<form action="areaPersonale.php" id="personalAreaForm" method="post">
					<h2 id="datiUtente">Dati utente</h2>
					
					<?=$errorMSG?>

					<label for="PEmail"><b>Email</b></label>
					<p style="color:red"id="PAreaEmailERR"></p>
					<input type="text" placeholder="Inserisci E-mail" name="PEmail" id="PEmail" value="<?=$mail?>" required>
				
					<label for="PUsername"><b>Username</b></label>
					<p style="color:red"id="PAreaUsernameERR"></p>
					<input type="text" placeholder="Inserisci Username" name="PUsername" id="PUsername" value="<?=$username?>" required>

					<label for="PName"><b>Nome</b></label>
					<p style="color:red"id="PAreaNameERR"></p>
					<input type="text" placeholder="Inserisci Nome" name="PName" id="PName" value="<?=$name?>" required>

					<label for="PSurname"><b>Cognome</b></label>
					<p style="color:red"id="PAreaSurnameERR"></p>
					<input type="text" placeholder="Inserisci Cognome" name="PSurname" id="PSurname" value="<?=$surname?>" required>

					<label for="PCity"><b>Città</b></label>
					<p style="color:red"id="PAreaCityERR"></p>
					<input type="text" placeholder="Inserisci città" name="PCity" id="PCity" value="<?=$city?>">

					<label for="POldPassword"><b>Password attuale</b></label>
					<p style="color:red"id="PAreaPasswordERR"></p>
					<input type="password" placeholder="Inserisci Password" name="POldPassword" id="POldPassword" value="" required>

					<label for="PPassword"><b>Password</b></label>
					<p style="color:red"id="PAreaRPasswordERR"></p>
					<input type="password" placeholder="Inserisci Password" name="PPassword" id="PPassword" value="">
							
					<button type="submit" name="submit" class="personalAreabtn">Modifica</button>
				</form>
			</div>
		<?php } ?>
	</div>

	<?php include('../components/footer.php') ?>			

</body>
</html>
