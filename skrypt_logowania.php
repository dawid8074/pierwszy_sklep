
<?php	
	session_start();

	if(!(isset($_POST['login']) && isset($_POST['password'])))
	{
		
		if(isset($_GET['wyloguj']))
		{
			unset($_SESSION['zalogowany_ID']);
		}
		header("Location: index.php");
		
	}
	else
	{
		$login=$_POST['login'];
		$haslo=$_POST['password'];
		$haslo_hash= hash('sha256', $haslo);

		$sql = new PDO('mysql:host=localhost;dbname=sklep2', "root", "");

		$query = $sql->prepare('SELECT * FROM klienci WHERE login = :zmienna_login AND haslo= :zmienna_haslo');		
		$query->bindParam(':zmienna_login', $login, PDO::PARAM_STR);					
		$query->bindParam(':zmienna_haslo', $haslo_hash, PDO::PARAM_STR);
		$query->execute();	
		$count = $query->rowCount();
	
		if($count == 1)
		{
			$wiersz = $query->fetch(PDO::FETCH_ASSOC);
			$id_klienta=$wiersz['ID'];

			$_SESSION['zalogowany_ID']=$id_klienta;
			$_SESSION['koszyk']=array();
			header("Location: strona_glowna.php");
		}
		else
		{
			$_SESSION['blad_logowania']='<span style="color:red"> Nie prawdiłowy login lub haslo! </span>';
            header("Location: zaloguj.php");
            exit();
		}
	}


?>
