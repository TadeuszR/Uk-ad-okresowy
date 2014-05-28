<html lang="pl">
<head>

  <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 

  <title>Połączenie z bazą danych</title>
<link rel="stylesheet" type="text/css" href="style.css" />
  <link rel="Stylesheet" href="uklad.css" type="text/css"> 

</head>

<body>
<header>
	<div class="container">
	

		<h1><a href="index.php">Układ okresowy pierwiastków</a></h1>
		<nav>
			<ul>
				<li><a href="index.php" class="current">Układ okresowy</a></li>
				<li class="two"><a href="stanskupienia.php">Stan skupienia</a></li>
				<li class="three"><a href="pierwiastki.php">Szukaj</a></li>
				<li class="four"><a href="historia.php">Historia odkryć</a></li>
				<li class="five"><a href="odkrywcy.php">Odkrywcy</a></li>
				<li class="six"><a href="ostronie.php">O stronie</a></li>
			</ul>
		</nav>
	</div>
</header>
<div class="main-box">
	<div class="container">
		<div class="inside">
			<div class="wrapper">

<!-- content -->
				<section id="content">
					<article>

	

<?php

  $uchwyt_polaczenia = pg_connect("host=fourier dbname=i1raczek user=i1raczek password=i1raczek");

  if (!$uchwyt_polaczenia) {

    echo "Błąd połączenia z PostgreSQL";

  } else {

     echo"<div>";
	$t = $_GET['symbol'];
	$t=mb_strtoupper($t);
	$t = str_replace('Ą','A',$t);
	$t = str_replace('Ć','C',$t);
	$t = str_replace('Ę','E',$t);
	$t = str_replace('Ł','L',$t);
	$t = str_replace('Ń','N',$t);
	$t = str_replace('Ó','O',$t);
	$t = str_replace('Ś','S',$t);
	$t = str_replace('Ż','Z',$t);
	$t = str_replace('Ź','Z',$t);
	$t = str_replace('ą','A',$t);
	$t = str_replace('ć','C',$t);
	$t = str_replace('ę','E',$t);
	$t = str_replace('ł','L',$t);
	$t = str_replace('ń','N',$t);
	$t = str_replace('ó','O',$t);
	$t = str_replace('ś','S',$t);
	$t = str_replace('ż','Z',$t);
	$t = str_replace('ź','Z',$t);
	$pierwiastek = pg_query($uchwyt_polaczenia, "select * from odkrywcy where upper(opis) like '%".$t."%' or upper(imie) like '%".$t."%'or upper(nazwisko) like '%".$t."%';");

	if ($p = pg_fetch_assoc($pierwiastek)) 
	{
		echo	"<h2>Wyniki wyszukiwania</h2><br/>";
		echo	"<h3><a href=\"o.php?id=".$p[idodkrywcy]."\">".$p[imie]." ".$p[nazwisko]."</a></h3><br/>";		
	}
	else
		echo "<h3>Nie znaleziono pierwiaska o podanych parametrach</h3>";
	while($p = pg_fetch_assoc($pierwiastek))
	{
	echo	"<h3><a href=\"o.php?id=".$p[idodkrywcy]."\">".$p[imie]." ".$p[nazwisko]."</a></h3><br/>";				
	} 
?>
<form method="get" action="szukaj.php">

   <p>

    <label>Szukaj pierwiastka:<input type="text" name="symbol"/></label>


    <input type="submit" value="Szukaj"/>   

   </p>

  </form>
<form method="get" action="szukajodkrywcy.php">

   <p>

    <label>Szukaj odkrywców:<input type="text" name="symbol"/></label>


    <input type="submit" value="Szukaj"/>   

   </p>

  </form>
	<?php
	echo"</div>";
    pg_close($uchwyt_polaczenia);

  }

?>

    
					</article>
				</section>
			</div>
		</div>
	</div>
	</div>
</div>
</html>
