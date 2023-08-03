<?php
	session_start();
	$sql = new PDO('mysql:host=localhost;dbname=sklep2', "root", "");

	if (isset($_POST['option'])) 
	{
		if ($_POST['option']=="edytuj")
		{
			$query = $sql->prepare('SELECT * FROM klienci WHERE ID= :zmienna_ID');		
			$query->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
			$query->execute();
			$wiersz = $query->fetch(PDO::FETCH_ASSOC);
			
			if ($_POST['login']!=$wiersz['login']) 
			{
				$query_double_login = $sql->prepare('SELECT * FROM klienci WHERE login= :zmienna_login');
				$query_double_login->bindParam(':zmienna_login', $_POST['login'], PDO::PARAM_STR);
				$query_double_login->execute();
				$count = $query_double_login->rowCount();
				if ($count==0 && $_POST['login']!="" ) 
				{
					$query_two = $sql->prepare('UPDATE klienci SET login= :zmienna_login WHERE ID= :zmienna_ID');
					$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
					$query_two->bindParam(':zmienna_login', $_POST['login'], PDO::PARAM_STR);
					$query_two->execute();
				}
				else
				{
					$_SESSION['info_menago'].='<span style="color:red"> Login zajety/nie poprawny. Nie udalo sie zmienic! </span><br>';
				}
			}

			if ($_POST['password']!="") 
			{
				$haslo=$_POST['password'];
				$haslo_hash= hash('sha256', $haslo);

				$query_two = $sql->prepare('UPDATE klienci SET haslo= :zmienna_haslo WHERE ID= :zmienna_ID');
				$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
				$query_two->bindParam(':zmienna_haslo', $haslo_hash, PDO::PARAM_STR);
				$query_two->execute();
			}

			if ($_POST['email']!=$wiersz['email']) 
			{
				$query_double_email = $sql->prepare('SELECT * FROM klienci WHERE email= :zmienna_email');
				$query_double_email->bindParam(':zmienna_email', $_POST['email'], PDO::PARAM_STR);
				$query_double_email->execute();
				$count = $query_double_email->rowCount();
				if ($count==0 && $_POST['email']!="" ) 
				{
					$query_two = $sql->prepare('UPDATE klienci SET email= :zmienna_email WHERE ID= :zmienna_ID');
					$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
					$query_two->bindParam(':zmienna_email', $_POST['email'], PDO::PARAM_STR);
					$query_two->execute();
				}
				else
				{
					$_SESSION['info_menago'].='<span style="color:red"> Email zajety/nie poprawny/pusty. Nie udalo sie zmienic! </span><br>';
				}
			}
			if ($_POST['imie']!=$wiersz['imie']) 
			{
				
				if ($_POST['imie']!="" ) 
				{
					$query_two = $sql->prepare('UPDATE klienci SET imie= :zmienna_imie WHERE ID= :zmienna_ID');
					$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
					$query_two->bindParam(':zmienna_imie', $_POST['imie'], PDO::PARAM_STR);
					$query_two->execute();
				}
				else
				{
					$_SESSION['info_menago'].='<span style="color:red"> Imie nie poprawne/puste. Nie udalo sie zmienic! </span><br>';
				}
			}
			if ($_POST['nazwisko']!=$wiersz['nazwisko']) 
			{
				
				if ($_POST['nazwisko']!="" ) 
				{
					$query_two = $sql->prepare('UPDATE klienci SET nazwisko= :zmienna_nazwisko WHERE ID= :zmienna_ID');
					$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
					$query_two->bindParam(':zmienna_nazwisko', $_POST['nazwisko'], PDO::PARAM_STR);
					$query_two->execute();
				}
				else
				{
					$_SESSION['info_menago'].='<span style="color:red"> Nazwisko nie poprawne/puste. Nie udalo sie zmienic! </span><br>';
				}
			}

			if ($_POST['miejscowosc']!=$wiersz['miejscowosc']) 
			{
				
				if ($_POST['miejscowosc']!="" ) 
				{
					$query_two = $sql->prepare('UPDATE klienci SET miejscowosc= :zmienna_miejscowosc WHERE ID= :zmienna_ID');
					$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
					$query_two->bindParam(':zmienna_miejscowosc', $_POST['miejscowosc'], PDO::PARAM_STR);
					$query_two->execute();
				}
				else
				{
					$_SESSION['info_menago'].='<span style="color:red"> Miejscowosc nie poprawna/pusta. Nie udalo sie zmienic! </span><br>';
				}
			}
			if ($_POST['ulica']!=$wiersz['ulica']) 
			{
				
					$query_two = $sql->prepare('UPDATE klienci SET ulica= :zmienna_ulica WHERE ID= :zmienna_ID');
					$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
					$query_two->bindParam(':zmienna_ulica', $_POST['ulica'], PDO::PARAM_STR);
					$query_two->execute();
				
			}
			if ($_POST['numer_domu']!=$wiersz['numer_domu']) 
			{
				
				if ($_POST['numer_domu']!="" ) 
				{
					$query_two = $sql->prepare('UPDATE klienci SET numer_domu= :zmienna_numer_domu WHERE ID= :zmienna_ID');
					$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
					$query_two->bindParam(':zmienna_numer_domu', $_POST['numer_domu'], PDO::PARAM_STR);
					$query_two->execute();
				}
				else
				{
					$_SESSION['info_menago'].='<span style="color:red"> Numer domu nie poprawna/pusty. Nie udalo sie zmienic! </span><br>';
				}
			}
			if(!isset($_SESSION['info_menago']))
			{
				$_SESSION['info_menago']='<span style="color:blue"> Pomyslnie zmieniono wprowadzone dane! </span><br>';
			}	
		}



		if ($_POST['option']=="usun")
		{
			$query_find_klient = $sql->prepare('SELECT * FROM klienci WHERE ID= :zmienna_id_klient');
			$query_find_klient->bindParam(':zmienna_id_klient', $_POST['ID'], PDO::PARAM_INT);
			$query_find_klient->execute();
			$count = $query_find_klient->rowCount();
			
			if($count==1)
			{
				$id_usuwanego=$_POST['ID'];

				$query_find_zamowienia_ogolne = $sql->prepare('SELECT * FROM zamowienia_ogolne WHERE ID_klient= :zmienna_id');
				$query_find_zamowienia_ogolne->bindParam(':zmienna_id', $id_usuwanego, PDO::PARAM_INT);
				$query_find_zamowienia_ogolne->execute();
				
					foreach($query_find_zamowienia_ogolne as $wiersz_zamowienia_ogolne)
					{

						$id_zamowien_usuwanego=$wiersz_zamowienia_ogolne['ID'];
						$query_find_zamowienia_szczegolowe = $sql->prepare('DELETE FROM zamowienia_szczegolowe WHERE ID_zamowienia = :zmienna_id_zamowienia');
						$query_find_zamowienia_szczegolowe->bindParam(':zmienna_id_zamowienia', $id_zamowien_usuwanego, PDO::PARAM_INT);
						$query_find_zamowienia_szczegolowe->execute();

						$query_find_zamowienia_ogolne = $sql->prepare('DELETE FROM zamowienia_ogolne WHERE ID = :zmienna_id');
						$query_find_zamowienia_ogolne->bindParam(':zmienna_id', $id_zamowien_usuwanego, PDO::PARAM_INT);
						$query_find_zamowienia_ogolne->execute();
					}

				
				$query_two = $sql->prepare('DELETE FROM klienci WHERE ID = :zmienna_ID');
				$query_two->bindParam(':zmienna_ID', $id_usuwanego, PDO::PARAM_INT);
				$query_two->execute();
				
				if($_SESSION['zalogowany_ID']==$id_usuwanego)
				{
					unset($_SESSION['zalogowany_ID']);
				}
				else
				{
					$_SESSION['info_menago']='<span style="color:blue"> Pomyslnie usunieto uzytkownika! </span><br>';
				}
			}
			else
			{
					$_SESSION['info_menago']='<span style="color:red"> Nie udalo sie usunac kliena! Blad! </span><br>';
			}

		}

		if ($_POST['option']=="dodaj")
		{

			if( $_POST['login']!="" && $_POST['password']!="" && $_POST['email']!="" && $_POST['imie']!="" && $_POST['nazwisko']!="" && $_POST['miejscowosc']!="" && $_POST['numer_domu']!="")
			{
				$query_double_login = $sql->prepare('SELECT * FROM klienci WHERE login= :zmienna_login');
				$query_double_login->bindParam(':zmienna_login', $_POST['login'], PDO::PARAM_STR);
				$query_double_login->execute();
				$count = $query_double_login->rowCount();
				if ($count==0) 
				{
					$query_double_email = $sql->prepare('SELECT * FROM klienci WHERE email= :zmienna_email');
					$query_double_email->bindParam(':zmienna_email', $_POST['email'], PDO::PARAM_STR);
					$query_double_email->execute();
					$count_two = $query_double_email->rowCount();
					if ($count_two==0) 
					{
						$haslo=$_POST['password'];
						$haslo_hash= hash('sha256', $haslo);
						$query = $sql->prepare('INSERT INTO `klienci` (`ID`, `login`, `haslo`, `email`, `imie`, `nazwisko`, `miejscowosc`, `ulica`, `numer_domu`)
						VALUES (NULL, :z_login, :z_haslo, :z_email, :z_imie, :z_nazwisko, :z_miejscowosc, :z_ulica, :z_numer_domu);');

						$query->bindParam(':z_login', $_POST['login'], PDO::PARAM_STR);
						$query->bindParam(':z_haslo', $haslo_hash, PDO::PARAM_STR);
						$query->bindParam(':z_email', $_POST['email'], PDO::PARAM_STR);
						$query->bindParam(':z_imie', $_POST['imie'], PDO::PARAM_STR);
						$query->bindParam(':z_nazwisko', $_POST['nazwisko'], PDO::PARAM_STR);
						$query->bindParam(':z_miejscowosc', $_POST['miejscowosc'], PDO::PARAM_STR);
						$query->bindParam(':z_ulica', $_POST['ulica'], PDO::PARAM_STR);
						$query->bindParam(':z_numer_domu', $_POST['numer_domu'], PDO::PARAM_STR);
						
						$query->execute();
						$_SESSION['info_menago']='<span style="color:blue"> pomyslnie zarejestrowano uzytkownika! </span><br>';

						if($_SESSION['zalogowany_ID']==1)
						{
							$host  = $_SERVER['HTTP_HOST'];
							$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
							$extra = 'panel_admin.php';
							header("Location: http://$host$uri/$extra");
							exit();
						}
						else 
						{
							$host  = $_SERVER['HTTP_HOST'];
							$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
							$extra = 'rejestracja.php';
							header("Location: http://$host$uri/$extra");
							exit();
						}
						
					}
					else 
					{
						$_SESSION['info_menago']='<span style="color:red"> email zajety! </span><br>';
					}

				}
				else
				{
					$_SESSION['info_menago']='<span style="color:red"> login zajety! </span><br>';
				}
	
			}
			else 
			{
				$_SESSION['info_menago']='<span style="color:red"> nie wypelniono wszystkich pol! </span><br>';
			}

			if($_SESSION['zalogowany_ID']==1)
			{
				$host  = $_SERVER['HTTP_HOST'];
				$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				$extra = 'panel_admin.php';
				header("Location: http://$host$uri/$extra");
				exit();
			}
			else 
			{
				$host  = $_SERVER['HTTP_HOST'];
				$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				$extra = 'rejestracja.php';
				header("Location: http://$host$uri/$extra");
				exit();
			}

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
