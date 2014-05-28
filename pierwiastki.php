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
<!---------------------------->



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
</article>
				</section>
			</div>
		</div>
	</div>
	</div>
</div>
</html>
