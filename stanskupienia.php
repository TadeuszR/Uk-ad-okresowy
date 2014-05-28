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
   <div id="tablicaBox" class="tools right grid_9">
   
	<div class="pierwiastekInfo">
        	<div id="pierwiastek">
    
            	</div>
            
            <div id="temperatura">
<?php
$temp=20;
$t = $_GET['temp'];
if ($t!="")
$temp = $t;
if ($temp<-273.15)
$temp = -273.15;
echo"<p><h3>Temperatura: ".$temp." &#176;C</h3>";
?>
<div>
<form method="get" action="stanskupienia.php">

   

    <label>Temperatura:<input type="text" name="temp"/></label>


    <input type="submit" value="Zmień"/>   

   </p>

  </form>
  </div><div>
  <table>
    <tr><td style="background-color:#fdfa00;"> ciała stałe</td></tr>
    <tr> <td style="background-color:#00FF00;"> ciecze</td> </tr>
    <tr><td style="background-color:#4169E1;">gazy </td></tr>
    <tr> <td style="background-color:#9edcff;"> nieznane </td> </tr>    
</table>
</div>
            </div>

        </div>

        <div id="tablica">
	
	
	

<?php
$tab_grup[0] = 7;
$tab_grup[1] = 6;
$tab_grup[] = 4;$tab_grup[] = 4;$tab_grup[] = 4;$tab_grup[] = 4;$tab_grup[] = 4;
$tab_grup[] = 4;$tab_grup[] = 4;$tab_grup[] = 4;$tab_grup[] = 4;$tab_grup[] = 4;
$tab_grup[] = 6;$tab_grup[] = 6;$tab_grup[] = 6;$tab_grup[] = 6;$tab_grup[] = 6;
$tab_grup[] = 7;
  $uchwyt_polaczenia = pg_connect("host=fourier dbname=i1raczek user=i1raczek password=i1raczek");

  if (!$uchwyt_polaczenia) {

    echo "Błąd połączenia z PostgreSQL";

  } else {
	     $rezultat = pg_query($uchwyt_polaczenia, "select * from (select * from pierwiastki where liczbaat not between 58 and 71) as foo where liczbaat not between 90 and 103 order by grupa,liczbaat;");
for ($j = 0; $j<18; $j++)
{

	     $przesuniecie = (7 - $tab_grup[$j])*71 ;
	     echo "<div style=\"margin-top:".$przesuniecie."\">";
	     for ($i = 0; $i<$tab_grup[$j]; $i++)
	     {
		$wiersz = pg_fetch_assoc($rezultat);
		
		echo "<a href=\"posymbolu.php?symbol=".$wiersz[symbol]."\">"."<div class=\"";
	/***/	
		if ($wiersz[temptopnienia] == null)
		{
			$stan = "NIEZNANY";
		}
		else if ($wiersz[temptopnienia] >= $temp)
		{
			$stan = "STALE";
		}
		else if  ($wiersz[tempwrzenia] >= $temp)
		{
			$stan = "CIECZ";
		}
		else
		{
			$stan = "GAZ";
		}
	/***/
		echo $stan;
	echo "\"><p style=\"font-size:10;\">";
	$x=0;
	$wart = pg_query($uchwyt_polaczenia, " select * from pierwiastki_has_wartosciowosci join wartosciowosci on(idwartosciowosci=Wartosciowosci_idWartosciowosci) where pierwiastki_idpierwiastki=".$wiersz[liczbaat].";");
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
		echo "</span></p></div></a>";     
	     }
	     echo "</div>";
	} ?>
	</div>
	<div class="pierwDown">
    	<div>
	<div></div>
	<div style="overflow:visible; font-size:14px; margin-top:25px;"><p>Lantanowce</p></div>
	<div></div>
	<?php  
	$rezultat = pg_query($uchwyt_polaczenia, "select * from pierwiastki where liczbaat between 58 and 71 or liczbaat between 90 and 103 order by liczbaat;");
	
	for ($i = 0; $i<14;$i++)
	{
	$x=0;
	$wiersz = pg_fetch_assoc($rezultat);
	$wart = pg_query($uchwyt_polaczenia, " select * from pierwiastki_has_wartosciowosci join wartosciowosci on(idwartosciowosci=Wartosciowosci_idWartosciowosci) where pierwiastki_idpierwiastki=".$wiersz[liczbaat].";");
	echo "<a href=\"posymbolu.php?symbol=".$wiersz[symbol]."\">"."<div class=\"";
		
	if ($wiersz[temptopnienia] == null)
		{
			$stan = "NIEZNANY";
		}
		else if ($wiersz[temptopnienia] >= $temp)
		{
			$stan = "STALE";
		}
		else if  ($wiersz[tempwrzenia] >= $temp)
		{
			$stan = "CIECZ";
		}
		else
		{
			$stan = "GAZ";
		}
	/***/
		echo $stan;
	echo "\"><p style=\"font-size:10;\">";
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
	echo "</span></p></div></a>";     
	}	?>
	</div>
	    	<div>
	<div></div>
	<div style="overflow:visible; font-size:14px; margin-top:25px;"><p>Aktynowce</p></div>
	<div></div>
	<?php  

	for ($i = 0; $i<14;$i++)
	{
	
	$x=0;
	$wiersz = pg_fetch_assoc($rezultat);
	$wart = pg_query($uchwyt_polaczenia, " select * from pierwiastki_has_wartosciowosci join wartosciowosci on(idwartosciowosci=Wartosciowosci_idWartosciowosci) where pierwiastki_idpierwiastki=".$wiersz[liczbaat].";");
	echo "<a href=\"posymbolu.php?symbol=".$wiersz[symbol]."\">"."<div class=\"";
		
	if ($wiersz[temptopnienia] == null)
		{
			$stan = "NIEZNANY";
		}
		else if ($wiersz[temptopnienia] >= $temp)
		{
			$stan = "STALE";
		}
		else if  ($wiersz[tempwrzenia] >= $temp)
		{
			$stan = "CIECZ";
		}
		else
		{
			$stan = "GAZ";
		}
	/***/
		echo $stan;
	echo "\"><p style=\"font-size:10;\">";
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
	echo "</span></p></div></a>";     
	}
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
