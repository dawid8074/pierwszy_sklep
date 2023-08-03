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
		<title>panel admin produkty</title>
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
					<form enctype="multipart/form-data"  method="POST" action="menago_product.php">
					<input type="hidden"  name="option" value="dodaj" >
						<div class="dodawanie_do_bazy">
							<div class="group_panel">
								<label>nazwa</label>
								<input type="text" name="nazwa">
							</div>
							<div class="group_panel">
								<label>marka</label>
								<input type="text" name="marka">
							</div>
							<div class="group_panel">
								<label>waga</label>
								<input type="number" step=".001" name="waga">
							</div>
							<div class="group_panel">
								<label>cena</label>
								<input type="number" step=".01" name="cena">
							</div>
							<div class="group_panel">
								<label>zdjecie: </label>
								<button type="reset">zresetuj</button>
								<input type="file" name="zdjecie" accept="image/png, image/jpeg"  >	
							</div>
							<div class="group_panel">
								<label>opis_szczegolowy</label>
							</div>
							<div class="group_panel">
								<textarea rows="10" cols="50" type="text" name="opis_szczegolowy" width="48" height="48" ></textarea>
							</div>
							<div class="group_panel">
								<label>promocja</label>
								<input type="checkbox" name="promocja" value="zaznaczony">
							</div>
							<div class="group_panel">
								<label>kategoria</label>
								<?php
									echo "<input list='kategoria_lista' name='kategoria' />";
									
									$query = $sql->prepare('SELECT kategoria FROM produkty GROUP BY kategoria');		
									$query->execute();
									echo "<datalist id='kategoria_lista'>";
									
									foreach($query as $wiersz)
									{
										echo "<option value=".$wiersz['kategoria'].">";
									}
									
									echo "</datalist>";
								?>

							</div>
							<div class="group_panel">
								<label>pod kategoria</label>
								<?php
									echo "<input list='pod_kategoria_lista' name='pod_kategoria' />";
									$query = $sql->prepare('SELECT pod_kategoria FROM produkty GROUP BY pod_kategoria');		
									$query->execute();
									echo "<datalist id='pod_kategoria_lista'>";
									
									foreach($query as $wiersz)
									{
										echo "<option value=".$wiersz['pod_kategoria'].">";
									}
									
									echo "</datalist>";
								?>
							</div>
							<div class="group_panel">
								<label>ilość</label>
								<input type="number" step="any" name="ilosc">
							</div>
							<input type="submit" value="dodaj" name="dodawania">
						</div>
					</form>
						<div class="dodawanie_do_bazy">
						<form method="POST" action="panel_admin_produkty.php">
							<div class="szukanie_w_bazie">
								<label>Podaj dane do wyszukania</label>
								<input type="text" name="dane" placeholder="nazwa/marka">
								<input type="submit" value="szukaj">
							</div>
						</form>
						<?php
						if(isset($_POST['dane']))
						{
							if($_POST['dane']!="")
								{;
								$podane_dane="%".$_POST['dane']."%";
								$query = $sql->prepare('SELECT * FROM produkty WHERE nazwa like :zmienna_dane OR marka like :zmienna_dane');		
								$query->bindParam(':zmienna_dane', $podane_dane, PDO::PARAM_STR);
								$query->execute();
						
								foreach($query as $wiersz)
								{
									echo "<li><a href='panel_admin_produkty_edycja.php?ID_produktu=".$wiersz['ID']."'>" .$wiersz['nazwa']." ->".$wiersz['marka']."</a></li><br>";
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
