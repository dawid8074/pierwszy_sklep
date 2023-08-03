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
		<title>panel admin zamowienia edycja</title>
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
					<form method="POST" action="menago_zamowienia.php">

						<div class="dodawanie_do_bazy"
				
							<div class="group_panel">

								<label>klient</label>
								<?php
									$query = $sql->prepare('SELECT * FROM zamowienia_ogolne WHERE ID = :zmienna_ID ');		
									$query->bindParam(':zmienna_ID', $_GET['ID'], PDO::PARAM_INT);
									$query->execute();
									$wiersz = $query->fetch(PDO::FETCH_ASSOC);


									$query = $sql->prepare('SELECT * FROM klienci WHERE ID != 1');		
									$query->execute();
									echo
										"<select name='ID_klient'>";
										foreach($query as $row)
										{
											echo "<option value=". $row['ID'];
											if($row['ID']==$wiersz['ID_klient']) 
											echo " selected";
											echo ">". $row['imie']." ".$row['nazwisko']." </option>";
										}
										echo "</select>";	
								?>
							</div>
							<div class="group_panel">
								
								<label>nazwa</label>
								<input type="text" name="nazwa"  <?php echo 'value="'.$wiersz['nazwa'].'"' ?>>
							</div>
							<div class="group_panel">
								<label>data zakupu</label>
								<input type="date" name="data"  <?php echo 'value="'.$wiersz['data_zakupu'].'"' ?>>
							</div>
							<div class="group_panel">
								<label>suma</label>
								<input type="number" step=".01" name="suma"  <?php echo 'value="'.$wiersz['suma'].'"' ?>>
							</div>
							<select name="option">
								<option value="edytuj">edytuj</option>
								<option value="usun">usuń</option>
							</select>
							<input type="hidden"  name="ID" <?php echo 'value="'.$_GET['ID'].'"' ?> >
							<input type="submit" value="wykonaj" name="wykonaj">
							</form>
							<div class="group_panel">
							<?php
								echo "<br><br><br>";
								$query_two = $sql->prepare('SELECT * FROM zamowienia_szczegolowe WHERE ID_zamowienia = :zmienna_dane');		
								$query_two->bindParam(':zmienna_dane', $wiersz['ID'], PDO::PARAM_STR);
								$query_two->execute();
						
								echo "<span> Produkty tego zamowienia: </span>";
								echo "<br><br>";
								foreach($query_two as $wiersz_z_s)
								{
									$query_three = $sql->prepare('SELECT * FROM produkty WHERE ID= :zmienna_dane');		
									$query_three->bindParam(':zmienna_dane', $wiersz_z_s['ID_produktu'], PDO::PARAM_STR);
									$query_three->execute();
									$wiersz_product = $query_three->fetch(PDO::FETCH_ASSOC);

									echo "<li><a href='panel_admin_produkty_zamowien_edycja.php?ID=".$wiersz_z_s['ID']."'>" .$wiersz_product['nazwa']."</a></li><br>";
								}
							?>
							</div>
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
