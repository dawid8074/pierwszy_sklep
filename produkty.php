<?php
	session_start();

	$sql = new PDO('mysql:host=localhost;dbname=sklep2', "root", "");

	if(isset($_GET['kategoria']))
	{
		if(isset($_GET['pod_kategoria']))
		{
			$query = $sql->prepare('SELECT * FROM produkty WHERE kategoria = :zmienna_kategoria AND pod_kategoria= :zmienna_pod_kategoria');		
			$query->bindParam(':zmienna_kategoria', $_GET['kategoria'], PDO::PARAM_STR);
			$query->bindParam(':zmienna_pod_kategoria', $_GET['pod_kategoria'], PDO::PARAM_STR);

		}
		else {

			$query = $sql->prepare('SELECT * FROM produkty WHERE kategoria = :zmienna_kategoria');		
			$query->bindParam(':zmienna_kategoria', $_GET['kategoria'], PDO::PARAM_STR);

		}
	}
	else 
	{
		if(isset($_GET['promocja']))
		{
			$query = $sql->prepare('SELECT * FROM produkty WHERE promocja="tak"');	
		}
		else
		{;
			$query = $sql->prepare('SELECT * FROM produkty');		
		}
	}
	$query->execute();
?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<title>produkty</title>
		<link rel="stylesheet" href="style_glowna.css">
	</head>
	<body>
		 <header>
			<figure class="logo">
				<img src="sklep_pl.png" width="100" height="100" alt="logo sklep.pl">
			</figure>
			<ul class="link_head">
				<?php
					if(isset($_SESSION['zalogowany_ID']))
					{
						echo "<li><a href='panel.php'>Twoje konto</a></li>";
						echo "<li><a href='koszyk.php'>Twój koszyk</a></li>";
					}
						else
						echo "<li><a href='zaloguj.php'>zaloguj się</a></li>";
				?>
			</ul>
		 </header> 
		<nav id="nav">
			<ul>
				<li><a href="strona_glowna.php">strona główna</a></li>
				<li><a href="produkty.php">produkty</a></li>
				<li><a href="produkty.php?promocja=tak">promocje</a></li>
				<li><a href="kontakt.php">kontakt</a></li>
			</ul>
		</nav>
		<main id="main_produkty">
			<article>
				<section class="s_produkty_produkty">
					<?php
						foreach($query as $wiersz)
						{
							if($wiersz['dostepna_ilosc']>0)
							{
							echo "<form method='POST' action='menago_koszyk.php'>";
							echo "<div class='elemnent_produkty'>";
								echo "<input type='hidden'	name='option' value='dodaj' >";
								echo "<input type='hidden'  name='ID_produktu' value='".$wiersz['ID']."' >";
								echo	
										"<a href='przedmiot.php?id_produktu=".$wiersz['ID']."'</a>
										<img src=".$wiersz['zdjecie']." alt='zdj_produktu' class='product_img_produkty'>
										</a>";
								echo
										"<p class='p1_produkty'>".$wiersz['nazwa']." </p>";
								echo	
										"<p class='p2_produkty'>".$wiersz['cena']." zł</p>";
								if(isset($_SESSION['zalogowany_ID']))
								{
								echo
										"<input type='submit' value='do koszyka' class='do_koszyka_button_produkty'>";
								}
							echo "</form>";
							echo "</div>";
							}
						}
					?>
		
				</section>		
			</article>
			<section class="nav2_produkty">
				<div>
					<h2 class="h2_produkty">Kategorie:</h2>
				</div>
				<a href="produkty.php?kategoria=kot" class="nazwa_kategorii_produkty">koty</a>
				<a href="produkty.php?kategoria=kot&pod_kategoria=karma">-karma</a>
				<a href="produkty.php?kategoria=kot&pod_kategoria=lezanki">-leżanki</a>
				<a href="produkty.php?kategoria=kot&pod_kategoria=zwirki">-żwirki</a>
				<a href="produkty.php?kategoria=pies" class="nazwa_kategorii_produkty">psy</a>
				<a href="produkty.php?kategoria=pies&pod_kategoria=karma">-karma</a>
				<a href="produkty.php?kategoria=pies&pod_kategoria=lezanki">-leżanki</a>
				<a href="produkty.php?kategoria=ptak" class="nazwa_kategorii_produkty">latajace</a>
				<a href="produkty.php?kategoria=ptak&pod_kategoria=karma">-karma</a>
				<a href="produkty.php?kategoria=ptak&pod_kategoria=klatki">-klatki</a>
			</section>
			
		</main>
		
	</body>
</html>
