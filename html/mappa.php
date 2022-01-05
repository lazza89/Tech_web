<?php
if(!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
	<meta charset="utf-8" />
	<title>Crystal Ski - Mappa e piste</title>
	<meta name="keywords" content="Crystal Ski, Sci, monte Cristallo, snowboard, mappa, piste, piste blu, piste rosse, piste nere, impianti, servizi"/>
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

    <?php if(isset($_SESSION['login']) && $_SESSION['login'] == true){ ?>
		<p>Ciao <?=$_SESSION['username']?>! Ti trovi in: <a href="home.php" lang="en">Home</a> &gt; &gt; Mappa</p>
        <a href="logout.php">Logout</a>
    <?php }else{ ?>
        <p>Ti trovi in: <a href="home.php" lang="en">Home</a> &gt; &gt; Mappa</p>
        <a href="login.php">Login</a>
    <?php } ?>
    
	</nav>

    <input type="checkbox" id="menu-hamburger" class="menu-toggle" />
	<label for="menu-hamburger" class="hamburger"><span class="sr-only">menu</span></label>
	<nav id="menu">
		<ul>
			<li lang="en"><a href="home.php">Home</a></li>
            <li><a href="tariffe.php">Tariffe</a></li>
            <li>Mappa</li>         
            <li><a href="servizi.php">Servizi</a></li>
            <li><a href="eventi.php">Eventi e Gare</a></li>
            <li><a href="recensioni.php">Recensioni</a></li>
            <?php if(isset($_SESSION['login']) && $_SESSION['login']){ ?>
				<li><a href="areaPersonale.php">Profilo</a></li>
			<?php } ?>
		</ul>
	</nav>


    <h2 class="titolo">Mappa e piste</h2>
    <img id="imgMappa" src="../images/mappa-piste.png" alt=""/>
    <a id="mappa-pdf" href="../images/mappa-piste.png" target="_blank" rel="noopener noreferrer" download>Clicca qui per scaricare la mappa</a>
    <article id="legenda">
        <div id="inner-box-left">
            <table class="slope-table" id="blue-table">
                <caption>Piste Blu (facile)</caption>
                <thead>
                    <tr>
                        <th>Numero Pista</th>
                        <th>Lunghezza (<abbr title="metri">m</abbr>)</th>
                        <th>Dislivello (<abbr title="metri">m</abbr>)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>2200</td>
                        <td>330</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>2750</td>
                        <td>355</td>
                    </tr>
                </tbody>
            </table>
            
            <table class="slope-table" id="red-table">
                <caption>Piste Rosse (media)</caption>
                <thead>
                    <tr>
                        <th>Numero Pista</th>
                        <th>Lunghezza (<abbr title="metri">m</abbr>)</th>
                        <th>Dislivello (<abbr title="metri">m</abbr>)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1 bis</td>
                        <td>1050</td>
                        <td>190</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>950</td>
                        <td>105</td>
                    </tr>
                    <tr>
                        <td>2 bis</td>
                        <td>1500</td>
                        <td>285</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>3550</td>
                        <td>809</td>
                    </tr>
                </tbody>
            </table>
            
            <table class="slope-table black-table">
                <caption>Piste Nere (difficile)</caption>
                <thead>
                    <tr>
                        <th>Numero Pista</th>
                        <th>Lunghezza (<abbr title="metri">m</abbr>)</th>
                        <th>Dislivello (<abbr title="metri">m</abbr>)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>3</td>
                        <td>1980</td>
                        <td>435</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>1400</td>
                        <td>400</td>
                    </tr>
                </tbody>
            </table>
            
            <table class="black-table">
                <caption>Biglietterie e Parcheggi</caption>
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Icona</th>
                        <th>Posizione</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Biglietterie</td>
                        <td class="icone"><img src="../images/icona-biglietteria.png" alt=""></td>
                        <td rowspan="2" id="collocazione"> Ai piedi dell'impianto A, C, E</td>
                    </tr>
                    <tr>
                        <td>Parcheggi</td>
                        <td class="icone"><img src="../images/icona-parcheggio.png" alt=""></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div id="inner-box-right">
            <table class="black-table">
                <caption>Impianti di risalita</caption>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Icona</th>
                        <th>Tipologia</th>
                        <th>Percorrenza</th>
                        <th colspan="2">Collegamenti</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>A</td>
                        <td class="icone"><img src="../images/icona-seggiovia.png" alt="icona seggiovia"></td>
                        <td>Seggiovia</td>
                        <td>7'33''</td>
                        <td>1</td>
                        <td>1bis</td>
                    </tr>
                    <tr>
                        <td>B</td>
                        <td class="icone"><img src="../images/icona-seggiovia.png" alt="icona seggiovia"></td>
                        <td>Seggiovia</td>
                        <td>5'30''</td>
                        <td>2</td>
                        <td>2bis</td>
                    </tr>
                    <tr>
                        <td>C</td>
                        <td class="icone"><img src="../images/icona-cabinovia.png" alt=""></td>
                        <td>Cabinovia</td>
                        <td>9'29''</td>
                        <td colspan="2">3</td>
                    </tr>
                    <tr>
                        <td>D</td>
                        <td class="icone"><img src="../images/icona-tappeto.png" alt=""></td>
                        <td>Tappeto</td>
                        <td>3'55''</td>
                        <td colspan="2">5</td>
                    </tr>
                    <tr>
                        <td>E</td>
                        <td class="icone"><img src="../images/icona-cabinovia.png" alt=""></td>
                        <td>Cabinovia</td>
                        <td>11'05''</td>
                        <td>4</td>
                        <td>6</td>
                    </tr>
                </tbody>
            </table>
            <table class="black-table">
                <caption>Servizi</caption>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Icona</th>
                        <th>Posizione</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>360 gradi</td>
                        <td class="icone"><img src="../images/icona-rifugio.png" alt=""></td>
                        <td>Cima Monte Cristallo</td>
                    </tr>
                    <tr>
                        <td>Camposcuola</td>
                        <td class="icone"><img src="../images/icona-rifugio.png" alt=""></td>
                        <td>Ai piedi dell'impianto C</td>
                    </tr>
                    <tr>
                        <td>Bar Fast & Go</td>
                        <td class="icone"><img src="../images/icona-rifugio.png" alt=""></td>
                        <td>Ai piedi dell'impianto A</td>
                    </tr>
                    <tr>
                        <td>Noleggio</td>
                        <td class="icone"><img src="../images/icona-noleggio.png" alt=""></td>
                        <td>Ai piedi dell'impianto C</td>
                    </tr>
                    <tr>
                        <td>Scuola Sci</td>
                        <td class="icone"><img src="../images/icona-skischool.png" alt=""></td>
                        <td>Ai piedi della pista 5</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </article>

        <?php include('../components/footer.php') ?>		

</body>
</html>