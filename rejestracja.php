<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<title>rejestacja</title>
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
		<main id="main_rejestracja">

			<form method="POST" action="menago_klient.php">
			<input type="hidden"	name="option" value="dodaj" >
				<div class="under_article_rejestracja">
					<h1>Zarejestruj się</h1>
						<label>login</label>
						<input type="text" name="login" placeholder="Jan123">
						<label>hasło</label>
						<input type="password" name="password" placeholder="*******">
						<label>email</label>
						<input type="email" name="email" placeholder="Jan123@wp.pl">
						<label>Imię</label>
						<input type="text" name="imie" placeholder="Jan">
						<label>Nazwisko</label>
						<input type="text" name="nazwisko" placeholder="Kowalski">
						<label>Miejscowość</label>
						<input type="text" name="miejscowosc" placeholder="Warszawa">
						<label>Ulica</label>
						<input type="text" name="ulica" placeholder="Prosta">
						<label>Numer domu</label>
						<input type="text" name="numer_domu" placeholder="2a/3">
						<input type="submit" value="zarejestruj">
					
					<a href="zaloguj.php">Masz już konto? Zaloguj się!</a>
					<?php
						if(isset($_SESSION['info_menago']))
						{
							echo $_SESSION['info_menago'];
							unset($_SESSION['info_menago']);
						}
					?>
				</div>	
			</form>
			
				
		</main>
		
	</body>
</html>
