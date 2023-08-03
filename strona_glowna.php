<?php
	
	session_start();
	$sql = new PDO('mysql:host=localhost;dbname=sklep2', "root", "");

?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<title>Strona główna</title>
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
		<main id="main_glowna">
			<article class="micro_body_glowna">
				<div class="goracy_ostatni_glowna">

					<section class="goracy_strzal_glowna">
						<h1 class="h1_glowna">Gorący strzał</h1>
						<?php
							$query = $sql->prepare('SELECT * FROM produkty WHERE promocja="tak" AND dostepna_ilosc>0 ORDER BY ID DESC LIMIT 1');
							$query->execute();
							$wiersz = $query->fetch(PDO::FETCH_ASSOC);
							echo	
										"<a href='przedmiot.php?id_produktu=".$wiersz['ID']."'</a>
										<img src=".$wiersz['zdjecie']." alt='zdj_produktu' class='product_img_produkty'>
										</a>";

								echo
										"<p class='p1_glowna'>".$wiersz['nazwa']." </p>";
								echo	
										"<p class='p2_glowna'>".$wiersz['cena']." zł</p>";

						?>
					</section>

					<section class="ostatni_zakup_glowna">
						<h1 class="h1_glowna">Ostatni zakup w naszym sklepie</h1>
						<?php
							$query = $sql->prepare('SELECT * FROM zamowienia_szczegolowe ORDER BY ID DESC LIMIT 1');
							$query->execute();
							$wiersz = $query->fetch(PDO::FETCH_ASSOC);
							$zmienna_id=$wiersz['ID_produktu'];

							$query = $sql->prepare('SELECT * FROM produkty WHERE ID = :zmienna_id');		
							$query->bindParam(':zmienna_id', $zmienna_id, PDO::PARAM_INT);
							$query->execute();
							$wiersz = $query->fetch(PDO::FETCH_ASSOC);
								echo	
										"<a href='przedmiot.php?id_produktu=".$wiersz['ID']."'</a>
										<img src=".$wiersz['zdjecie']." alt='zdj_produktu' class='product_img_produkty'>
										</a>";

								echo
										"<p class='p1_glowna'>".$wiersz['nazwa']." </p>";
								echo	
										"<p class='p2_glowna'>".$wiersz['cena']." zł</p>";
				
						?>
			
					</section>
				</div>
				<div class="d_polecane_glowna">
					<h1 class="h1_glowna">Polecane</h1>
						<section class="s_polecane_glowna">
	
							<?php
								$query = $sql->prepare('SELECT * FROM produkty WHERE promocja="tak" AND dostepna_ilosc>0 ORDER BY ID ASC LIMIT 5');	
								$query->execute();
								foreach($query as $wiersz)
								{
								echo "<div class='elemnent_produkty'>";
									echo	
											"<a href='przedmiot.php?id_produktu=".$wiersz['ID']."'</a>
											<img src=".$wiersz['zdjecie']." alt='zdj_produktu' class='small_jpg_glowna'>
											</a>";
									echo
											"<p class='p1_produkty'>".$wiersz['nazwa']." </p>";
									echo	
											"<p class='p2_produkty'>".$wiersz['cena']." zł</p>";
						
								echo "</div>";
								}
							?>

						</section>
				</div>		
			</article>
			<article class="nav2_glowna">
				<div>
					<h2>Propozycje</h2>
				</div>
				<a href="produkty.php?kategoria=kot" class="nazwa_kategorii_produkty">koty</a>
				<a href="produkty.php?kategoria=pies" class="nazwa_kategorii_produkty">psy</a>

			</article>
			
		</main>
		
	</body>
</html>
