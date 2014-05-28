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

	echo "<h2>Pierwiastki znane w starożytności:</h2>";
	$prehist = pg_query($uchwyt_polaczenia, "select * from odkrycia where rok<=0;");
	echo "<table>";
	while($p = pg_fetch_assoc($prehist))
	{	
		echo "<tr><td>";
		$pierwiastek = pg_query($uchwyt_polaczenia, "select * from pierwiastki where idpierwiastki = ".$p[pierwiastki_idpierwiastki].";");
		$pierwiastek = pg_fetch_assoc($pierwiastek);
		echo "<h3>";
		echo "<a href=\"posymbolu.php?symbol=".$pierwiastek[symbol]."\">".$pierwiastek[symbol]."</a></td><td>"."</h3>"."<a href=\"posymbolu.php?symbol=".$pierwiastek[symbol]."\">".$pierwiastek[nazwapl]."</a>";	
		echo "</td></tr>";
	}
	echo "</table>";
	echo "<h2>Wiek XIII:</h2>";
	$prehist = pg_query($uchwyt_polaczenia, "select * from odkrycia where rok<=1300 and rok >1200 order by rok;");
	echo "<table>";
	while($p = pg_fetch_assoc($prehist))
	{	
		echo "<tr>";
		echo "<td>";
		$pierwiastek = pg_query($uchwyt_polaczenia, "select * from pierwiastki join odkrycia on idpierwiastki = pierwiastki_idpierwiastki where idpierwiastki = ".$p[pierwiastki_idpierwiastki].";");
		$pierwiastek = pg_fetch_assoc($pierwiastek);
		echo "<h3>";
		echo "<a href=\"posymbolu.php?symbol=".$pierwiastek[symbol]."\">".$pierwiastek[symbol]."</a></td><td>"."</h3>"."<a href=\"posymbolu.php?symbol=".$pierwiastek[symbol]."\">".$pierwiastek[nazwapl]."</a>";	
		echo "</td><td>".$p[rok]." r.";
		echo "</td><td>";
		/*odkrywcy*/
		$odkrywcy = pg_query($uchwyt_polaczenia, "select * from odkrywcy join odkrywcy_has_odkrycia on idodkrywcy = odkrywcy_idodkrywcy where odkrycia_idodkrycia = ".$p[idodkrycia].";");
		while($o = pg_fetch_assoc($odkrywcy))
		echo "<a href=\"o.php?id=".$o[idodkrywcy]."\">".$o[imie]." ".$o[nazwisko]."</a><br/>";
		
		echo "</td></tr>";
	}
	echo "</table>";
	
		echo "<h2>Wiek XVII:</h2>";
	$prehist = pg_query($uchwyt_polaczenia, "select * from odkrycia where rok<=1700 and rok >1600 order by rok;");
	echo "<table>";
	while($p = pg_fetch_assoc($prehist))
	{	
		echo "<tr>";
		echo "<td>";
		$pierwiastek = pg_query($uchwyt_polaczenia, "select * from pierwiastki join odkrycia on idpierwiastki = pierwiastki_idpierwiastki where idpierwiastki = ".$p[pierwiastki_idpierwiastki].";");
		$pierwiastek = pg_fetch_assoc($pierwiastek);
		echo "<h3>";
		echo "<a href=\"posymbolu.php?symbol=".$pierwiastek[symbol]."\">".$pierwiastek[symbol]."</a></td><td>"."</h3>"."<a href=\"posymbolu.php?symbol=".$pierwiastek[symbol]."\">".$pierwiastek[nazwapl]."</a>";	
		echo "</td><td>".$p[rok]." r.";
		echo "</td><td>";
		/*odkrywcy*/
		$odkrywcy = pg_query($uchwyt_polaczenia, "select * from odkrywcy join odkrywcy_has_odkrycia on idodkrywcy = odkrywcy_idodkrywcy where odkrycia_idodkrycia = ".$p[idodkrycia].";");
		while($o = pg_fetch_assoc($odkrywcy))
		echo "<a href=\"o.php?id=".$o[idodkrywcy]."\">".$o[imie]." ".$o[nazwisko]."</a><br/>";
		
		echo "</td></tr>";
	}
	echo "</table>";
	
		echo "<h2>Wiek XVIII:</h2>";
	$prehist = pg_query($uchwyt_polaczenia, "select * from odkrycia where rok<=1800 and rok >1700 order by rok;");
	echo "<table>";
	while($p = pg_fetch_assoc($prehist))
	{	
		echo "<tr>";
		echo "<td>";
		$pierwiastek = pg_query($uchwyt_polaczenia, "select * from pierwiastki join odkrycia on idpierwiastki = pierwiastki_idpierwiastki where idpierwiastki = ".$p[pierwiastki_idpierwiastki].";");
		$pierwiastek = pg_fetch_assoc($pierwiastek);
		echo "<h3>";
		echo "<a href=\"posymbolu.php?symbol=".$pierwiastek[symbol]."\">".$pierwiastek[symbol]."</a></td><td>"."</h3>"."<a href=\"posymbolu.php?symbol=".$pierwiastek[symbol]."\">".$pierwiastek[nazwapl]."</a>";	
		echo "</td><td>".$p[rok]." r.";
		echo "</td><td>";
		/*odkrywcy*/
		$odkrywcy = pg_query($uchwyt_polaczenia, "select * from odkrywcy join odkrywcy_has_odkrycia on idodkrywcy = odkrywcy_idodkrywcy where odkrycia_idodkrycia = ".$p[idodkrycia].";");
		while($o = pg_fetch_assoc($odkrywcy))
		echo "<a href=\"o.php?id=".$o[idodkrywcy]."\">".$o[imie]." ".$o[nazwisko]."</a><br/>";
		
		echo "</td></tr>";
	}
	echo "</table>";
	
		echo "<h2>Wiek XIX:</h2>";
	$prehist = pg_query($uchwyt_polaczenia, "select * from odkrycia where rok<=1900 and rok >1800 order by rok;");
	echo "<table>";
	while($p = pg_fetch_assoc($prehist))
	{	
		echo "<tr>";
		echo "<td>";
		$pierwiastek = pg_query($uchwyt_polaczenia, "select * from pierwiastki join odkrycia on idpierwiastki = pierwiastki_idpierwiastki where idpierwiastki = ".$p[pierwiastki_idpierwiastki].";");
		$pierwiastek = pg_fetch_assoc($pierwiastek);
		echo "<h3>";
		echo "<a href=\"posymbolu.php?symbol=".$pierwiastek[symbol]."\">".$pierwiastek[symbol]."</a></td><td>"."</h3>"."<a href=\"posymbolu.php?symbol=".$pierwiastek[symbol]."\">".$pierwiastek[nazwapl]."</a>";	
		echo "</td><td>".$p[rok]." r.";
		echo "</td><td>";
		/*odkrywcy*/
		$odkrywcy = pg_query($uchwyt_polaczenia, "select * from odkrywcy join odkrywcy_has_odkrycia on idodkrywcy = odkrywcy_idodkrywcy where odkrycia_idodkrycia = ".$p[idodkrycia].";");
		while($o = pg_fetch_assoc($odkrywcy))
		echo "<a href=\"o.php?id=".$o[idodkrywcy]."\">".$o[imie]." ".$o[nazwisko]."</a><br/>";
		
		echo "</td></tr>";
	}
	echo "</table>";
	
		echo "<h2>Wiek XX:</h2>";
	$prehist = pg_query($uchwyt_polaczenia, "select * from odkrycia where rok<=2000 and rok >1900 order by rok;");
	echo "<table>";
	while($p = pg_fetch_assoc($prehist))
	{	
		echo "<tr>";
		echo "<td>";
		$pierwiastek = pg_query($uchwyt_polaczenia, "select * from pierwiastki join odkrycia on idpierwiastki = pierwiastki_idpierwiastki where idpierwiastki = ".$p[pierwiastki_idpierwiastki].";");
		$pierwiastek = pg_fetch_assoc($pierwiastek);
		echo "<h3>";
		echo "<a href=\"posymbolu.php?symbol=".$pierwiastek[symbol]."\">".$pierwiastek[symbol]."</a></td><td>"."</h3>"."<a href=\"posymbolu.php?symbol=".$pierwiastek[symbol]."\">".$pierwiastek[nazwapl]."</a>";	
		echo "</td><td>".$p[rok]." r.";
		echo "</td><td>";
		/*odkrywcy*/
		$odkrywcy = pg_query($uchwyt_polaczenia, "select * from odkrywcy join odkrywcy_has_odkrycia on idodkrywcy = odkrywcy_idodkrywcy where odkrycia_idodkrycia = ".$p[idodkrycia].";");
		while($o = pg_fetch_assoc($odkrywcy))
		echo "<a href=\"o.php?id=".$o[idodkrywcy]."\">".$o[imie]." ".$o[nazwisko]."</a><br/>";
		
		echo "</td></tr>";
	}
	echo "</table>";
	
		echo "<h2>Wiek XXI:</h2>";
	$prehist = pg_query($uchwyt_polaczenia, "select * from odkrycia where rok<=2100 and rok >2000 order by rok;");
	echo "<table>";
	while($p = pg_fetch_assoc($prehist))
	{	
		echo "<tr>";
		echo "<td>";
		$pierwiastek = pg_query($uchwyt_polaczenia, "select * from pierwiastki join odkrycia on idpierwiastki = pierwiastki_idpierwiastki where idpierwiastki = ".$p[pierwiastki_idpierwiastki].";");
		$pierwiastek = pg_fetch_assoc($pierwiastek);
		echo "<h3>";
		echo "<a href=\"posymbolu.php?symbol=".$pierwiastek[symbol]."\">".$pierwiastek[symbol]."</a></td><td>"."</h3>"."<a href=\"posymbolu.php?symbol=".$pierwiastek[symbol]."\">".$pierwiastek[nazwapl]."</a>";	
		echo "</td><td>".$p[rok]." r.";
		echo "</td><td>";
		/*odkrywcy*/
		$odkrywcy = pg_query($uchwyt_polaczenia, "select * from odkrywcy join odkrywcy_has_odkrycia on idodkrywcy = odkrywcy_idodkrywcy where odkrycia_idodkrycia = ".$p[idodkrycia].";");
		while($o = pg_fetch_assoc($odkrywcy))
		echo "<a href=\"o.php?id=".$o[idodkrywcy]."\">".$o[imie]." ".$o[nazwisko]."</a><br/>";
		
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
