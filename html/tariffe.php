<?php

if(!isset($_SESSION)) {
    session_start();
}

?>


<!DOCTYPE html>
<html lang="it">

<head>
	<meta charset="utf-8" />
	<title>Tariffe - Crystal Ski</title>
	<meta name="keywords" content="Tariffe, Listino Prezzi, Abbonamenti, Crystal Ski" />
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
        <p>Ciao <?=$_SESSION['username']?>! Ti trovi in: <a href="home.php" lang="en">Home</a> &gt; &gt; Tariffe</p>
        <a href="logout.php">Logout</a>
    <?php }else{ ?>
        <p>Ti trovi in: <a href="home.php" lang="en">Home</a> &gt; &gt; Tariffe</p>
        <a href="login.php">Login</a>
    <?php } ?>

    </nav>

    <input type="checkbox" id="menu-hamburger" class="menu-toggle" />
	<label for="menu-hamburger" class="hamburger"><span class="sr-only">menu</span></label>
	<nav id="menu">
		<ul>
			<li lang="en"><a href="home.php">Home</a></li>
            <li>Tariffe</li>
            <li><a href="mappa.php">Mappa</a></li>         
            <li><a href="servizi.php">Servizi</a></li>
            <li><a href="eventi.php">Eventi e Gare</a></li>
            <li><a href="recensioni.php">Recensioni</a></li>
            <?php if(isset($_SESSION['login']) && $_SESSION['login']){ ?>
				<li><a href="areaPersonale.php">Profilo</a></li>
			<?php } ?>
		</ul>
	</nav>

    <h2 class="titolo">Listino prezzi</h2>
    <div class="content" id="skipass">        
        <p id="assicurazione">L'ASSICURAZIONE DAL 1 GENNAIO 2022 E' OBBLIGATORIA, LA TARIFFA E' DI 5€ AL GIORNO A PERSONA</p>           
        <p>Indicazoni importanti:</p>
        <ul> 
            <li>I bambini nati dopo il 31/12/2013 entrano gratis se è presente un adulto pagante, altrimenti fare riferimento alla categoria <span lang="en">junior.</span></li>
            <li><span lang="en">Junior</span> comprende i ragazzi nati entro il 31/12/2007</li>
            <li><span lang="en">Senior</span> comprende le persone nate prima del 31/12/1956</li>
            <li>Per l'età non comprese nelle categoire precedenti fare riferimmento ad adulto</li>
            <li>La bassa stagione comprende i periodi dal 1/12/2021 al 17/12/2021 e dal 01/03/2022 a chiusura</li>
            <li>L'alta stagione comprende i periodi restanti</li>
        </ul>          
    </div>

    <table id="listino" title="In dettaglio i prezzi degli skipass da 3 ore, giornalieri, 3-5-7 giorni e mensile in base alla categoria di appartenenza Junior, Adulto e Senior"> 
        <caption> Prezzi degli <span lang="en">skipass</span></caption>
        <thead> 
            <tr>
                <th id="double-row" rowspan="2"></th>
                <th scope="col" colspan="3">Bassa stagione</th>
                <th scope="col" colspan="3">Alta stagione</th>
            </tr>
            <tr> 
                <th scope="col" lang="en">Junior</th> 
                <th scope="col">Adulto</th> 
                <th scope="col" lang="en">Senior</th>
                <th scope="col" lang="en">Junior</th> 
                <th scope="col">Adulto</th> 
                <th scope="col" lang="en">Senior</th>
            </tr>
        </thead>
        
        <tbody>
            <tr> 
                <th class="table-header" scope="row"> 3 Ore </th> 
                <td data-title="Bassa stagione - Junior" > 12€ </td>
                <td data-title="Bassa stagione - Adulto"> 27€ </td>
                <td data-title="Bassa stagione - Senior"> 18€ </td> 
                <td data-title="Alta stagione - Junior"> 15€ </td>
                <td data-title="Alta stagione - Adulto"> 32€ </td>
                <td data-title="Alta stagione - Senior"> 22€ </td> 
            </tr>
            
            <tr> 
                <th class="table-header" scope="row"> Giornaliero </th> 
                <td data-title="Bassa stagione - Junior" > 18€ </td>
                <td data-title="Bassa stagione - Adulto"> 35€ </td>
                <td data-title="Bassa stagione - Senior"> 25€ </td> 
                <td data-title="Alta stagione - Junior"> 20€ </td>
                <td data-title="Alta stagione - Adulto"> 37€ </td>
                <td data-title="Alta stagione - Senior"> 26€ </td> 
            </tr>
            
            <tr> 
                <th class="table-header"  scope="row"> 3 Giorni </th> 
                <td data-title="Bassa stagione - Junior" > 44€ </td>
                <td data-title="Bassa stagione - Adulto"> 87€ </td>
                <td data-title="Bassa stagione - Senior"> 61€ </td>
                <td data-title="Alta stagione - Junior"> 51€ </td>
                <td data-title="Alta stagione - Adulto"> 100€ </td>
                <td data-title="Alta stagione - Senior"> 74€ </td> 
            </tr>

            <tr> 
                <th class="table-header" scope="row"> 5 Giorni </th> 
                <td data-title="Bassa stagione - Junior" > 68€ </td>
                <td data-title="Bassa stagione - Adulto"> 132€ </td>
                <td data-title="Bassa stagione - Senior"> 105€ </td> 
                <td data-title="Alta stagione - Junior"> 81€ </td>
                <td data-title="Alta stagione - Adulto"> 158€ </td>
                <td data-title="Alta stagione - Senior"> 115€ </td>
            </tr>
            
            <tr> 
                <th class="table-header" scope="row"> 7 Giorni </th> 
                <td data-title="Bassa stagione - Junior" > 85€ </td>
                <td data-title="Bassa stagione - Adulto"> 164€ </td>
                <td data-title="Bassa stagione - Senior"> 120€ </td>
                <td data-title="Alta stagione - Junior"> 94€ </td>
                <td data-title="Alta stagione - Adulto"> 190€ </td>
                <td data-title="Alta stagione - Senior"> 137€ </td>
            </tr>

            <tr>
                <th class="table-header" scope="row"> Mensile </th> 
                <td data-title="Bassa stagione - Junior" > 300€ </td>
                <td data-title="Bassa stagione - Adulto"> 600€ </td>
                <td data-title="Bassa stagione - Senior"> 440€ </td>
                <td data-title="Alta stagione - Junior"> 359€ </td>
                <td data-title="Alta stagione - Adulto"> 749€ </td>
                <td data-title="Alta stagione - Senior"> 529€ </td>
            </tr>
        </tbody>        
    </table>


    <h2 class="titolo">Abbonamento Stagionale </h2>
    <div class="content" id="abbonamenti">
        <p>Per chi è interessato ad acquistare l'abbonamento, entro il 30/11/2021 si ha uno sconto del 15% ai prezzi sotto riportati.</p>
        <ul> 
            <li><span lang="en">Junior:</span> 850€</li>
            <li>Adulto: 1.500€</li>
            <li><span lang="en">Senior:</span> 1.100€</li>
        </ul>
        <p>All'acquisto di un abbonamento adulto, il genitore ha diritto ad un solo abbonamento gratuito da bambino per un solo figlio.</p>
        <p>In assenza dell'adulto pagante, il bambino è da considerarsi come <span lang="en">Junior.</span></p>
    </div>

    <?php include('../components/footer.php') ?>			        

</body>
</html>
