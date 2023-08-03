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
	$sql = new PDO('mysql:host=localhost;dbname=sklep2', "root", "");
?>


<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<title>panel admin zamowienia</title>
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
						<div class="dodawanie_do_bazy">
						<form method="POST" action="menago_zamowienia.php">
							<input type="hidden"	name="option" value="dodaj" >
							<div class="group_panel">
								<label>Klient</label>
								<?php
									$query = $sql->prepare('SELECT * FROM klienci WHERE ID!=1');		
									$query->execute();
									echo
										"<select name='ID_klienta' >";
										foreach($query as $row)
										{
											echo "<option value=". $row['ID'].">". $row['imie']." ".$row['nazwisko']." </option>";
										}
										echo "</select>";
								?>
							</div>
							<div class="group_panel">
								<label>nazwa</label>
								<input type="text" name="nazwa">
							</div>
							<div class="group_panel">
								<label>data zakupu</label>
								<input type="date" name="data" >
							</div>
							<div class="group_panel">
								<label>suma</label>
								<input type="number" step=".01" name="suma">
							</div>
							<input type="submit" value="dodaj" name="dodawania">
						</form>
						</div>
						<div class="dodawanie_do_bazy">
						<form method="POST" action="panel_admin_zamowienia.php">
							<div class="szukanie_w_bazie">
								<label>Podaj dane do wyszukania</label>
								<input type="text" name="dane" placeholder="nazwa zamowienia">
								<input type="submit" value="szukaj">
							</div>
						<?php
						if(isset($_POST['dane']))
						{
							if($_POST['dane']!="")
							{
								$podane_dane="%".$_POST['dane']."%";
								$query = $sql->prepare('SELECT * FROM zamowienia_ogolne WHERE nazwa like :zmienna_dane');
								$query->bindParam(':zmienna_dane', $podane_dane, PDO::PARAM_STR);
								$query->execute();
								foreach($query as $wiersz_z_o)
								{
									$query_two = $sql->prepare('SELECT * FROM klienci WHERE ID= :zmienna_dane');		
									$query_two->bindParam(':zmienna_dane', $wiersz_z_o['ID_klient'], PDO::PARAM_STR);
									$query_two->execute();
									$wiersz_klient = $query_two->fetch(PDO::FETCH_ASSOC);

									echo "<li><a href='panel_admin_zamowienia_edycja.php?ID=".$wiersz_z_o['ID']."'>" .$wiersz_z_o['nazwa']."-".$wiersz_klient['email']." [".$wiersz_z_o['data_zakupu']."]</a></li><br>";

								}
							}
							unset($_POST['dane']);
						}
						?>

						</div>
						</form
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
