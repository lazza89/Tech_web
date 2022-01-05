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
			$errorMSG .= "<li>Email non conforme</li>";
		}
		//deve essere almeno 3 caratteri e lunga 20, può contenere solo numeri e lettere
		$username = $_POST["RUsername"];
		if(!preg_match("/^[A-Z\d]{3,20}+$/i",$username)){
			$errorMSG .= "<li>Username non conforme</li>";
		}
		//PASSWORD lunga almeno 6 caratteri, deve contenere almeno un numero e una lettera, può contenere caratteri speciali ma non robe html e sql
		$pw = $_POST["RPassword"];
		if(!preg_match("/^[A-Z\d]{3,20}+$/i",$pw)){   
			$errorMSG .= "<li>Password non conforme</li>";
		}

		$repeatPw = $_POST["RPasswordRepeat"];
		if($pw != $repeatPw){   
			$errorMSG .= "<li>Le password non coincidono</li>";
		}
		//deve essere almeno 3 caratteri e lunga 30, può contenere solo lettere
		$name = $_POST["RName"];
		if(!preg_match("/^[A-Z]{2,30}+$/i",$name)){
			$errorMSG .= "<li>Nome non conforme</li>";
		}
		//deve essere almeno 3 caratteri e lunga 30, può contenere solo lettere
		$surname = $_POST["RSurname"];
		if(!preg_match("/^[A-Z]{2,30}+$/i",$surname)){
			$errorMSG .= "<li>Cognome non conforme</li>";
		}
		//deve essere almeno 3 caratteri e lunga 40, può contenere solo lettere
		$city = $_POST["RCity"];
		if($city && !preg_match("/^[A-Z]{2,40}+$/i",$city)){
			$errorMSG .= "<li>Città non conforme</li>";
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
	$errorMSG = "<li>Hey! che ci fai qui? non dovresti essere qui!</li>";
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
	<title>Crystal Ski - Home</title>
	<meta name="keywords" content="Crystal Ski, Sci, monte Cristallo" />
	<meta name="description" content="homePage" />
	<meta name="author" content="Crystal Ski" />
	<link rel="stylesheet" href="../css/style.css" />
	<link rel="stylesheet" media="screen and (max-width:600px), only screen and (max-width:600px)" href="../css/mini.css"/>
</head>

<body>
	<header>
		<h1 lang="en">Crystal Ski</h1>
	</header>

	<nav id="breadcrumb">
		<p>Ti trovi in: <a href="home.php" lang="en">Home</a> &gt; &gt; Registrati</p>
		<a href="login.php">Login</a>
	</nav>

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

	<div id="register">

		<?php if($queryResult){ ?>

		<div id="registerDone">
			<h2>Registrazione effettuata!</h2>
			<h2>Ti mando alla pagina di login...</h2>
		</div>

		<?php }else{ ?>

		<div id="registerBox">
			<form action="registrati.php" method="post">
				<h2 id="registrati">Registrati</h2>
				
				<?=$errorMSG?>
			
				<label for="email"><b>Email</b></label>
				<input type="text" placeholder="Inserisci E-mail" name="REmail" id="email" value="<?=$mail?>" required>
			
				<label for="username"><b>Username</b></label>
				<input type="text" placeholder="Inserisci Username" name="RUsername" id="username" value="<?=$username?>" required>

				<label for="name"><b>Nome</b></label>
				<input type="text" placeholder="Inserisci Nome" name="RName" id="name" value="<?=$name?>" required>

				<label for="surname"><b>Cognome</b></label>
				<input type="text" placeholder="Inserisci Cognome" name="RSurname" id="surname" value="<?=$surname?>" required>

				<label for="city"><b>Città</b></label>
				<input type="text" placeholder="Inserisci città" name="RCity" id="city" value="<?=$city?>">

				<label for="register-psw"><b>Password</b></label>
				<input type="password" placeholder="Inserisci Password" name="RPassword" id="register-psw" required>
			
				<label for="psw-repeat"><b>Ripeti Password</b></label>
				<input type="password" placeholder="Ripeti Password" name="RPasswordRepeat" id="psw-repeat" required>
			
				<button type="submit" name="submit" class="registerbtn">Registrati</button>
			</form>
		</div>

		<?php } ?>
	</div>

	<?php include('../components/footer.php') ?>

</body>
</html>
