<?php
	session_start();
	if((!isset($_SESSION['zalogowany_ID'])))
	{
		header("Location: strona_glowna.php");
		exit();
	}
	else 
	{
		if ($_SESSION['zalogowany_ID']!=1) 
		{
		header("Location: strona_glowna.php");
		exit();
		}
	}

?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<title>panel admin klienci</title>
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
		<main id="main_panel2">
			<article>
				<div class="under_article_panel2">
					<section class="nav_admin">
						<div class="d_nav_admin">
							<a href="panel_admin_klienci.php">administracja klientow</a>
							<a href="panel_admin_produkty.php">administracja produktow</a>
							<a href="panel_admin_zamowienia.php">administracja zamowien</a>
							<a href="panel_admin_produkty_zamowien.php">administracja produktow w zamowieniach</a>
						</div>
					</section>
					<section class="under_nav_admin">
					<form method="POST" action="menago_klient.php">
					<input type="hidden"	name="option" value="dodaj" >
						<div class="dodawanie_do_bazy">
							<div class="group_panel">
								<label>login</label>
								<input type="text" name="login">
							</div>
							<div class="group_panel">
								<label>hasło</label>
								<input type="text" name="password">
							</div>
							<div class="group_panel">
								<label>email</label>
								<input type="email" name="email">
							</div>
							<div class="group_panel">
								<label>imię</label>
								<input type="text" name="imie">
							</div>
							<div class="group_panel">
								<label>nazwisko</label>
								<input type="text" name="nazwisko" >
							</div>
							<div class="group_panel">
								<label>miejscowość</label>
								<input type="text" name="miejscowosc">
							</div>
							<div class="group_panel">
								<label>ulica</label>
								<input type="text" name="ulica">
							</div>
							<div class="group_panel">
								<label>numer domu</label>
								<input type="text" name="numer_domu">
							</div>
							<input type="submit" value="dodaj">
						</div>
					</form>
					<div class="dodawanie_do_bazy">
						<form method="POST" action="panel_admin_klienci.php">
							<div class="szukanie_w_bazie">
								<label>Podaj dane do wyszukania</label>
								<input type="text" name="dane" placeholder="imie/nazwisko/email">
								<input type="submit" value="szukaj">
							</div>
						</form>
						<?php
						if(isset($_POST['dane']))
						{
							if($_POST['dane']!="")
								{
								$sql = new PDO('mysql:host=localhost;dbname=sklep2', "root", "");
								$podane_dane="%".$_POST['dane']."%";
								$query = $sql->prepare('SELECT * FROM klienci WHERE imie like :zmienna_dane OR nazwisko like :zmienna_dane OR email like :zmienna_dane');		
								$query->bindParam(':zmienna_dane', $podane_dane, PDO::PARAM_STR);
								$query->execute();
						
								foreach($query as $wiersz)
								{
									echo "<li><a href='panel_admin_klienci_edycja.php?ID_klient=".$wiersz['ID']."'>" .$wiersz['imie']." ".$wiersz['nazwisko']."&nbsp;&nbsp;&nbsp;&nbsp;".$wiersz['email']."</a></li><br>";
								}
							}
							$_POST['dane']="";
						}
						?>

					</div>
					</section>
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
