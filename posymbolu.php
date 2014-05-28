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
	$pierwiastek = pg_query($uchwyt_polaczenia, "select * from pierwiastki where symbol='".$t."';");
	if($p = pg_fetch_assoc($pierwiastek))
	{
	echo "<table>";
		echo "<tr>";
			echo "<td>Nazwa polska</td>	<td>".$p[nazwapl]."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>Nazwa łacińska</td>	<td>".$p[nazwalat]."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>Symbol chemiczny</td>	<td>".$p[symbol]."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>Liczba atomowa</td>	<td>".$p[liczbaat]."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>Masa</td>	<td>".$p[masaat]."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>Temperatura topnienia</td>	<td>".$p[temptopnienia]."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>Temperatura wrzenia</td>	<td>".$p[tempwrzenia]."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>Elektroujemność</td>	<td>".$p[elektroujemnosc]."</td>";
		echo "</tr>";
		if ($p[liczbaat] < 105)
		$konfig = pg_query($uchwyt_polaczenia, "select konfiguracja('".$p[liczbaat]."');");
		if($k = pg_fetch_assoc($konfig))
		{
			$tab[]=$k[konfiguracja];
			while($k = pg_fetch_assoc($konfig))
			{	
				$tab[]=$k[konfiguracja];
			}
		echo "<tr>";
			echo "<td>Konfiguracja</td><td>";

				if($tab[0]!=0)  echo "1s<sup>".$tab[0]."</sup>";
				if($tab[1]!=0)  echo "2s<sup>".$tab[1]."</sup>";
				if($tab[2]!=0)  echo "2p<sup>".$tab[2]."</sup>";
				if($tab[3]!=0)  echo "3s<sup>".$tab[3]."</sup>";
				if($tab[4]!=0)  echo "3p<sup>".$tab[4]."</sup>";
				if($tab[6]!=0)  echo "3d<sup>".$tab[6]."</sup>";
				if($tab[5]!=0)  echo "4s<sup>".$tab[5]."</sup>";
				if($tab[7]!=0)  echo "4p<sup>".$tab[7]."</sup>";
				if($tab[9]!=0)  echo "4d<sup>".$tab[9]."</sup>";
				if($tab[12]!=0) echo "4f<sup>".$tab[12]."</sup>";
				if($tab[8]!=0)  echo "5s<sup>".$tab[8]."</sup>";
				if($tab[10]!=0) echo "5p<sup>".$tab[10]."</sup>";
				if($tab[13]!=0) echo "5d<sup>".$tab[13]."</sup>";
				if($tab[16]!=0) echo "5f<sup>".$tab[16]."</sup>";
				if($tab[11]!=0) echo "6s<sup>".$tab[11]."</sup>";
				if($tab[14]!=0) echo "6p<sup>".$tab[14]."</sup>";
				if($tab[17]!=0) echo "6d<sup>".$tab[17]."</sup>";
		echo "</tr>";
		}
			echo "<tr>";
			echo "<td>Wartościowości</td>";
			
			echo "<td>";
			$wart = pg_query($uchwyt_polaczenia, " select * from pierwiastki_has_wartosciowosci join wartosciowosci on(idwartosciowosci=Wartosciowosci_idWartosciowosci) where pierwiastki_idpierwiastki=".$p[liczbaat].";");
	
			$x=0;
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
			
			echo "</td>";
			echo "</tr>";
			/****************/
			
			echo "<tr>";
			echo "<td>Pochodzenie</td>";
				$odkrycie =  pg_query($uchwyt_polaczenia, " select * from wystepowanie where idwystepowanie=".$p[wystepowanie_idwystepowanie].";");	
			echo "<td>";
				if ($o = pg_fetch_assoc($odkrycie))
				{
						echo strtolower($o[nazwagdzie])."<br/>";					
				}
			echo "</td>";
			echo "</tr>";
			/***************/
			/****************/
			
			echo "<tr>";
			echo "<td>Odkrycie</td>";
				$odkrycie =  pg_query($uchwyt_polaczenia, " select * from odkrycia where pierwiastki_idpierwiastki=".$p[idpierwiastki].";");
				
			echo "<td>";
				if ($o = pg_fetch_assoc($odkrycie))
				{
					if ($o[rok] <=0) echo "znany w prehistori<br/>";
					else
					{
						echo $o[rok]."<br/>";
						$odkrywcy =  pg_query($uchwyt_polaczenia, "select * from odkrywcy_has_odkrycia join odkrywcy on (Odkrywcy_idOdkrywcy = idOdkrywcy ) where odkrycia_idodkrycia=".$o[idodkrycia].";");
						while($o = pg_fetch_assoc($odkrywcy))
						{
							echo "<a href=\"o.php?id=".$o[idodkrywcy]."\">".$o[imie]." ".$o[nazwisko]."</a><br/>";
						}
					}
				}
			echo "</td>";
			echo "</tr>";
			/***************/
	echo "</table>";
	}
	else 
	echo "<h3>Nie znaleziono pierwiaska o podanych parametrach</h3>";?>
<form method="get" action="szukaj.php">

   <p>

    <label>Szukaj:<input type="text" name="symbol"/></label>


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
