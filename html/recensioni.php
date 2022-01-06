<?php
require_once("DBConnection.php");
use DB\DBConnection;

if(!isset($_SESSION)) {
    session_start();
}

$connection = new DBConnection();
$connectionOK = $connection->openDBConnection();

$errorMSG = "";
$connectionERR = "";
$commentsQuery = "";

if(isset($_POST["DComment"])){
	if($connectionOK){
		$query = $connection->deleteComment($_POST["DComment"]);
		if($query){
			header( "refresh:0; url=recensioni.php" ); 
		}else{
			$connectionERR = "<li>Problemi di connessione, Commento non cancellato</li>";
		}
	}else{
		$connectionERR = "<li>Problemi di connessione, ci scusiamo per il disagio</li>";
	}
}


if(isset($_POST["submit"])){

    $comment = $_POST["commentBox"];
    if(!preg_match("/^[A-Z\d,.èéì% àò!?() ]{1,300}+$/i", $comment)){
        $errorMSG .= "<li>Commento non valido</li>";
		$errorMSG .= "<li>Il commento non può contenere nuove linee a capo e caratteri inerenti a linguaggi di programmazione</li>";
		$errorMSG .= "<li>Il commento può essere lungo massimo 300 caratteri</li>";
	}

    $stars = $_POST["starsQuantity"];
    if($stars > 5 or $stars < 0){
        $errorMSG .= "<li>Stelle non valide</li>";
    }

    if($errorMSG == ""){
        if($connectionOK){
            $query = $connection->insertComment($_SESSION["id"], $comment, $stars);
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

	<?php if (isset($_SESSION['login']) && $_SESSION['login']) { ?>
		<p>Ciao <?=$_SESSION['username']?>! Ti trovi in: <a href="home.php" lang="en">Home</a> &gt; &gt; Recensioni</p>
		<a href="logout.php">Logout</a>
	<?php } else { ?>
		<p>Ti trovi in: <a href="home.php" lang="en">Home</a> &gt; &gt; Recensioni</p>
		<a href="login.php">Login</a>
	<?php } ?>

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
			<li>Recensioni</li>
			<?php if(isset($_SESSION['login']) && $_SESSION['login']){ ?>
				<li><a href="areaPersonale.php">Profilo</a></li>
			<?php } ?>
		</ul>
	</nav>

	<div id="comments_intro">
		<h2>Cosa pensano di noi</h2>
	</div>

	<?php if (isset($_SESSION['login']) && $_SESSION['login']) { ?>
	<div id=writeAComment>
		<form action="recensioni.php" method="post">

			<?=$errorMSG?>

			<label for="starsQuantity">Stelle (da 1 a 5):</label>
			<input type="number" id="starsQuantity" name="starsQuantity" value="1" min="1" max="5">	
			<textarea name="commentBox" id=commentBox placeholder="Scrivi qui il tuo commento..."></textarea>

			<button type="submit" name="submit" class="submitComment">Pubblica</button>
		</form>
	</div>
	<?php } ?>

	<div id="comments_holder">
		<?=$connectionERR?>

		<?php 
			if($connectionOK){
   				 $commentsQuery = $connection->getComments();
    			if($commentsQuery != ""){
					while($row = mysqli_fetch_assoc($commentsQuery)){
		?>
			<div class="comments">
				<div class = "userDetails">
					<h3><?=mysqli_fetch_assoc($connection->getUsernameById($row["userId"]))["username"]?></h3>

					<?php for ($i = 0; $i < 5; $i++) { ?>
							<div class='star<?=$row['stars'] > $i ? ' gold' : '' ?>'></div>
					<?php } ?>

				</div>
				<p class ="commentDate"><?=$row["date"]?></p>
				<p class ="comment"><?=$row["comment"]?></p>
				
				<?php if((isset($_SESSION['login']) && $_SESSION['id'] == $row["userId"]) || (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'])){  ?>
					<div class = "commentsHeader">
						<form action="recensioni.php" method="post">
						<button class="DComment" name="DComment" value="<?=$row["id"]?>">Cancella</button>
						</form>
					</div>
				<?php } ?>
			</div>	
				
		<?php
				}
			}else{
				$connectionERR = "<p>Problemi di connessione, ci scusiamo per il disagio</p>"; 
				}
				$connection->closeDBConnection();
			}else{
				$connectionERR = "<p>Problemi di connessione, ci scusiamo per il disagio</p>";
			}

		?>		

	</div>
	
		<?php include('../components/footer.php') ?>			
</body>
</html>
