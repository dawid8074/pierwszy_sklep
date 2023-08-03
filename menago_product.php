<?php
	session_start();
	$sql = new PDO('mysql:host=localhost;dbname=sklep2', "root", "");

	if (isset($_POST['option'])) 
	{
		if ($_POST['option']=="edytuj")
		{
			$query = $sql->prepare('SELECT * FROM produkty WHERE ID= :zmienna_ID');		
			$query->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
			$query->execute();
			$wiersz = $query->fetch(PDO::FETCH_ASSOC);
			
			if ($_POST['nazwa']!=$wiersz['nazwa']) 
			{
				$query_double_nazwa = $sql->prepare('SELECT * FROM produkty WHERE nazwa= :zmienna_nazwa');
				$query_double_nazwa->bindParam(':zmienna_nazwa', $_POST['nazwa'], PDO::PARAM_STR);
				$query_double_nazwa->execute();
				$count = $query_double_nazwa->rowCount();

				if ($count==0 && $_POST['nazwa']!="" ) 
				{
					$query_two = $sql->prepare('UPDATE produkty SET nazwa= :zmienna_nazwa WHERE ID= :zmienna_ID');
					$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
					$query_two->bindParam(':zmienna_nazwa', $_POST['nazwa'], PDO::PARAM_STR);
					$query_two->execute();
					$_SESSION['info_menago']='<span style="color:blue"> pomyslnie zmieniono nazwe produktu! </span><br>';
				}
				else
				{
					$_SESSION['info_menago'].='<span style="color:red"> Nie udalo sie zmienic nazwy produktu! (nie podano nazwy lub istieje taki produkt) </span><br>';
				}
			}
			//print_r($_POST);
			
			if ($_POST['marka']!=$wiersz['marka']) 
			{
				
				if ($_POST['marka']!="" ) 
				{
					$query_two = $sql->prepare('UPDATE produkty SET marka= :zmienna_marka WHERE ID= :zmienna_ID');
					$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
					$query_two->bindParam(':zmienna_marka', $_POST['marka'], PDO::PARAM_STR);
					$query_two->execute();
					$_SESSION['info_menago']='<span style="color:blue"> pomyslnie zmieniono marke produktu! </span><br>';
				}
				else
				{
					$_SESSION['info_menago'].='<span style="color:red"> Nie udalo sie zmienic marki produktu! </span><br>';
				}
			}

			if ($_POST['waga']!=$wiersz['waga']) 
			{
				
				if ($_POST['waga']!="" ) 
				{
					$query_two = $sql->prepare('UPDATE produkty SET waga= :zmienna_waga WHERE ID= :zmienna_ID');
					$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
					$query_two->bindParam(':zmienna_waga', $_POST['waga'], PDO::PARAM_STR);
					$query_two->execute();
					$_SESSION['info_menago'].='<span style="color:blue"> pomyslnie zmieniono wage produktu! </span><br>';
				}
				else
				{		
					$_SESSION['info_menago'].='<span style="color:red"> Nie udalo sie zmienic wagi produktu! </span><br>';
				}
			}
			if ($_POST['cena']!=$wiersz['cena']) 
			{
				
				if ($_POST['cena']!="" ) 
				{
					$query_two = $sql->prepare('UPDATE produkty SET cena= :zmienna_cena WHERE ID= :zmienna_ID');
					$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
					$query_two->bindParam(':zmienna_cena', $_POST['cena'], PDO::PARAM_STR);
					$query_two->execute();
					$_SESSION['info_menago'].='<span style="color:blue"> pomyslnie zmieniono cene produktu! </span><br>';
				}
				else
				{
					$_SESSION['info_menago'].='<span style="color:red"> Nie udalo sie zmienic ceny produktu! </span><br>';
				}
			}
			if (isset($_FILES)) 
			{

				if ($_FILES['zdjecie']['type'] == 'image/jpeg' || $_FILES['zdjecie']['type'] == 'image/png' )
				{
					$lokalizacja = 'photo_product/'.$wiersz['ID'].'.png';
					$tmp_name = $_FILES['zdjecie']['tmp_name'];
					move_uploaded_file($tmp_name, $lokalizacja);
				
					$query_two = $sql->prepare('UPDATE produkty SET zdjecie= :zmienna_zdjecie WHERE ID= :zmienna_ID');
					$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
					$query_two->bindParam(':zmienna_zdjecie', $lokalizacja, PDO::PARAM_STR);
					$query_two->execute();

					$_SESSION['info_menago'].='<span style="color:blue"> pomyslnie zmieniono zdjecie produktu! </span><br>';
				}
				else
				{
					$_SESSION['info_menago'].='<span style="color:black"> Nie zmieniono zdjecia produktu </span><br>';
				}
				
			}

			if ($_POST['opis_szczegolowy']!=$wiersz['opis_szczegolowy']) 
			{
				
				if ($_POST['opis_szczegolowy']!="" ) 
				{
					$query_two = $sql->prepare('UPDATE produkty SET opis_szczegolowy= :zmienna_opis_szczegolowy WHERE ID= :zmienna_ID');
					$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
					$query_two->bindParam(':zmienna_opis_szczegolowy', $_POST['opis_szczegolowy'], PDO::PARAM_STR);
					$query_two->execute();
					$_SESSION['info_menago'].='<span style="color:blue"> pomyslnie zmieniono opis produktu! </span><br>';
				}
				else
				{
					$_SESSION['info_menago'].='<span style="color:red"> Nie udalo sie zmienic opisu produktu! </span><br>';
				}
			}
			if (isset($_POST['promocja'])) 
				$czy_promocja='tak';
			else
				$czy_promocja='nie';
			if($czy_promocja!=$wiersz['promocja'])
			{
				$query_two = $sql->prepare('UPDATE produkty SET promocja= :zmienna_promocja WHERE ID= :zmienna_ID');
				$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
				$query_two->bindParam(':zmienna_promocja', $czy_promocja, PDO::PARAM_STR);
				$query_two->execute();
				$_SESSION['info_menago'].='<span style="color:blue"> pomyslnie zmieniono stan promocji! </span><br>';
			}
			if ($_POST['kategoria']!=$wiersz['kategoria']) 
			{
				
				if ($_POST['kategoria']!="" ) 
				{
					$query_two = $sql->prepare('UPDATE produkty SET kategoria= :zmienna_kategoria WHERE ID= :zmienna_ID');
					$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
					$query_two->bindParam(':zmienna_kategoria', $_POST['kategoria'], PDO::PARAM_STR);
					$query_two->execute();
					$_SESSION['info_menago'].='<span style="color:blue"> pomyslnie zmieniono kategorie produktu! </span><br>';
				}
				else
				{
					$_SESSION['info_menago'].='<span style="color:red"> Nie udalo sie zmienic kategorii produktu! </span><br>';
				}
			}
			if ($_POST['pod_kategoria']!=$wiersz['pod_kategoria']) 
			{
				
				if ($_POST['pod_kategoria']!="" ) 
				{
					$query_two = $sql->prepare('UPDATE produkty SET pod_kategoria= :zmienna_pod_kategoria WHERE ID= :zmienna_ID');
					$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
					$query_two->bindParam(':zmienna_pod_kategoria', $_POST['pod_kategoria'], PDO::PARAM_STR);
					$query_two->execute();
					$_SESSION['info_menago'].='<span style="color:blue"> pomyslnie zmieniono podkategorie produktu! </span><br>';
				}
				else
				{
					$_SESSION['info_menago'].='<span style="color:red"> Nie udalo sie zmienic podkategorio produktu! </span><br>';
				}
			}
			if ($_POST['ilosc']!=$wiersz['dostepna_ilosc']) 
			{
				
				if ($_POST['ilosc']!="" && $_POST['ilosc']>=0) 
				{
					$query_two = $sql->prepare('UPDATE produkty SET dostepna_ilosc= :zmienna_dostepna_ilosc WHERE ID= :zmienna_ID');
					$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
					$query_two->bindParam(':zmienna_dostepna_ilosc', $_POST['ilosc'], PDO::PARAM_STR);
					$query_two->execute();
					$_SESSION['info_menago'].='<span style="color:blue"> pomyslnie zmieniono ilosc produktu! </span><br>';
				}
				else
				{
					$_SESSION['info_menago'].='<span style="color:red"> Nie udalo sie zmienic ilosci produktu! </span><br>';
				}
			}
			
		}

	
		if ($_POST['option']=="usun")
		{
			$query_find_produkt = $sql->prepare('SELECT * FROM produkty WHERE ID= :zmienna_id_klient');
			$query_find_produkt->bindParam(':zmienna_id_klient', $_POST['ID'], PDO::PARAM_INT);
			$query_find_produkt->execute();
			$count = $query_find_produkt->rowCount();
			
			if($count==1)
			{
				
				$query_two = $sql->prepare('DELETE FROM zamowienia_szczegolowe WHERE ID_produktu = :zmienna_ID');
				$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
				$query_two->execute();

				$query_two = $sql->prepare('DELETE FROM produkty WHERE ID = :zmienna_ID');
				$query_two->bindParam(':zmienna_ID', $_POST['ID'], PDO::PARAM_INT);
				$query_two->execute();

				$_SESSION['info_menago'].='<span style="color:blue"> pomyslnie usunieto produkt! </span><br>';
			}
			else
			{
					$_SESSION['info_menago']='<span style="color:red"> Nie udalo sie usunac produktu! Blad! </span><br>';
			}

		}

		if ($_POST['option']=="dodaj")
		{
			$ID_pod_plik=0;

			if( $_POST['nazwa']!="" && $_POST['marka']!="" && $_POST['waga']!="" && $_POST['cena']!="" && $_POST['opis_szczegolowy']!="" && $_POST['kategoria']!="" && $_POST['pod_kategoria']!="" && $_POST['ilosc']!="")
			{
				$query_double_nazwa = $sql->prepare('SELECT * FROM produkty WHERE nazwa= :zmienna_nazwa');
				$query_double_nazwa->bindParam(':zmienna_nazwa', $_POST['nazwa'], PDO::PARAM_STR);
				$query_double_nazwa->execute();
				$count = $query_double_nazwa->rowCount();
				if ($count==0) 
				{
					if ($_FILES['zdjecie']['type'] == 'image/jpeg' || $_FILES['zdjecie']['type'] == 'image/png' )
					{	
						
						$query_pod_zdj = $sql->prepare('SELECT * FROM produkty ORDER BY ID DESC LIMIT 1');
						$query_pod_zdj->execute();
						$wiersz = $query_pod_zdj->fetch(PDO::FETCH_ASSOC);
						$ID_pod_plik=$wiersz['ID'];
						$ID_pod_plik=$ID_pod_plik+1;


						$lokalizacja = 'photo_product/'.$ID_pod_plik.'.png';
						$tmp_name = $_FILES['zdjecie']['tmp_name'];
						//print_r($_FILES);
						move_uploaded_file($tmp_name, $lokalizacja);

						if (isset($_POST['promocja'])) 
							$czy_promocja='tak';
						else
							$czy_promocja='nie';
						//print_r($_POST);

						$query = $sql->prepare('INSERT INTO `produkty` (`ID`, `nazwa`, `marka`, `waga`, `cena`, `zdjecie`, `opis_szczegolowy`, `promocja`, `kategoria`, `pod_kategoria`, `dostepna_ilosc`) 
						VALUES (NULL, :z_nazwa, :z_marka, :z_waga, :z_cena, :z_zdjecie, :z_opis_szczegolowy, :z_promocja, :z_kategoria, :z_pod_kategoria, :z_dostepna_ilosc);');

						$query->bindParam(':z_nazwa', $_POST['nazwa'], PDO::PARAM_STR);
						$query->bindParam(':z_marka', $_POST['marka'], PDO::PARAM_STR);
						$query->bindParam(':z_waga', $_POST['waga'], PDO::PARAM_STR);
						$query->bindParam(':z_cena', $_POST['cena'], PDO::PARAM_STR);
						$query->bindParam(':z_zdjecie', $lokalizacja, PDO::PARAM_STR);
						$query->bindParam(':z_opis_szczegolowy', $_POST['opis_szczegolowy'], PDO::PARAM_STR);
						$query->bindParam(':z_promocja', $czy_promocja, PDO::PARAM_STR);
						$query->bindParam(':z_kategoria', $_POST['kategoria'], PDO::PARAM_STR);
						$query->bindParam(':z_pod_kategoria', $_POST['pod_kategoria'], PDO::PARAM_STR);
						$query->bindParam(':z_dostepna_ilosc', $_POST['ilosc'], PDO::PARAM_STR);
						
						$query->execute();
						$_SESSION['info_menago']='<span style="color:blue"> pomyslnie dodano produkt! </span><br>';
			
						
						

					}
					else
					{
						$_SESSION['info_menago']='<span style="color:red"> nie dodano zdjecia/niopoprawny format pliku! </span><br>';
					}
				
				}
			

				else
				{
					$_SESSION['info_menago'].='<span style="color:red"> podany produkt znajduje sie juz w bazie! </span><br>';
				}
	
			}
			else 
			{
				$_SESSION['info_menago']='<span style="color:red"> nie wypelniono wszystkich pol! </span><br>';
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
