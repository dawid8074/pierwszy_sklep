<?php
	session_start();
	$sql = new PDO('mysql:host=localhost;dbname=sklep2', "root", "");

	if (isset($_POST['option'])) 
	{
		if ($_POST['option']=="edytuj")
		{
			$query = $sql->prepare('SELECT * FROM zamowienia_ogolne WHERE ID= :zmienna_ID');		
			$query->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
			$query->execute();
			$wiersz = $query->fetch(PDO::FETCH_ASSOC);
			echo $_POST['ID'];
			echo $_POST['nazwa'];
			echo $wiersz['ID_klient'];
			if ($_POST['ID_klient']!=$wiersz['ID_klient']) 
			{
				$query_two = $sql->prepare('UPDATE zamowienia_ogolne SET ID_klient= :zmienna_ID_klient WHERE ID= :zmienna_ID');
				$query_two->bindParam(':zmienna_ID_klient', $_POST['ID_produktu'], PDO::PARAM_INT);
				$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
				$query_two->execute();
			}

			if($_POST['nazwa']!="")
			{
				if ($_POST['nazwa']!=$wiersz['nazwa']) 
				{
					$query_two = $sql->prepare('UPDATE zamowienia_ogolne SET nazwa= :zmienna_nazwa WHERE ID= :zmienna_ID');
					$query_two->bindParam(':zmienna_nazwa', $_POST['nazwa'], PDO::PARAM_STR);
					$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
					$query_two->execute();
				}
				
			}
			else
			{
				$_SESSION['info_menago'].='<span style="color:red"> Nie podano nazwy zamowienia! </span><br>';
			}

			if($_POST['data']!="")
			{
				if ($_POST['data']!=$wiersz['data_zakupu']) 
				{
					$query_two = $sql->prepare('UPDATE zamowienia_ogolne SET data_zakupu= :zmienna_data_zakupu WHERE ID= :zmienna_ID');
					$query_two->bindParam(':zmienna_data_zakupu', $_POST['data'], PDO::PARAM_STR);
					$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
					$query_two->execute();
				}
			}
			else
			{
				$_SESSION['info_menago'].='<span style="color:red"> Nie podano daty zamowienia! </span><br>';
			}

			if($_POST['suma']!="")
			{
				if ($_POST['suma']!=$wiersz['suma']) 
				{
					$query_two = $sql->prepare('UPDATE zamowienia_ogolne SET suma= :zmienna_suma WHERE ID= :zmienna_ID');
					$query_two->bindParam(':zmienna_suma', $_POST['suma'], PDO::PARAM_STR);
					$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
					$query_two->execute();
				}
			}
			else
			{
				$_SESSION['info_menago'].='<span style="color:red"> Nie podano daty zamowienia! </span><br>';
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
			
			if( $_POST['nazwa']!="" && $_POST['data']!="" && $_POST['suma']!="" )
			{
				$query = $sql->prepare('INSERT INTO `zamowienia_ogolne` (`ID`, `ID_klient`, `nazwa`, `data_zakupu`, `suma`)
				VALUES (NULL, :z_ID_klienta, :z_nazwa, :z_data_zakupu, :z_suma);');
				$query->bindParam(':z_ID_klienta', $_POST['ID_klienta'], PDO::PARAM_INT);
				$query->bindParam(':z_nazwa', $_POST['nazwa'], PDO::PARAM_STR);
				$query->bindParam(':z_data_zakupu', $_POST['data'], PDO::PARAM_STR);
				$query->bindParam(':z_suma', $_POST['suma'], PDO::PARAM_STR);
				
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
