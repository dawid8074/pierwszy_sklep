<?php

	session_start();
	if(isset($_SESSION['zalogowany_ID']))
	{
		if($_SESSION['zalogowany_ID']!=1)
		{
			header("Location: panel.php");
		}
	}
	else 
	{
		header("Location: strona_glowna.php");
	}

?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<title>panel administratora</title>
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
				</div>
				<?php
						if(isset($_SESSION['info_menago']))
						{
							echo $_SESSION['info_menago'];
							unset($_SESSION['info_menago']);
						}
					?>

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
