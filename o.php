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

	echo "<div>";
	$t = $_GET['id'];
	$pierwiastek = pg_query($uchwyt_polaczenia, "select * from odkrywcy where idodkrywcy='".$t."';");
	if($p = pg_fetch_assoc($pierwiastek))
	{
		echo "<h2>".$p[imie]." ".$p[nazwisko]."</h2><br/>";
		echo "<h3>".$p[opis]."</h3>";
		echo "<h3>Odkryte pierwiastki:</h3>";
		
		
		$pierwiastek = pg_query($uchwyt_polaczenia, "select * from odkrywcy_has_odkrycia join odkrycia on odkrycia_idodkrycia = idodkrycia where odkrywcy_idodkrywcy='".$t."';");
		 echo "<div id=\"tablicaBox\" class=\"tools right grid_9\">";
    		
		echo "<div class=\"pierwDown\">";
		echo "<div>";
				while($p = pg_fetch_assoc($pierwiastek))
				{
				/***/
				$rezultat = pg_query($uchwyt_polaczenia, "select * from pierwiastki where idpierwiastki = ".$p[pierwiastki_idpierwiastki]." order by liczbaat;");
				$wiersz = pg_fetch_assoc($rezultat);
	$wart = pg_query($uchwyt_polaczenia, " select * from pierwiastki_has_wartosciowosci join wartosciowosci on(idwartosciowosci=Wartosciowosci_idWartosciowosci) where pierwiastki_idpierwiastki=".$wiersz[liczbaat].";");
	echo "<a href=\"posymbolu.php?symbol=".$wiersz[symbol]."\">"."<div class=\"";
	
	$alkal = pg_query("select nazwawlasciwoscialk from alkalicznewlasciwosci where idalkalicznewlasciwosci = (select alkaliczneWlasciwosci_idalkaliczneWlasciwosci from pierwiastki where idpierwiastki = ".$wiersz[liczbaat].");");
	$tmp = pg_fetch_assoc($alkal);
	echo str_replace(' ','',$tmp[nazwawlasciwoscialk]);
	echo "\"><p style=\"font-size:9;\">";
	while($liczba = pg_fetch_assoc($wart))
	{
		if($x!=0)
		{
			echo ",";
		}
		else
		{
			$x++;
		}
		if($liczba[typwartosciowosci_idtypwartosciowosci]==1)
		{
			echo "<b>".$liczba[wartosciowosc]."</b>";
		}
		else
		{
			if($liczba[typwartosciowosci_idtypwartosciowosci]==3)
			{
				echo "<i>".$liczba[wartosciowosc]."</i>";
			}
			else
			{
				echo $liczba[wartosciowosc];
			}
		}
	}
		echo "<br/><span><sub>".$wiersz[liczbaat]."</sub>".$wiersz[symbol]."</span>".$wiersz[nazwapl]."<br/>".$wiersz[masaat]."<span>";
	$x=0;
	
	
	echo "</span></p></div></a>";   
				
				/***/
				
				
				}
		echo "</div>";
		echo "</div>";
		echo "</div>";

	
	}
		else 
	echo "<h3>Nie znaleziono danych o podanych parametrach</h3>";

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
