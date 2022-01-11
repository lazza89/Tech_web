<?php
if(!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
	<meta charset="utf-8" />
	<title>Home - Crystal Ski</title>
	<meta name="keywords" content="Crystal Ski, monte Cristallo, sci, come arrivare" />
	<meta name="description" content="homePage" />
	<meta name="author" content="Crystal Ski" />
	<link rel="stylesheet" href="../css/style.css" />
	<link rel="stylesheet" media="screen and (max-width:600px), only screen and (max-width:600px)" href="../css/mini.css"/>
	<link rel="stylesheet" media="print" href="../css/print.css"/>
</head>

<body>
	<header>
		<a class="sr-only" href="#main">Vai al contenuto</a>
		<h1 lang="en">Crystal Ski</h1>
	</header>

	<div id="breadcrumb">

	<?php if (isset($_SESSION['login']) && $_SESSION['login']) { ?>
		<p>Ciao <?= $_SESSION['username'] ?>! Ti trovi in: <span lang="en">Home</span></p>
		<a href="logout.php">Logout</a>
	<?php } else { ?>
		<p>Ti trovi in: <span lang="en">Home</span></p>
		<a href="login.php">Login</a>
	<?php } ?>
	
	</div>

    <input type="checkbox" id="menu-hamburger" class="menu-toggle" />
	<label for="menu-hamburger" class="hamburger"><span class="sr-only">menu</span></label>
	<nav id="menu">
		<ul>
			<li lang="en">Home</li>
			<li><a href="tariffe.php">Tariffe</a></li>
			<li><a href="mappa.php">Mappa</a></li>			
			<li><a href="servizi.php">Servizi</a></li>
			<li><a href="eventi.php">Eventi e Gare</a></li>
			<li><a href="recensioni.php">Recensioni</a></li>
			<?php if(isset($_SESSION['login']) && $_SESSION['login']){ ?>
				<li><a href="areaPersonale.php">Profilo</a></li>
			<?php } ?>
		</ul>
	</nav>

	<main id="main">
		<div id="novita">
			<article id="offerte">
				<h2> Offerte della Settimana </h2>
				<ul>
					<li>Con l'acquisto dello skipass settimanale si ha l'accesso scontato al <strong> 50% </strong>al centro benessere di Cortina</li>
					<li>Il quinto skipass plurigiornaliero acquistato è scontato al <strong> 15%</strong></li>
				</ul>
			</article> 

			<article id="news">
				<h2 lang="en">News giornaliere </h2>
				<ul>
					<li> <strong>5/5</strong> impianti aperti</li>
					<li><p> <strong>7/8</strong> piste aperte</p>
					<p> (Chiusa per mancanza di neve la pista 1) </p></li>
					<li>Sole con <strong> +3° </strong></li>
				</ul> 
			</article>
		</div>
	
		<div class="content" id="presentazione">
			<img id="imgHome" src="../images/sciatori.jpg" alt="Le piste sono ampie e spaziose."/> 
			<p>Nel punto più alto del gruppo del Cristallo, oltre 2000 metri,  si trova il comprensorio sciistico “<span lang="en">Crystal Ski</span>” vicino a Cortina e situato nel comune Auronzo di Cadore, in provincia di Belluno.</p> 
			<p>Con ben 5 impianti di risalita e più di 50 chilometri di piste avrete la possibilità di trascorrere indimenticabili giornate nelle nostre 8 piste, sempre ben battute e ricche di neve grazie ai 70 cannoni posti ai lati.</p> 
			<p>Quando arrivi in cima, non avere fretta di scendere, goditi la vista mozzafiato insieme ad un delizioso piatto caldo nella nostra baita “360gradi”
		</div>

		<div class="content" id="strada">	
			<h2>Come raggiungere <span lang="en">Crystal Ski</span></h2>
			<dl>
				<dt>Macchina</dt>
				<dd><p>Segui le indicazioni per A27 verso Belluno. Uscire al termine dell’autostrada (dopo l’uscita Belluno) e immettersi nella Strada Statale SS51 verso Cadore, Dolomiti/Cortina.</p>
				<p>Giunti a Cortina prendere la Strada Regionare SR48 per Misurina, successivamente le indicazioni per Monte del Cristallo.</p>
				</dd>
				<dt>Mezzi pubblici</dt>
				<dd><p>Grazie a <a href="https://www.cortinaexpress.it/it">Cortina Express</a> puoi decidere di arrivare tramite autobus anche dalla tua città.</p>
				<p>E poi da Cortina usufruire della navetta.</p>
				</dd>
				<dt>Navetta da Cortina</dt>
				<dd><p>Dirigersi alla stazione degli autobus e prendere la navetta con direzione Monte Cristallo.</p>
				</dd>
			</dl>
		</div>
		
		<div class="content" id="curiosita">
			<h2>Curiosità</h2>
			<img id="imgCristallo" src="../images/cristallo.jpg" alt="A basse altitudini una fitta vegetazione, mentre in alto roccia esposta"/>
			<p>Il Monte Cristallo è alto 3221 metri ed è uno dei monti più maestosi delle Dolomiti Ampezzane.</p>
			<p>Una leggenda narra che si ergesse un castello con un incantevole principessa, dove la sua bellezza non passò inosservata al pastore Bertoldo, di cui s’innamorò. Ancora oggi, il nome di Bertoldo è legato al Monte Cristallo, che gli ampezzani chiamano “Croda de Bertoldo”.</p>
			<p>Il monte fu scalato per la prima volta dall’alpinista austriaco di Vienna, <span lang="de">Paul Grohmann</span> il 14 Settembre 1865.</p>
		</div>
	</main>
	<?php include('../components/footer.php') ?>
</body>
</html>
