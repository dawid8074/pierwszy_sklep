<?php
	session_start();
	if((!isset($_SESSION['zalogowany_ID'])))
	{
		header("Location: strona_glowna.php");
		exit();
	}

	$sql = new PDO('mysql:host=localhost;dbname=sklep2', "root", "");

	$query = $sql->prepare('SELECT * FROM klienci WHERE ID = :zmienna_ID');		
	$query->bindParam(':zmienna_ID', $_SESSION['zalogowany_ID'], PDO::PARAM_INT);
	$query->execute();
	$wiersz = $query->fetch(PDO::FETCH_ASSOC);	
?>


<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<title>moje konto</title>
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
		<main id="main_panel">
			<article>
				<div class="under_article_panel">
				<h1>Moje dane</h1>
					<form method="POST" action="menago_klient.php">
						<input type="hidden"	name="ID" <?php echo 'value="'.$wiersz['ID'].'"' ?> >
						<div class="group_panel">
							<label>login</label>
							<input type="text" <?php echo 'value="'.$wiersz['login'].'"' ?> name="login" placeholder="Jan123">
						</div>
						<div class="group">
							<label>hasło</label>
							<input type="tekst" name="password" placeholder="">
						</div>
						<div class="group">
							<label>email</label>
							<input type="email" <?php echo 'value="'.$wiersz['email'].'"' ?> name="email" placeholder="Jan123@wp.pl">
						</div>
						<div class="group">
							<label>imię</label>
							<input type="text" <?php echo 'value="'.$wiersz['imie'].'"' ?> name="imie" placeholder="Jan">
						</div>
						<div class="group">
							<label>Nazwisko</label>
							<input type="text" <?php echo 'value="'.$wiersz['nazwisko'].'"' ?> name="nazwisko" placeholder="Kowalski">
						</div>
						<div class="group">
							<label>Miejscowość</label>
							<input type='text' <?php echo 'value="'.$wiersz['miejscowosc'].'"' ?> name='miejscowosc' placeholder='Warszawa'>
						</div>
						<div class="group">
							<label>Ulica</label>
							<input type="text" <?php echo 'value="'.$wiersz['ulica'].'"' ?> name="ulica" placeholder="Prosta">
						</div>
						<div class="group">
							<label>Numer domu</label>
							<input type="text" <?php echo 'value="'.$wiersz['numer_domu'].'"' ?> name="numer_domu" placeholder="2a/3">
						</div>
						<select name="option">
							<option value="edytuj">edytuj</option>
							<option value="usun">usuń</option>
						</select>
						<input type="submit" value="wykonaj" name="wykonaj">
						
					</form>	
					<?php
							if(isset($_SESSION['info_menago']))
							{
								echo $_SESSION['info_menago'];
								unset($_SESSION['info_menago']);
							}
						?>
				</div>				
				
			</article>
			<section class="nav2_panel">
				<a href="panel.php">moje dane</a>
				<a href="panel2.php">historia zamowień</a>
				<a href="skrypt_logowania.php?wyloguj=tak">wyloguj</a>
				<?php
					if($_SESSION['zalogowany_ID']==1)
						echo "<a href='panel_admin.php'>panel administratora</a>";
				?>
				
			</section>
			
		</main>
		
	</body>
</html>
