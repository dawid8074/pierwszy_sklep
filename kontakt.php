<?php
	session_start();


?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<title>kontakt</title>
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
		<main id="main_kontakt">
			<article>
			<form method="POST" action="kontakt.php">
				<div class="under_article_kontakt">
					<h1>Masz pytanie?</h1>
					<label> </label>
					<label>Napisz do nas na email:</label>
					<label class="email_sklepu_kontakt">kontakt@sklep.pl</label>
					<label>Lub napisz do nas wiadomość poprzez ten forumularz:</label>
					<label>Twój e-mail:</label>
					<input type="email" id="user-email" name="user-email" placeholder="poczta@gmail.com">
					<label>Treść:</label>
					<textarea rows="10" cols="50" id="content" name="content" placeholder="Dzień dobry. Mam pytanie co do produktu.."
					 ></textarea>
					<input type="submit" value="wyślij">
				</div>	
			</form>
			</article>
			<section class="nav2_glowna">
				<div>
					<h2>Propozycje</h2>
				</div>
				<a href="produkty.php?kategoria=kot" class="nazwa_kategorii_produkty">koty</a>
				<a href="produkty.php?kategoria=pies" class="nazwa_kategorii_produkty">psy</a>
			</section>
			
		</main>
		
	</body>
</html>
