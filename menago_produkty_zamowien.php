<?php
	session_start();
	$sql = new PDO('mysql:host=localhost;dbname=sklep2', "root", "");

	if (isset($_POST['option'])) 
	{
		if ($_POST['option']=="edytuj")
		{
			$query = $sql->prepare('SELECT * FROM zamowienia_szczegolowe WHERE ID= :zmienna_ID');		
			$query->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
			$query->execute();
			$wiersz = $query->fetch(PDO::FETCH_ASSOC);
			if ($_POST['ID_produktu']!=$wiersz['ID_produktu']) 
			{
				$query_two = $sql->prepare('UPDATE zamowienia_szczegolowe SET ID_produktu= :zmienna_ID_produktu WHERE ID= :zmienna_ID');
				$query_two->bindParam(':zmienna_ID_produktu', $_POST['ID_produktu'], PDO::PARAM_INT);
				$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
				$query_two->execute();
			}

			if ($_POST['ID_zamowienia']!=$wiersz['ID_zamowienia']) 
			{
				$query_two = $sql->prepare('UPDATE zamowienia_szczegolowe SET ID_zamowienia= :zmienna_ID_zamowienia WHERE ID= :zmienna_ID');
				$query_two->bindParam(':zmienna_ID_zamowienia', $_POST['ID_zamowienia'], PDO::PARAM_INT);
				$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
				$query_two->execute();
			}

			if($_POST['ilosc']!="")
			{
				if ($_POST['ilosc']!=$wiersz['ilosc']) 
				{
					$query_two = $sql->prepare('UPDATE zamowienia_szczegolowe SET ilosc= :zmienna_ilosc WHERE ID= :zmienna_ID');
					$query_two->bindParam(':zmienna_ilosc', $_POST['ilosc'], PDO::PARAM_INT);
					$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
					$query_two->execute();
				}
			}
			else
			{
				$_SESSION['info_menago'].='<span style="color:red"> Nie podano ilosci! </span><br>';
			}
			if($_POST['wartosc_dla_pozycji']!="")
			{
				if ($_POST['wartosc_dla_pozycji']!=$wiersz['wartosc_dla_pozycji']) 
				{
					$query_two = $sql->prepare('UPDATE zamowienia_szczegolowe SET wartosc_dla_pozycji= :zmienna_wartosc_dla_pozycji WHERE ID= :zmienna_ID');
					$query_two->bindParam(':zmienna_wartosc_dla_pozycji', $_POST['wartosc_dla_pozycji'], PDO::PARAM_INT);
					$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
					$query_two->execute();
				}
			}
			else
			{
				$_SESSION['info_menago'].='<span style="color:red"> Nie podano wartosci! </span><br>';
			}

			if(!isset($_SESSION['info_menago']))
			{
				$_SESSION['info_menago']='<span style="color:blue"> Pomyslnie zmieniono wprowadzone dane! </span><br>';
			}	



		}	


		if ($_POST['option']=="usun")
		{
			
				$query_two = $sql->prepare('DELETE FROM zamowienia_szczegolowe WHERE ID = :zmienna_ID');
				$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
				$query_two->execute();
				
				
				$_SESSION['info_menago']='<span style="color:blue"> Pomyslnie usunieto uzytkownika! </span><br>';
				

		}

		if ($_POST['option']=="dodaj")
		{

			if( $_POST['ilosc']!="" && $_POST['ilosc']>0)
			{
				$query = $sql->prepare('INSERT INTO `zamowienia_szczegolowe` (`ID`, `ID_produktu`, `ID_zamowienia`, `ilosc`, `wartosc_dla_pozycji`)
				VALUES (NULL, :z_ID_produktu, :z_ID_zamowienia, :z_ilosc, :z_wartosc_dla_pozycji);');
				$query->bindParam(':z_ID_produktu', $_POST['ID_produktu'], PDO::PARAM_INT);
				$query->bindParam(':z_ID_zamowienia', $_POST['ID_zamowienia'], PDO::PARAM_INT);
				$query->bindParam(':z_ilosc', $_POST['ilosc'], PDO::PARAM_INT);
				if($_POST['wartosc_dla_pozycji']!="")
					{
					$cena_koncowa=$_POST['wartosc_dla_pozycji']*$_POST['ilosc'];
					$query->bindParam(':z_wartosc_dla_pozycji', $cena_koncowa, PDO::PARAM_STR);
					}
					else 
					{
						$query_two = $sql->prepare('SELECT * FROM produkty WHERE ID= :zmienna_ID');
						$query_two->bindParam(':zmienna_ID', $_POST['ID_produktu'], PDO::PARAM_INT);
						$query_two->execute();
						$wiersz = $query_two->fetch(PDO::FETCH_ASSOC);
						
						$cena_koncowa=$wiersz['cena']*$_POST['ilosc'];
						$query->bindParam(':z_wartosc_dla_pozycji',$cena_koncowa, PDO::PARAM_STR);
					}
					
				$query->execute();	
				$_SESSION['info_menago']='<span style="color:blue"> pomyslnie dodano do bazy danych! </span><br>';

						
			}
			else 
			{
				$_SESSION['info_menago']='<span style="color:red"> nie wypelniono wszystkich potzebnych pol pol! </span><br>';
			}
			$host  = $_SERVER['HTTP_HOST'];
			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			$extra = 'panel_admin.php';
			header("Location: http://$host$uri/$extra");
			exit();


		}
	
	}
	else 
{
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'strona_glowna.php';
		header("Location: http://$host$uri/$extra");
		exit();
	}
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'panel_admin.php';
	header("Location: http://$host$uri/$extra");
?>
