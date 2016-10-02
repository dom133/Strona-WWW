<?php
	define( 'MQ_SERVER_ADDR', '37.187.24.145' ) ; // adres IP Twojego Serwera
	define( 'MQ_SERVER_PORT', 25587 ); // Port rcon który ustawiłeś/aś w pliku serwer.properties
	define( 'MQ_SERVER_PASS', 'MYYVw4c4Hu' ); // hasło które ustawiłeś/aś w pliku serwer.properties
	define( 'MQ_TIMEOUT', 2 );
	
	require 'consola_api.php'; // tutaj ścieżka do wcześniej zdefioniowanego  //pliku dla połączenia się z rcon
	
$strona_on = '
<form action="" method="post">
	<input type="submit" name="napisz_ogloszenie" value="Napisz ogłoszenie" />
	<input type="submit" name="zobacz_ogloszenie" value="Zobacz aktualne ogłoszenia" />
	<input type="submit" name="wroc" value="Wróć" />
</form>';

$strona_off = '
<form action="" method="post">
	<input type="submit" name="lista_zamknij" value=Zamknij listę" />
	<input type="submit" name="wroc_wspolne" value="Wróć" />
</form>';

$formularz = '
<form action="?panel=ogloszenie" method="post">
	<b>Nazwa ogłoszenia:</b> 
	<input type="text" name="tytul" value="Wpisz nazwę"/>
	
	<br />
	
	<b>Tresc ogłoszenia:</b> 
	<input type="text" name="tresc" value="Wpisz treść"/>	
	
	<br />
	
	<b>Gdzie opublikować</b>
	<select name="publikacja">
		<option value="Serwer">Serwer</option>
		<option value="Strona">Strona</option>
	</select>
	
	<br />
	
	<input type="submit" name="dodaj" value="Dodaj" />
	<input type="submit" name="wroc_wspolne" value="Wróć" />
</form>	';	

$session_id = $_COOKIE['session_id'];
$zapytanie = "SELECT * FROM `autoryzacja` WHERE `Session_id` = '$session_id'";
$wynik = mysqli_query($conn,$zapytanie);	
$row = mysqli_fetch_row($wynik);
$login = $row[1];
$poziom = $row[2];

	if(isset($_COOKIE['session_id'])) 
	{	
	  if($poziom>=1) 
	  {	
		
		if(!empty($_POST['wroc']))
		{
			echo '<meta http-equiv="Refresh" content="0; url=index.php?panel=wybor" />';	
		}
		elseif(!empty($_POST['napisz_ogloszenie']))
		{
			echo $formularz;
		}
		elseif(!empty($_POST['dodaj']))
		{	
			$tytul = $_POST['tytul'];
			$tresc = $_POST['tresc'];
			$gdzie = $_POST['publikacja'];
			$data=date("Y-m-d");
			$godzina=date("H:i");
			
			if($_POST['publikacja']=="Serwer")
			{
				mysqli_query($conn,"INSERT INTO ogloszenie (tytul, tresc, kto, gdzie, data, godzina, aktualne)
									VALUES ('$tytul', '$tresc', '$login', '$gdzie', '$data', '$godzina', 'Nie')");
				echo "<pre>";
				
				try
				{
					$Rcon = new MinecraftRcon;
					
					$Rcon->Connect( MQ_SERVER_ADDR, MQ_SERVER_PORT, MQ_SERVER_PASS, MQ_TIMEOUT );
					
					$Data = $Rcon->Command('say Tresc ogloszenia: '.$tresc.' Ogloszeie nadane przez '.$login.'' ); 				
				}
				catch( MinecraftRconException $e )
				{
					echo $e->getMessage( );
				}
				
				$Rcon->Disconnect( );
				echo "</pre>";	
				echo '<b>Ogłoszenie Nadane</b>';
				echo $strona_on;	
			}
			elseif($_POST['publikacja']=="Strona")
			{
				mysqli_query($conn,"INSERT INTO ogloszenie (tytul, tresc, kto, gdzie, data, godzina, aktualne)
									VALUES ('$tytul', '$tresc', '$login', '$gdzie', '$data', '$godzina', 'Tak')");			
				echo '<b>Ogłoszenie Nadane</b>';
				echo $strona_on;	
			}
			
			$nick_logi = $login;
			$gdzie_logi = "Strona ogloszenia";
			$co_logi = "Napiszal ogloszenie o nazwie $tytul na $gdzie";
					
			include('/home/skymin/public_html/panel/includes/logi.php');
		}
		elseif(!empty($_POST['zobacz_ogloszenie']))
		{
			$zapytanie = "SELECT * FROM `ogloszenie`;";
			$wynik = mysqli_query($conn,$zapytanie);
			
			if(mysqli_num_rows($wynik)>=1)
			{
				echo "<p>";
				echo "<table boder=\"1\"><tr>";
				echo "<td><span style=\"font-size: 20px;\"><strong>Tytuł</strong></span></td>";
				echo "<td><span style=\"font-size: 20px;\"><strong>Treść</strong></span></td>";
				echo "<td><span style=\"font-size: 20px;\"><strong>Kto</strong></span></td>";
				echo "<td><span style=\"font-size: 20px;\"><strong>Gdzie</strong></span></td>";
				echo "<td><span style=\"font-size: 20px;\"><strong>Data</strong></span></td>";
				echo "<td><span style=\"font-size: 20px;\"><strong>Godzina</strong></span></td>";	
				echo "<td><span style=\"font-size: 20px;\"><strong>Aktualne</strong></span></td>";				
				echo "</tr>";
											
				while ( $row = mysqli_fetch_row($wynik) ) 
				{
					echo "</tr>";
					echo "<td><span style=\"font-size: 20px;\">" . $row[1] . "</span></td>";
					echo "<td><span style=\"font-size: 20px;\">" . $row[2] . "</span></td>";
					echo "<td><span style=\"font-size: 20px;\">" . $row[3] . "</span></td>";
					echo "<td><span style=\"font-size: 20px;\">" . $row[4] . "</span></td>";
					echo "<td><span style=\"font-size: 20px;\">" . $row[5] . "</span></td>";
					echo "<td><span style=\"font-size: 20px;\">" . $row[6] . "</span></td>";
					echo "<td><span style=\"font-size: 20px;\">" . $row[7] . "</span></td>";
					echo "</tr>";
				}
				echo "</table>";
				echo $strona_off;
			}
			else
			{
				echo '<b>Brak Ogłoszeń</b>';
				echo $strona_off;
			}
		}
		else
		{
			$nick_logi = $login;
			$gdzie_logi = "Strona ogloszenia";
			$co_logi = "Przeglada lub pisze ogloszenie";
					
			include('/home/skymin/public_html/panel/includes/logi.php');
			echo $strona_on;	
		}
		
	  }
		else
	  {
		echo'<h1>Nie jestes administratorem</h1>';
		echo '<meta http-equiv="Refresh" content="2; url=http://skymin.pl/" />';  
	  }
	}
	else
	{
		echo'<h1>Nie jestes zalogowany</h1>';
		echo '<meta http-equiv="Refresh" content="2; url=http://skymin.pl/" />';	
	}
?>