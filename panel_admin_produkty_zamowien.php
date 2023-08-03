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
		<title>panel admin p_zamowien</title>
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
						<form method="POST" action="menago_produkty_zamowien.php">
						<input type="hidden"	name="option" value="dodaj" >
							<div class="group_panel">
								<label>Produkt</label>
								<?php
									$query = $sql->prepare('SELECT * FROM produkty');		
									$query->execute();
									echo
										"<select name='ID_produktu'>";
										foreach($query as $row)
										{
											echo "<option value=". $row['ID'].">". $row['nazwa']." </option>";
										}
										echo "</select>";
								?>
							</div>
							<div class="group_panel">
								<label>Zamowienie</label>
								<?php
									$query = $sql->prepare('SELECT * FROM zamowienia_ogolne');		
									$query->execute();
									echo
										"<select name='ID_zamowienia' style='width:50%;'>";
										foreach($query as $row)
										{
											echo "<option value=". $row['ID'].">". $row['nazwa']." </option>";
										}
										echo "</select>";
								?>
							</div>
							<div class="group_panel">
								<label>ilość</label>
								<input type="number" step="any" name="ilosc">
							</div>
							<div class="group_panel">
								<label>wartosc dla pozycji </label>
								<input type="number" step=".01" name="wartosc_dla_pozycji" placeholder="domyślnie z bazy">
							</div>
							<input type="submit" value="dodaj" name="dodaj">
							</form>
						</div>
						<div class="dodawanie_do_bazy">
						<form method="POST" action="panel_admin_produkty_zamowien.php">
							<div class="szukanie_w_bazie">
								<label>Podaj dane do wyszukania</label>
								<input type="text" name="dane" placeholder="nazwa zamowienia">
								<input type="submit" value="szukaj">
							</div>
						</form>
						<?php
						if(isset($_POST['dane']))
						{
							if($_POST['dane']!="")
								{
								echo "<span> zamowienie - email klient -> produkt </span><br>";
								//szukam nazwy zamowienia
								$sql = new PDO('mysql:host=localhost;dbname=sklep2', "root", "");

								$podane_dane="%".$_POST['dane']."%";
								$query = $sql->prepare('SELECT * FROM zamowienia_ogolne WHERE nazwa like :zmienna_dane');
								$query->bindParam(':zmienna_dane', $podane_dane, PDO::PARAM_STR);
								$query->execute();
								//echo "<span style='color:DarkTurquoise'> Wyszukiwanie po nazwie zamowienia</span><br>";
								foreach($query as $wiersz_z_o)
								{
									//szukam id produktów do zamowienia
									$query_two = $sql->prepare('SELECT * FROM zamowienia_szczegolowe WHERE ID_zamowienia = :zmienna_dane');		
									$query_two->bindParam(':zmienna_dane', $wiersz_z_o['ID'], PDO::PARAM_STR);
									$query_two->execute();
									foreach($query_two as $wiersz_z_s)
									{
										//szukam nazwy produktu
										$query_three = $sql->prepare('SELECT * FROM produkty WHERE ID= :zmienna_dane');		
										$query_three->bindParam(':zmienna_dane', $wiersz_z_s['ID_produktu'], PDO::PARAM_STR);
										$query_three->execute();
										$wiersz_product = $query_three->fetch(PDO::FETCH_ASSOC);
										//szukam nazwy uzytkownika
										$query_four = $sql->prepare('SELECT * FROM klienci WHERE ID= :zmienna_dane');		
										$query_four->bindParam(':zmienna_dane', $wiersz_z_o['ID_klient'], PDO::PARAM_STR);
										$query_four->execute();
										$wiersz_klient = $query_four->fetch(PDO::FETCH_ASSOC);


										echo "<li><a href='panel_admin_produkty_zamowien_edycja.php?ID=".$wiersz_z_s['ID']."'>" .$wiersz_z_o['nazwa']."-".$wiersz_klient['email']." [".$wiersz_z_o['data_zakupu']."] ---> ".$wiersz_product['nazwa']."</a></li><br>";
									}
								}

							}
							unset($_POST['dane']);
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
