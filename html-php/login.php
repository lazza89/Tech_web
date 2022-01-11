<?php
require_once("DBConnection.php");
use DB\DBConnection;

if(!isset($_SESSION)) {
    session_start();
}

$errorMSG = "";

if(!isset($_SESSION["login"])){
	if(isset($_POST["submit"])){

		$username = $_POST["LUsername"];
		if(!preg_match("/^[A-Z\d]{1,20}+$/i",$username)){
			$errorMSG = "<li>username non conforme</li>";
		}
		$password = $_POST["LPassword"];
		if(!preg_match("/^[A-Z\d]{1,20}+$/i",$password)){   
			$errorMSG .= "<li>password non conforme</li>";
		}

		if($errorMSG == ""){
			$connection = new DBConnection();
			$connectionOK = $connection->openDBConnection();

			if($connectionOK){
				$query = $connection->checkLoginCredentials($username, $password);
				if($query != ""){
					if(!isset($_SESSION['login'])) {
						
						session_start();
						$_SESSION['login'] = true;
						
						$_SESSION['id'] = $query['id'];
						$_SESSION['email'] = $query['email'];
						$_SESSION['username'] = $query['username'];
						$_SESSION['password'] = $query['password'];
						$_SESSION['name'] = $query['name'];
						$_SESSION['surname'] = $query['surname'];
						$_SESSION['city'] = $query['city'];
						$_SESSION['isAdmin'] = $query['isAdmin'];
			
						header("Location: home.php");
					}else{
						$errorMSG = "<li>Login error, Riprova</li>";
						session_destroy();
					} 
				}else{
					$errorMSG = "<li>Username e Password non corretti</li>";
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
	<title>Login - Crystal Ski</title>
	<meta name="keywords" content="Login, Area riservata, Crystal Ski, monte Cristallo" />
	<meta name="description" content="Login" />
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
		<p>Ti trovi in: <a href="home.php" lang="en">Home</a> &gt; &gt; Login</p>
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
		<div class="login">
			<div id="loginBox">

				<?=$errorMSG?>
			
				<form action="login.php" id="loginForm" method="post">
					<label for="LUsername"><b>Username</b></label>
					<p class="JSError" id="loginUsernameERR"></p>
					<input type="text" placeholder="Username" name="LUsername" id="LUsername" required>
				
					<label for="LPassword"><b>Password</b></label>
					<p class="JSError" id="loginPasswordERR"></p>
					<input type="password" placeholder="Password" name="LPassword" id="LPassword" required>
				
					<div id=loginAndRegister>
						<button type="submit" name="submit">Login</button>
						<a href="registrati.php">Registrati!</a>
					</div>
				</form>
			</div>
		</div>
	</main>
		<?php include('../components/footer.php') ?>			
</body>
</html>

