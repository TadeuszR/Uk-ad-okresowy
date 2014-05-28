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

  if (!$uchwyt_polaczenia) 
  {

    echo "Błąd połączenia z PostgreSQL";

  } else {

	echo "<h2>Naukowcy:</h2>";
	$prehist = pg_query($uchwyt_polaczenia, "select * from odkrywcy where nazwisko <>'' order by nazwisko,imie;");
	echo "<table>";
	while($p = pg_fetch_assoc($prehist))
	{	
		echo "<tr><td>";
		echo "<h3>";
		echo "<a href=\"o.php?id=".$p[idodkrywcy]."\">".$p[imie]." ".$p[nazwisko]."</a>"."</h3>";	
		echo "</td></tr>";
	}
	echo "</table>";
	
		echo "<h2>Instytuty:</h2>";
	$prehist = pg_query($uchwyt_polaczenia, "select * from odkrywcy where nazwisko is null order by imie;");
	echo "<table>";
	while($p = pg_fetch_assoc($prehist))
	{	
		echo "<tr><td>";
		echo "<h3>";
		echo "<a href=\"o.php?id=".$p[idodkrywcy]."\">".$p[imie]." ".$p[nazwisko]."</a>"."</h3>";	
		echo "</td></tr>";
	}
	echo "</table>";

	
				/***/
				
				
		echo "</div>";
		echo "</div>";
		echo "</div>";

	
	
		
	echo "</div>";
	

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
