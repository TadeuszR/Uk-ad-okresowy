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
	$t = $_GET['nazwa'];
	$pierwiastek = pg_query($uchwyt_polaczenia, "select * from pierwiastki where nazwapl='".$t."';");
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
