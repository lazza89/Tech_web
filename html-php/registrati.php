<?php
require_once("DBConnection.php");
use DB\DBConnection;

if(!isset($_SESSION)) {
    session_start();
}

$mail = "";
$username = "";
$pw = "";
$repeatPw = "";
$name = "";
$surname = "";
$city = "";

$errorMSG = "";
$queryResult = false;

if(!isset($_SESSION["login"])){
	if(isset($_POST["submit"])){


		//regular expression generati con il sito regex101.com/r
		//deve essere in formato email, non può contenere caratteri speciali riferiti a linguaggi (html, sql)
		$mail = $_POST["REmail"];
		if(!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/",$mail)){
			$errorMSG .= "<li>Email non conforme, la mail deve essere in formato: testo@dominio.nomedominio</li>";
		}
		//deve essere almeno 3 caratteri e lunga 20, può contenere solo numeri e lettere
		$username = $_POST["RUsername"];
		if(!preg_match("/^[A-Z\d]{3,20}+$/i",$username)){
			$errorMSG .= "<li>Username non conforme, l'username deve contenere solo caratteri alfanumerici senza spaziature, minimo 3 caratteri massimo 20</li>";
		}
		//deve essere almeno 3 caratteri e lunga 30, può contenere solo lettere
		$name = $_POST["RName"];
		if(!preg_match("/^[A-Z ]{2,30}+$/i",$name)){
			$errorMSG .= "<li>Nome non conforme, il nome può contenere solo lettere, minimo 2 caratteri massimo 30</li>";
		}
		//deve essere almeno 3 caratteri e lunga 30, può contenere solo lettere
		$surname = $_POST["RSurname"];
		if(!preg_match("/^[A-Z ]{2,30}+$/i",$surname)){
			$errorMSG .= "<li>Cognome non conforme, il cognome può contenere solo lettere, minimo 2 caratteri massimo 30</li>";
		}
		//deve essere almeno 3 caratteri e lunga 40, può contenere solo lettere
		$city = $_POST["RCity"];
		if($city && !preg_match("/^[A-Z ]{2,40}+$/i",$city)){
			$errorMSG .= "<li>Città non conforme, la città può contenere solo lettere, minimo 2 caratteri massimo 40</li>";
		}
		//PASSWORD lunga almeno 6 caratteri, deve contenere almeno un numero e una lettera, può contenere caratteri speciali ma non robe html e sql
		$pw = $_POST["RPassword"];
		if(!preg_match("/^[A-Z\d]{3,20}+$/i",$pw)){   
			$errorMSG .= "<li>Password non conforme, la password deve contenere solo caratteri alfanumerici senza spaziature, minimo 3 caratteri massimo 20</li>";
		}

		$repeatPw = $_POST["RPasswordRepeat"];
		if($pw != $repeatPw){   
			$errorMSG .= "<li>Le password non coincidono</li>";
		}



		if($errorMSG == ""){
			$connection = new DBConnection();
			$connectionOK = $connection->openDBConnection();

			if($connectionOK){
				if($connection->checkUsernameOnDB($username)){
					$errorMSG .= "<li>Username già associato ad un account</li>";
				}

				if($errorMSG == ""){
					$queryResult = $connection->createNewUser($mail, $username, $pw, $name, $surname, $city);
					if($queryResult){
						header( "refresh:5; url=login.php" ); 
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
	header("Location: home.php");
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
	<title>Registrati - Crystal Ski</title>
	<meta name="keywords" content="Registrazione, Crystal Ski, monte Cristallo" />
	<meta name="description" content="Registrazione" />
	<meta name="author" content="Crystal Ski" />
	<link rel="stylesheet" href="../css/style.css" />
	<link rel="stylesheet" media="screen and (max-width:600px), only screen and (max-width:600px)" href="../css/mini.css"/>

	<script src="../javascript/script.js"></script>

</head>

<body>
	<header>
		<a class="sr-only" href="#main">Vai al contenuto</a>
		<h1 lang="en">Crystal Ski</h1>
	</header>

	<div id="breadcrumb">
		<p>Ti trovi in: <a href="home.php" lang="en">Home</a> &gt; &gt; Registrati</p>
		<a href="login.php">Login</a>
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
		</ul>
	</nav>

	<main id="main">
		<div id="register">

			<?php if($queryResult){ ?>

			<div id="registerDone">
				<h2>Registrazione effettuata!</h2>
				<h2>Ti mando alla pagina di login...</h2>
			</div>

			<?php }else{ ?>

			<div id="registerBox">
				<form action="registrati.php" id="registerForm" method="post">
					<h2 id="registrati">Registrati</h2>
					
					<?=$errorMSG?>
				
					<label for="REmail"><b>Email</b></label>
					<p class="JSError" id="registerEmailERR"></p>
					<input type="text" placeholder="Inserisci E-mail" name="REmail" id="REmail" value="<?=$mail?>" required>
				
					<label for="RUsername"><b>Username</b></label>
					<p class="JSError" id="registerUsernameERR"></p>
					<input type="text" placeholder="Inserisci Username" name="RUsername" id="RUsername" value="<?=$username?>" required>

					<label for="RName"><b>Nome</b></label>
					<p class="JSError" id="registerNameERR"></p>
					<input type="text" placeholder="Inserisci Nome" name="RName" id="RName" value="<?=$name?>" required>

					<label for="RSurname"><b>Cognome</b></label>
					<p class="JSError" id="registerSurnameERR"></p>
					<input type="text" placeholder="Inserisci Cognome" name="RSurname" id="RSurname" value="<?=$surname?>" required>

					<label for="RCity"><b>Città</b></label>
					<p class="JSError" id="registerCityERR"></p>
					<input type="text" placeholder="Inserisci città" name="RCity" id="RCity" value="<?=$city?>">

					<label for="RPassword"><b>Password</b></label>
					<p class="JSError" id="registerPasswordERR"></p>
					<input type="password" placeholder="Inserisci Password" name="RPassword" id="RPassword" required>
				
					<label for="RPasswordRepeat"><b>Ripeti Password</b></label>
					<p class="JSError" id="registerRPasswordERR"></p>
					<input type="password" placeholder="Ripeti Password" name="RPasswordRepeat" id="RPasswordRepeat" required>
				
					<button type="submit" name="submit" class="registerbtn">Registrati</button>
				</form>
			</div>

			<?php } ?>
		</div>
	</main>

	<?php include('../components/footer.php') ?>

</body>
</html>
