<?php
	session_start();
	if(isset($_GET['id_produktu']))
		{
			$sql = new PDO('mysql:host=localhost;dbname=sklep2', "root", "");

			$query = $sql->prepare('SELECT * FROM produkty WHERE ID = :zmienna_ID');		
			$query->bindParam(':zmienna_ID', $_GET['id_produktu'], PDO::PARAM_INT);
			$query->execute();
			$wiersz = $query->fetch(PDO::FETCH_ASSOC);	
			$count = $query->rowCount();
			if ($count!=1) 
			{
				header("Location: strona_glowna.php");
				exit();
			}

		}
		else
		{
			header("Location: strona_glowna.php");
			exit();
		}
		

?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<title>przedmiot</title>
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
		<main id="main_przedmiot">
			<article class="micro_body_przedmiot">
				<h1 class="h1_przedmiot"> <?php echo $wiersz['nazwa'] ?></h1>
				<section class="ogolny_opis_przedmiot">
					<img src= <?php echo $wiersz['zdjecie'] ?> alt="zdj_produktu" class="product_img_przedmiot">
					<div class="ogolny_opis_slowny_przedmiot">
						<div class="opis_slowny_przedmiot">
							<p>Marka:</p>
							<p>Nr produktu: </p>
							<p>Waga(kg): </p>
							<p class="cena_przedmiot"><?php echo $wiersz['cena'] ?> zł</p>
						</div>
						<div class="opis_slowny_przedmiot">
							<p><?php echo $wiersz['marka'] ?></p>
							<p><?php echo $wiersz['ID'] ?></p>
							<p><?php echo $wiersz['waga'] ?></p>
							<form method="POST" action="menago_koszyk.php">
								<input type="hidden"	name="option" value="dodaj" >
								<input type="hidden"  name="ID_produktu" <?php echo 'value="'.$wiersz['ID'].'"' ?> >
								<?php
									if(isset($_SESSION['zalogowany_ID']))
									{			
										echo "<input type='submit' value='do koszyka' class='do_koszyka_button_przedmiot'>";
									}
								?>
							</form>
							
						</div>

					
					</div>
					
				</section>	
				<section class="wpracowanie">
					<h1>Opis produktu</h1>
					<p> <?php echo $wiersz['opis_szczegolowy'] ?><p>
				
				</section>
									
			</article>
			<section class="nav2_produkty">
				<div>
					<h2>Kategorie:</h2>
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
