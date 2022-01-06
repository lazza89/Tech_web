<?php
if(!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
	<meta charset="utf-8" />
	<title>Eventi e gare - Crystal Ski</title>
	<meta name="keywords" content="Eventi, Gare, Crystal Ski, Sci, monte Cristallo" />
	<meta name="description" content="Pagina per gli eventi e gare" />
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
			<p>Ciao <?=$_SESSION['username']?>! Ti trovi in: <a href="home.php" lang="en">Home</a> &gt; &gt; Eventi</p>
			<a href="logout.php">Logout</a>
		<?php } else { ?>
			<p>Ti trovi in: <a href="home.php" lang="en">Home</a> &gt; &gt; Eventi</p>
			<a href="login.php">Login</a>
		<?php } ?>

	</nav>
	
    <input type="checkbox" id="menu-hamburger" class="menu-toggle" />
	<label for="menu-hamburger" class="hamburger"><span class="sr-only">menu</span></label>
	<nav id="menu">
		<ul>
			<li lang="en"><a href="home.php">Home</a></li>
			<li><a href="tariffe.php">Tariffe</a></li>
			<li><a href="mappa.php">Mappa</a></li>			
			<li><a href="servizi.php">Servizi</a></li>
			<li>Eventi e Gare</li>
			<li><a href="recensioni.php">Recensioni</a></li>
			<?php if(isset($_SESSION['login']) && $_SESSION['login']){ ?>
				<li><a href="areaPersonale.php">Profilo</a></li>
			<?php } ?>

		</ul>
	</nav> 

	<div class="box">
		<h2>Eventi</h2>
		<img class="img_eventi" src="../images/eventi.jpg" alt=" "/>
		<dl class="liste_eventi">
			<dt>Notte bianca:</dt>
				<dd><p>Ogni martedì dalle 21 alle 24 sarà possibile sciare usufruendo dell’illuminazione a bordo pista</p></dd>
			<dt>31 Dicembre e 1 Gennaio:</dt>
				<dd><p>In occasione dell’arrivo della Mezzanotte sarà possibile sciare e festeggiare il Capodanno direttamente sulle nostre piste.</p> 
				<p>Ovviamente alcuni punti di ristoro saranno aperti per servire bibite calde e degli ottimi dolcetti</p></dd>
			<dt>Befana:</dt>
				<dd><p>Il 6 Gennaio 2022, in onore della Festa della Befana, ci sarà la Fiaccolata della Befana alle 18:00.</p> 
				<p>I maestri di Sci incanteranno tutti gli interessati con uno spettacolo pirotecnico</p></dd>
			<dt>Martedì grasso:</dt> 
				<dd><p>Martedì 1 Marzo 2022 durante la giornata ci si può sbizzarrire con i travestimenti più simpatici e originali per richiamare il tema di carnevale</p></dd>
		</dl>
	</div>


	<div class="box">
		<h2>Gare</h2>
		<img class="img_eventi" src="../images/gare.jpg" alt=" "/>
		<dl class="liste_eventi">
			<dt>Gara della Settimana:
				<dd><p>Ogni venerdì mattina nella pista rossa X , ogni gruppo della Scuola di Sci sosterrà una gara di velocità.</p>
				<p>Verrà premiato il podio ma per il primo classificato ci sarà anche un regalo.</p>
				<p>Di conseguenza non è possibile sciare nella pista.</p></dd>
			<dt>Coppa del mondo:
				<dd><p>Dal 20 al 24  Gennaio 2022 NON sarà possibile nè sciare nelle nostre piste nè usufruire degli impianti, in quanto tali sono riservati esclusivamente ai partecipanti della gara e al personale staff</p></dd>
			<dt>Gara regionale young:
				<dd><p>Il 12-13 Febbraio 2022 nella pista nera Y si sosterranno i campionati regionali per decretare lo sciatore più veloce veneto.</p>
				<p>Le categorie interessate, sia maschile sia femminile, sono 3: 8-12 anni, 13-16 anni e 16-21 anni</p></dd>
		</dl>
	</div>
	
	<?php include('../components/footer.php') ?>

</body>
</html>