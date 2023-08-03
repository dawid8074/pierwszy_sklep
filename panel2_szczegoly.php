<?php
	session_start();
	if((!isset($_SESSION['zalogowany_ID'])))
	{
		header("Location: strona_glowna.php");
		exit();
	}
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<title>historia zamowienia</title>
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
				<li><a href="kontakt.php">kontakt</a></li
			</ul>
		</nav>
		<main id="main_panel2">
			<article>
				<div class="under_article_panel2">
				<h1 class="h1_panel2">Moje zamówienia</h1>
					<section class="s_opis_cechy_panel2">
							<div class="d_opis_cechy_panel2">
								<p class="opis_produkt_panel2">Produkt</p>
								<p>Ilość</p>
								<p>Wartość</p>
							</div>
						</section>
					<section class="historia_zamowien_panel2">


						<?php
						
						$sql = new PDO('mysql:host=localhost;dbname=sklep2', "root", "");
						$query = $sql->prepare('SELECT * FROM zamowienia_szczegolowe WHERE ID_zamowienia = :zmienna_id_zamowienia');		
						$query->bindParam(':zmienna_id_zamowienia', $_GET['id_zamowienia'], PDO::PARAM_INT);
						$query->execute();


						foreach($query as $wiersz)
						{
							$query = $sql->prepare('SELECT * FROM produkty WHERE ID = :zmienna_id_produkty');		
							$query->bindParam(':zmienna_id_produkty', $wiersz['ID_produktu'], PDO::PARAM_INT);
							$query->execute();

							$wiersz_two = $query->fetch(PDO::FETCH_ASSOC);						
			

							echo
								"<div class='element_w_historia_zamowien_panel2'>
									<div class='product_kolumn_panel2'>

										<p class='p1_panel2'>".$wiersz_two['nazwa']."</p>
									</div>
									<p class='p2'>".$wiersz['ilosc']."</p>
									<p>".$wiersz['wartosc_dla_pozycji']." zł</p>
								</div>";
							}	
						?>
			
					</section>
				</div>				
				
			</article>
			<section class="nav2_panel">
				<a href="panel.php">moje dane</a>
				<a href="panel2.php">historia zamowień</a>
				<a href="skrypt_logowania.php?wyloguj=tak">wyloguj</a>
				<?php
					if($_SESSION['zalogowany_ID']==1)
						echo "<a href='panel_admin.php'>panel adinistratora</a>";
				?>
			</section>
			
		</main>
		
	</body>
</html>
