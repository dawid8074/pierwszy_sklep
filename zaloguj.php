<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<title>zaloguj</title>
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
		<main id="main_zaloguj">
			<article>
				<form method="POST" action="skrypt_logowania.php">
					<div class="under_article_zaloguj">
						<h1>Zaloguj się</h1>
						<label>login</label>
						<input type="text" name="login" placeholder="Jan123">
						<label>hasło</label>
						<input type="password" name="password" placeholder="*******">
						<input type="submit" name="przycisk" value="zaloguj">
						<?php
							if(isset($_SESSION['blad_logowania']))
							{
								echo $_SESSION['blad_logowania'];
								unset($_SESSION['blad_logowania']);
							}
						?>
						<a href="rejestracja.php">Nie masz konta? Zarejestruj się!</a>
					
					</div>	
				</form>
				
			</article>
			
		</main>
		
	</body>
</html>
