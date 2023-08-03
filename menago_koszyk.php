<?php
	session_start();
	$sql = new PDO('mysql:host=localhost;dbname=sklep2', "root", "");
	
	if($_SESSION['koszyk']!="")
	{
		$dlugosc=count($_SESSION['koszyk']);
	}

	if (isset($_POST['option'])) 
	{
		if($_POST['option']=="dodaj")
		{
			if($_SESSION['koszyk']!="")
			{
				for ($i=0; $i<count($_SESSION['koszyk']); $i++)
				{
					if($_SESSION['koszyk'][$i][0]==$_POST['ID_produktu'])
					{
						$zmienna=$_SESSION['koszyk'][$i][1];
						$zmienna=$zmienna+1;
						$_SESSION['koszyk'][$i][1]=$zmienna;
						$_czy_znaleziono="tak";
					}
				}
			}
			if(!(isset($_czy_znaleziono)))
			{
				array_push($_SESSION['koszyk'], array($_POST['ID_produktu'], 1));
			}
			$host  = $_SERVER['HTTP_HOST'];
			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			$extra = 'koszyk.php';
			header("Location: http://$host$uri/$extra");
			exit();

		}
		if($_POST['option']=="odswiez/kup")
		{
			if( $_POST['akcja']=="popraw ceny")
			{
			$query = $sql->prepare('SELECT * FROM produkty ORDER BY ID DESC LIMIT 1');
			$query->execute();
			$wiersz = $query->fetch(PDO::FETCH_ASSOC);
			$max=$wiersz['ID'];
			
			for ($i=1; $i<=$max; $i++)
			{
				if(isset($_POST[$i]))
				{	
					$znalezione_ID_produktu=$i;
					for ($j=0; $j<$dlugosc; $j++)
					{
						if($znalezione_ID_produktu==$_SESSION['koszyk'][$j][0])
						{
							$_SESSION['koszyk'][$j][1]=$_POST[$znalezione_ID_produktu];
						}	
					}
				}
			}
			
			$host  = $_SERVER['HTTP_HOST'];
			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			$extra = 'koszyk.php';
			header("Location: http://$host$uri/$extra");

			}
			if( $_POST['akcja']=="kup teraz")
			{
				$nazwa_zamowienia="";
				if($_SESSION['koszyk']!="")
				{
					foreach($_SESSION['koszyk'] as $pozycja)
					{
						$query = $sql->prepare('SELECT * FROM produkty WHERE ID= :zmienna_ID');
						$query->bindParam(':zmienna_ID', $pozycja[0], PDO::PARAM_STR);
						$query->execute();
						$wiersz = $query->fetch(PDO::FETCH_ASSOC);
						$nazwa_zamowienia.=$wiersz['nazwa'].", ";

						if($pozycja[1]>$wiersz['dostepna_ilosc'])
						{
							$_SESSION['info_menago']='<span style="color:blue"> Niestety ale produktu "'.$wiersz["nazwa"].'" mamy tylko "'.$wiersz["dostepna_ilosc"].'" sztuki &nbsp;&nbsp;&nbsp;&nbsp</span><br>';

							$host  = $_SERVER['HTTP_HOST'];
							$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
							$extra = 'koszyk.php';
							header("Location: http://$host$uri/$extra");
							exit();
						}
					
					}
				}
				$query = $sql->prepare('INSERT INTO `zamowienia_ogolne` (`ID`, `ID_klient`, `nazwa`, `data_zakupu`, `suma`) 
				VALUES (NULL, :z_ID_klienta, :z_nazwa, :z_data, :z_suma);');
				$nazwa_test="dwatrey";
				$query->bindParam(':z_ID_klienta', $_SESSION['zalogowany_ID'], PDO::PARAM_INT);
				$query->bindParam(':z_nazwa', $nazwa_zamowienia, PDO::PARAM_STR);
				$date = date('Y-m-d');
				$query->bindParam(':z_data', $date, PDO::PARAM_STR);
				$query->bindParam(':z_suma', $_POST['suma'], PDO::PARAM_INT);
				$query->execute();	
				
				$query = $sql->prepare('SELECT * FROM zamowienia_ogolne ORDER BY ID DESC LIMIT 1');
				$query->execute();
				$wiersz = $query->fetch(PDO::FETCH_ASSOC);
				$id_zamowienia=$wiersz['ID'];

				foreach($_SESSION['koszyk'] as $pozycja)
				{
					$query = $sql->prepare('SELECT * FROM produkty WHERE ID= :zmienna_ID');		
					$query->bindParam(':zmienna_ID', $pozycja[0], PDO::PARAM_INT);
					$query->execute();
					$wiersz_produktu = $query->fetch(PDO::FETCH_ASSOC);
					$count = $query->rowCount();
					$wartosc_dla_pozycji=$pozycja[1]*$wiersz_produktu['cena'];
					$obecna_ilosc=$wiersz_produktu['dostepna_ilosc'];
					$docelowa_ilosc=$obecna_ilosc-$pozycja[1];

					$query_insert = $sql->prepare('INSERT INTO `zamowienia_szczegolowe` (`ID`, `ID_produktu`, `ID_zamowienia`, `ilosc`) 
					VALUES (NULL, :z_id_poduktu, :z_id_zamowienia, :z_ilosc);');
					$query_insert->bindParam(':z_id_poduktu', $pozycja[0], PDO::PARAM_INT);
					$query_insert->bindParam(':z_id_zamowienia', $id_zamowienia, PDO::PARAM_INT);
					$query_insert->bindParam(':z_ilosc', $pozycja[1], PDO::PARAM_INT);
					$query_insert->execute();

					$query_update = $sql->prepare('UPDATE produkty SET dostepna_ilosc= :zmienna_dostepna_ilosc WHERE ID= :zmienna_ID');
					$query_update->bindParam(':zmienna_ID', $pozycja[0] , PDO::PARAM_INT);
					$query_update->bindParam(':zmienna_dostepna_ilosc', $docelowa_ilosc, PDO::PARAM_STR);
					$query_update->execute();
					$_SESSION['info_menago']='<span style="color:blue"> Dziękujemy za zakupy w naszym sklepe! &nbsp;&nbsp;&nbsp;&nbsp</span><br>';
				}

				$_SESSION['koszyk']=array();
			}
		}
	}
	if($_GET['option']=="usun")
		{
			//echo $_GET['id'];
			for ($j=0; $j<$dlugosc; $j++)
			{
				if($_GET['id']==$_SESSION['koszyk'][$j][0])
				{
					unset($_SESSION['koszyk'][$j]);
				}
			}

		}

$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'koszyk.php';
header("Location: http://$host$uri/$extra");