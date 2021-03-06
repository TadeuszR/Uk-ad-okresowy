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
   
    <h3 class="title">Układ okresowy pierwiastków</h3>  
    <p class="opis" style="font-size: 12px; text-align: justify; line-height: 20px;">
    <br/>Pierwiastki uporządkowane są według ich rosnącej liczby atomowej oraz podzielone kolorystycznie na:
    <br/>
    Po kliknięciu na dany symbol pierwiastka można uzyskać informacje o: <br/> 
    nazwie w języku łacińskim, liczbie atomowej i masie atomowej, okresie i bloku energetycznym, nazwie grupy oraz </br>
    </br>wartościowości<ul>
    <li><b>wyjątkowo często występującej</b></li>
    <li>typowo występującej</li>
    <li><i>rzadko występującej</i></li>
    </ul>konfiguracji elektronowej, elektroujemności wg Paulinga, temperaturze topnienia i wrzenia.</p><br/><br/>
   <div class="pierwiastekInfo">
        	<div id="pierwiastek">
            	
            	</div>
            
            <div id="temperatura">
<table>
    <tr><td style="background-color:#7CFC00;"> niemetale</td> <td style="background-color:#00FF00;"> halogeny</td> </tr>
    <tr><td style="background-color:#30B030;">gazy szlachetne </td> <td style="background-color:#FEFE33;"> półmetale </td> </tr>    
    <tr><td style="background-color:#00B7EB;"> metale alkaliczne</td> <td style="background-color:#4169E1;"> metale ziem alkalicznych</td> </tr>
    <tr><td style="background-color:#B803FF;"> lantanowce </td> <td style="background-color:#EE82EE;"> aktynowce </td> </tr>   
    <tr><td style="background-color:#00A693;"> metale przejściowe </td><td style="background-color:#69449C;"> metale bloku p </td> </tr>
</table>
	</div>
	</div>
        <div id="tablica">
	
	
	

<?php

  $uchwyt_polaczenia = pg_connect("host=fourier dbname=i1raczek user=i1raczek password=i1raczek");

  if (!$uchwyt_polaczenia) {

    echo "Błąd połączenia z PostgreSQL";

  } else {

     $rezultat = pg_query($uchwyt_polaczenia, "select * from (select * from pierwiastki where liczbaat not between 58 and 71) as foo where liczbaat not between 90 and 103 order by grupa,liczbaat;");
     echo "<div>";
     for ($i = 0; $i<7; $i++)
     {
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
     }
     echo "</div>";
     echo "<div style=\"margin-top: 71px;\">";
	for ($i = 0; $i<6;$i++)
{
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
     }
     echo "</div>";

     echo "<div  style=\"margin-top: 213px;\">";
     for ($i = 0; $i<4;$i++)
{
	$wiersz = pg_fetch_assoc($rezultat);
	$wart = pg_query($uchwyt_polaczenia, " select * from pierwiastki_has_wartosciowosci join wartosciowosci on(idwartosciowosci=Wartosciowosci_idWartosciowosci) where pierwiastki_idpierwiastki=".$wiersz[liczbaat].";");
	echo "<a href=\"posymbolu.php?symbol=".$wiersz[symbol]."\">"."<div class=\"";
	
	$alkal = pg_query("select nazwawlasciwoscialk from alkalicznewlasciwosci where idalkalicznewlasciwosci = (select alkaliczneWlasciwosci_idalkaliczneWlasciwosci from pierwiastki where idpierwiastki = ".$wiersz[liczbaat].");");
	$tmp = pg_fetch_assoc($alkal);
	echo str_replace(' ','',$tmp[nazwawlasciwoscialk]);
	echo "\"><p style=\"font-size:9px;\">";
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
     }
     echo"</div>";
     echo "<div  style=\"margin-top: 213px;\">";
     for ($i = 0; $i<4;$i++)
  {
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
     }     echo"</div>";;
     echo "<div  style=\"margin-top: 213px;\">";
     for ($i = 0; $i<4;$i++)
     {
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
     }     echo"</div>";;    
     echo "<div  style=\"margin-top: 213px;\">";
     for ($i = 0; $i<4;$i++)
{
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
     }     echo"</div>";
     echo "<div  style=\"margin-top: 213px;\">";
     for ($i = 0; $i<4;$i++)
{
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
     }     echo"</div>";   
     echo "<div  style=\"margin-top: 213px;\">";
     for ($i = 0; $i<4;$i++)
{
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
     }     echo"</div>";   
     echo "<div  style=\"margin-top: 213px;\">";
     for ($i = 0; $i<4;$i++)
 {
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
     }     
     echo"</div>";    
     echo "<div  style=\"margin-top: 213px;\">";
     for ($i = 0; $i<4;$i++)
{
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
     }     echo"</div>";
     echo "<div  style=\"margin-top: 213px;\">";
     for ($i = 0; $i<4;$i++)
{
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
     }
     echo"</div>";    
     echo "<div  style=\"margin-top: 213px;\">";
     for ($i = 0; $i<4;$i++)
     {
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
     }
     echo"</div>";
     
     
     echo "<div  style=\"margin-top: 71px;\">";
     for ($i = 0; $i<6;$i++)
{
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
     }     echo"</div>";
     echo "<div  style=\"margin-top: 71px;\">";
     for ($i = 0; $i<6;$i++)
{
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
     }
     echo"</div>";
     echo "<div  style=\"margin-top: 71px;\">";
     for ($i = 0; $i<6;$i++)
{
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
	echo "<br/><span><sub>".$wiersz[liczbaat]."</sub>".$wiersz[symbol]."</span>".$wiersz[nazwapl]."<br/>".$wiersz[masaat]."<span>";////
	$x=0;
	
	
	echo "</span></p></div></a>";     
     }
     echo"</div>";
	
     echo "<div  style=\"margin-top: 71px;\">";
     for ($i = 0; $i<6;$i++)
{
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
     }
     echo"</div>";
     echo "<div  style=\"margin-top: 71px;\">";
     for ($i = 0; $i<6;$i++)
{
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
     }
     echo"</div>";
     echo "<div>";
     for ($i = 0; $i<7;$i++)
{
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
     }
	     echo"</div>";
	     echo"</div>";
	?>

	<div class="pierwDown">
    	<div>
	<div></div>
	<div style="overflow:visible; font-size:14px; margin-top:25px;"><p>Lantanowce</p></div>
	<div></div>
	<?php  
	$rezultat = pg_query($uchwyt_polaczenia, "select * from pierwiastki where liczbaat between 58 and 71 or liczbaat between 90 and 103 order by liczbaat;");
	
	for ($i = 0; $i<14;$i++)
	{
	$wiersz = pg_fetch_assoc($rezultat);
	$wart = pg_query($uchwyt_polaczenia, " select * from pierwiastki_has_wartosciowosci join wartosciowosci on(idwartosciowosci=Wartosciowosci_idWartosciowosci) where pierwiastki_idpierwiastki=".$wiersz[liczbaat].";");
	echo "<a href=\"posymbolu.php?symbol=".$wiersz[symbol]."\">"."<div class=\"";
	
$alkal = pg_query("select nazwawlasciwoscialk from alkalicznewlasciwosci where idalkalicznewlasciwosci = (select alkaliczneWlasciwosci_idalkaliczneWlasciwosci from pierwiastki where idpierwiastki = ".$wiersz[liczbaat].");");
	$tmp = pg_fetch_assoc($alkal);
	echo str_replace(' ','',$tmp[nazwawlasciwoscialk]);
	echo "\"><p style=\"font-size:9;\">";
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
	echo "<br/><span><sub>".$wiersz[liczbaat]."</sub>".$wiersz[symbol]."</span>".$wiersz[nazwapl]."<br/>".$wiersz[masaat]."<span>";
	$x=0;
	
	echo "</span></p></div></a>";     
	}
	?>
	</div>
	    	<div>
	<div></div>
	<div style="overflow:visible; font-size:14px; margin-top:25px;"><p>Aktynowce</p></div>
	<div></div>
	<?php  

	for ($i = 0; $i<14;$i++)
	{
	$wiersz = pg_fetch_assoc($rezultat);
	$wart = pg_query($uchwyt_polaczenia, " select * from pierwiastki_has_wartosciowosci join wartosciowosci on(idwartosciowosci=Wartosciowosci_idWartosciowosci) where pierwiastki_idpierwiastki=".$wiersz[liczbaat].";");
	echo "<a href=\"posymbolu.php?symbol=".$wiersz[symbol]."\">"."<div class=\"";
	
	$alkal = pg_query("select nazwawlasciwoscialk from alkalicznewlasciwosci where idalkalicznewlasciwosci = (select alkaliczneWlasciwosci_idalkaliczneWlasciwosci from pierwiastki where idpierwiastki = ".$wiersz[liczbaat].");");
	$tmp = pg_fetch_assoc($alkal);
	echo str_replace(' ','',$tmp[nazwawlasciwoscialk]);
	echo "\"><p style=\"font-size:9;\">";
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
	echo "<br/><span><sub>".$wiersz[liczbaat]."</sub>".$wiersz[symbol]."</span>".$wiersz[nazwapl]."<br/>".$wiersz[masaat]."<span>";
	$x=0;
	
	echo "</span></p></div></a>";     
	}
	?>
	</div>
	<?php

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
