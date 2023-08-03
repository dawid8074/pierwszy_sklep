<?php
	session_start();
	if((!isset($_SESSION['zalogowany_ID'])))
	{
		header("Location: strona_glowna.php");
		exit();
	}
	$sql = new PDO('mysql:host=localhost;dbname=sklep2', "root", "");

?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<title>koszyk</title>
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
		<main id="main_koszyk">
			<article class="micro_body_koszyk">
					<h1 class="h1_koszyk">Twój koszyk</h1>
						<section class="s_opis_cechy_koszyk">
							<div class="d_opis_cechy_koszyk">
								<p class="opis_produkt_koszyk">Produkt</p>
								<p>Cena</p>
								<p>Ilość</p>
								<p>Wartosc</p>
							</div>
						</section>
					<form method="POST" action="menago_koszyk.php">
					<input type="hidden"	name="option" value="odswiez/kup">
						<section class="w_koszyku">
						<?php
							$suma_dla_zamowienia=0;
							if($_SESSION['koszyk']!="")
							{
								foreach($_SESSION['koszyk'] as $pozycja)
								{
									$query = $sql->prepare('SELECT * FROM produkty WHERE ID= :zmienna_ID');		
									$query->bindParam(':zmienna_ID', $pozycja[0], PDO::PARAM_INT);
									$query->execute();
									$wiersz = $query->fetch(PDO::FETCH_ASSOC);

									echo "<div class='element_w_koszyku'>";
										echo "<div class='product_kolumn_koszyk'>";
											echo "<img src=".$wiersz['zdjecie']." alt='zdj_produktu' class='product_img_koszyk'>";	
											echo "<p class='p1'>".$wiersz['nazwa']."</p>";
										echo "</div>";
										echo "<p class='p2'>".$wiersz['cena']." zł</p>";
										echo "<input size='1' value='".$pozycja[1]."' name='".$pozycja[0]."'>";
										$wartosc_dla_pozycji=$pozycja[1]*$wiersz['cena'];
										$suma_dla_zamowienia+=$wartosc_dla_pozycji;
										echo "<p>$wartosc_dla_pozycji zł  <a href='menago_koszyk.php?option=usun&id=".$pozycja[0]."'><span style='color:red'>X</span></a></p>";
										
									echo "</div>";
								}
							}
							echo "<input type='hidden'  name='suma' value='".$suma_dla_zamowienia."'>";
						?>

						</section>
						<section class="s_podsumowanie_koszyk">
							<div class="podsumowanie_napis_koszyk">
								<p  class="napis_wartosc_zamowienia_koszyk">Wartość zamówienia wynosi: </p>
								<p class="wartosc_zamowienia_koszyk"><?php echo $suma_dla_zamowienia ?> zł</p>
							</div>
							<div class="podsumowanie_napis_koszyk">
							<?php
								if(isset($_SESSION['info_menago']))
								{
									echo $_SESSION['info_menago'];
									unset($_SESSION['info_menago']);
								}
							?>
							<input type="submit" value="popraw ceny" name="akcja" class="kup_teraz_button_koszyk">
							<input type="submit" value="kup teraz" name="akcja" class="kup_teraz_button_koszyk">
							</div>
						</section>
					</form>
			</article>

		</main>
		
	</body>
</html>
