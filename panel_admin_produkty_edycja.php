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

	$query = $sql->prepare('SELECT * FROM produkty WHERE ID = :zmienna_ID');		
	$query->bindParam(':zmienna_ID', $_GET['ID_produktu'], PDO::PARAM_INT);
	$query->execute();
	$wiersz = $query->fetch(PDO::FETCH_ASSOC);	

?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<title>panel admin produkty edycja</title>
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
					<form enctype="multipart/form-data" method="POST" action="menago_product.php">
						<div class="dodawanie_do_bazy">
							<input type="hidden"  name="ID" <?php echo 'value="'.$_GET['ID_produktu'].'"' ?> >
							<div class="group_panel">
								<label>nazwa</label>
								<input type="text" <?php echo 'value="'.$wiersz['nazwa'].'"' ?> name="nazwa" size="30">
							</div>
							<div class="group_panel">
								<label>marka</label>
								<input type="text" <?php echo 'value="'.$wiersz['marka'].'"' ?> name="marka">
							</div>
							<div class="group_panel">
								<label>waga</label>
								<input type="number" step=".001" <?php echo 'value="'.$wiersz['waga'].'"' ?> name="waga">
							</div>
							<div class="group_panel">
								<label>cena</label>
								<input type="number" step=".01" <?php echo 'value="'.$wiersz['cena'].'"' ?> name="cena">
							</div>
							<div class="group_panel">
								<label>zdjecie: </label>
								<?php
									echo "<img src=".$wiersz['zdjecie']." alt='zdj_produktu' class='product_img_koszyk'>";
								?>
								<input type="file" name="zdjecie" accept="image/png, image/jpeg"  >	
							</div>
							<div class="group_panel">
								<label>opis_szczegolowy</label>
							</div>
							<div class="group_panel">
								<textarea rows="10" cols="50" type="text" name="opis_szczegolowy"><?php echo $wiersz['opis_szczegolowy'] ?></textarea>
							</div>
							<div class="group_panel">
								<label>promocja</label>
								<?php
									if($wiersz['promocja']=='tak')
										echo "<input type='checkbox' name='promocja' checked>";
									else
										echo "<input type='checkbox' name='promocja'>";
								?>
							</div>
							<div class="group_panel">
								<label>kategoria</label>
								<?php
									echo "<input list='kategoria_lista' name='kategoria' value='".$wiersz['kategoria']."'/>";
									$sql = new PDO('mysql:host=localhost;dbname=sklep2', "root", "");
									$query_kategoria = $sql->prepare('SELECT kategoria FROM produkty GROUP BY kategoria');		
									$query_kategoria->execute();
									echo "<datalist id='kategoria_lista'>";
									
									foreach($query_kategoria as $wiersz_kategoria)
									{
										echo "<option value=".$wiersz_kategoria['kategoria'].">";
									}
									
									echo "</datalist>";
								?>
							</div>
							<div class="group_panel">
								<label>pod kategoria</label>
								<?php
									echo "<input list='pod_kategoria_lista' name='pod_kategoria' value='".$wiersz['pod_kategoria']."'/>";
									$query_pod_kat = $sql->prepare('SELECT pod_kategoria FROM produkty GROUP BY pod_kategoria');		
									$query_pod_kat->execute();
									echo "<datalist id='pod_kategoria_lista'>";
									
									foreach($query_pod_kat as $wiersz_pod_kat)
									{
										echo "<option value=".$wiersz_pod_kat['pod_kategoria'].">";
									}
									
									echo "</datalist>";
								?>
							</div>
							<div class="group_panel">
								<label>ilość</label>
								<input type="number" <?php echo 'value="'.$wiersz['dostepna_ilosc'].'"' ?> step="any" name="ilosc">
							</div>
							<select name="option">
								<option value="edytuj">edytuj</option>
								<option value="usun">usuń</option>
							</select>
							<input type="submit" value="wykonaj" name="wykonaj">
						</div>
					</form>
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
