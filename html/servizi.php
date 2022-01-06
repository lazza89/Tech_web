<?php
if(!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
	<meta charset="utf-8" />
	<title>Servizi - Crystal Ski</title>
	<meta name="keywords" content="Noleggio, Scuola sci, Camposcuola, punti ristoro, 360Gradi, Bar panini, Crystal Ski" />
	<meta name="description" content="homePage" />
	<meta name="author" content="Crystal Ski" />
	<link rel="stylesheet" href="../css/style.css" />
	<link rel="stylesheet" media="screen and (max-width:600px), only screen and (max-width:600px)" href="../css/mini.css"/>
    <link rel="stylesheet" media="print" href="../css/print.css"/>

</head>

<body>
	<header>
		<h1 lang="en">Crystal Ski</h1>
	</header>

	<nav id="breadcrumb">

        <?php if(isset($_SESSION['login']) && $_SESSION['login'] == true){ ?>
            <p>Ciao <?=$_SESSION['username']?>! Ti trovi in: <a href="home.php" lang="en">Home</a> &gt; &gt; Servizi</p>
            <a href="logout.php">Logout</a>
        <?php }else{ ?>
            <p>Ti trovi in: <a href="home.php" lang="en">Home</a> &gt; &gt; Servizi</p>
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
            <li>Servizi</li>
            <li><a href="eventi.php">Eventi e Gare</a></li>
            <li><a href="recensioni.php">Recensioni</a></li>
            <?php if(isset($_SESSION['login']) && $_SESSION['login']){ ?>
				<li><a href="areaPersonale.php">Profilo</a></li>
			<?php } ?>
		</ul>
	</nav>      
    
    <h2 class="titolo"> Le nostre baite </h2>
    <article class="box">  
        <h3> 360 Gradi </h3>
        <p> Pranzare mentre si ammira un panorama mozzafiato? 
        E' possibile in cima al Monte Cristallo, in prossimità dell'impianto di risalita, grazie alla nostra terrazza dotata di pannelli di vetro che vi assicura un'ottima sosta per recuperare le forze e per rimanere al caldo almeno per un po'.</p> 
        <p>Il posto offre una tavola calda con ampia scelta di primi e secondi piatti originali del posto, tra una portata e l'altra potrete godervi la splendida vista dei monti innevati</p>
        <p> Numero di telefono 398 0745612 </p>
    </article>
    <article class="box">  
        <h3> Rifugio "Camposcuola" </h3>
        <p> Nell'area più frequentata delle nostre piste, ideale per una fermata in famiglia, si trova il nostro rifugio, il quale offre un buon menù, che si
        adatta facilmente a tutti.</p> 
        <p>Durante la settimana è sempre disponibile un menù fisso a 15€ (primo + secondo) e uno a 10€ (solo primo o solo secondo); ricordiamo che in entrambi sono incluse le bevande.</p> 
        <p>Da quest'anno, ci sarà qualcosa di nuovo: una piccola parte sarà dedicata alla pizzeria, la quale prevede un menù fisso 
        a 15€ per pizza e bibita.</p>
        <p> Numero di telefono: 321 6549870 </p>
    </article>
    <article class="box">  
        <h3> Bar <span lang="en">"Fast & go"</span> </h3>
        <p> Per gli amanti di panini e birra, ai piedi delle piste, si trova questo bar che sicuramente soddisferà le vostre richieste: velocità nel servizio, ottima qualità e prezzo economico: calza a pennello per chi ha voglia di mangiare qualcosa al volo senza perdere troppo tempo.</p>
        <p>Il menù varia dai panini classici con l’affettato (soppressa veneta, speck, prosciutto crudo e cotto e salame) ai più particolare e sfiziosi
        con cotoletta, <span lang="en"> wurstel, hamburger </span> e doppio strato <span lang="en"> hamburger </span> con formaggio caldo e filante. Ovviamente non possono mancare <span lang="en"> ketchup </span>, maionese e salsa <span lang="en"> barbecue </span>.</p> 
        <p>Sei indeciso su che bibita abbinare al panino? Abbiamo a disposizione più di 10 birre diverse oltre alle classiche bibite, scegli la tua preferita!</p>
        <p> Numero di telefono: 345 2514766</p>
    </article>

    <h2 class="titolo"> Noleggio convenzionato </h2>
    <div class="content" id="noleggio">
        <img id="imgNoleggio" src="../images/noleggio.jpg" alt="Foto che raffigura gli sci e la montagna"/>
        <p>Il noleggio "Ski-Center" si trova vicino al parcheggio e alla biglietteria ai piedi della cabinovia C che porta in cima al monte Cristallo.</p><p>La struttura offre un’ampia gamma di sci, <span lang="en">snowboard, </span>scarponi, racchette da neve, caschi e altri tipi di attrezzatura/protezioni che vi permetteranno di trascorrere in tutta sicurezza delle giornate stupende sulle piste.</p><p>Oltre al servizio di noleggio si può trovare un assortimento ricco di accessori sia per lo sci che per lo <span lang="en"> snowboard, </span> un servizio per la manutenzione dei vostri sci/tavole (affilatura lamine e sciolinatura) e un comodo deposito dotato di armadietti, con serratura elettronica a codice, nei quali si potranno riporre effetti personali. Gli armadietti sono custoditi dal personale del noleggio.</p>
    </div>

    <h2 class="titolo"> Scuola di Sci</h2>
    <div class="content" id="scuola">
        <img id="imgMaestri" src="../images/maestri_sci.jpg" alt="I nostri maestri di sci"/>
        <p> Se vuoi metterti in gioco e imparare a sciare oppure vuoi solo migliorare, tenta con noi!</p>
        <p>Abbiamo a disposizione più di 10 maestri, ognuno qualificato per seguire il tuo percorso. Hai la possibilità di richiedere lezioni private se vuoi imparare più velocemente, oppure se preferisci stare in compagnia, puoi condividere la tua esperienza con il gruppo che ti viene assegnato.</p> 
        <p>Il gruppo dei principianti è composto da 3/8 persone, quello intermedio da 4/10 persone, mentre quello degli esperti da 4/15 persone.</p> 
        <p>Offriamo corsi per sci alpino e <span lang="en"> snowboard </span> per qualsiasi età. Affrettati a prenotare la tua lezione di prova!</p>
    </div>

    <?php include('../components/footer.php') ?>			        

</body>
</html>







