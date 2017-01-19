<?php
	define( 'MQ_SERVER_ADDR', 'skymin.maxcraft.pl' ) ; // adres IP Twojego Serwera
	define( 'MQ_SERVER_PORT', 26113 ); // Port rcon który ustawiłeś/aś w pliku serwer.properties
	define( 'MQ_SERVER_PASS', 'Pawel1' ); // hasło które ustawiłeś/aś w pliku serwer.properties
	define( 'MQ_TIMEOUT', 2 );
	
	require 'consola_api.php'; // tutaj ścieżka do wcześniej zdefioniowanego  //pliku dla połączenia się z rcon
	require_once '/home/skymin/public_html/mobile/includes/mcformat.php';
    
	$strona = '
<form action="" method="post">
<table>
	<input type="text"	name="komenda" value="Wpisz komende" />
	<input type="submit" name="wyslij" value="Wyślij" />
	<input type="submit" name="wroc" value="Wróć" />
</table>	
</form>';

	$session_id = $_COOKIE['session_id'];
	$zapytanie = "SELECT * FROM `autoryzacja` WHERE `Session_id` = '$session_id'";
	$wynik = mysqli_query($conn,$zapytanie);	
	$row = mysqli_fetch_row($wynik);
	$login = $row[1];
	$poziom = $row[2];
	
	if(isset($_COOKIE['session_id'])) {	
	
		if($poziom>=1) 
		{
			
		if(!empty($_POST['wroc']))
		{
		echo '<meta http-equiv="Refresh" content="0; url=index.php?panel=serwer" />'; 	
		}
		else
		{
			if(!empty($_POST['wyslij']))
			{
				echo "<pre>";	
				try
			{
				$Rcon = new MinecraftRcon;
				
				$Rcon->Connect( MQ_SERVER_ADDR, MQ_SERVER_PORT, MQ_SERVER_PASS, MQ_TIMEOUT );
				
				$Data = $Rcon->Command($_POST['komenda']); 
				
				if( $Data === true )
				{
					throw new MinecraftRconException( "Failed to get command result." );
					echo $strona;
				}
				else if( StrLen( $Data ) == 0 )
				{
					throw new MinecraftRconException( "Got command result, but it's empty." );
					echo $strona;
				}
				
				echo HTMLSpecialChars( $Data );
				echo $strona;
			}
			catch( MinecraftRconException $e )
			{
				echo $e->getMessage( );
				echo $strona;
				
			}
			
			$Rcon->Disconnect( );
						
			$nick_logi = $login;
			$gdzie_logi = "Strona consoli serwera";
			$co_logi = "Wyslal komende .$komenda.";
			
			include('/home/skymin/public_html/panel/includes/logi.php');
			
			}
			
			else
			{
				echo $strona;
			}
		}
	}		
	else
	{
		echo'<h1>Nie jestes administratorem/moderatorem</h1>';
		echo '<meta http-equiv="Refresh" content="2; url=http://skymin.pl/" />';	
	}
		}
		else
		{
			echo'<h1>Nie jestes zalogowany</h1>';
			echo '<meta http-equiv="Refresh" content="2; url=http://skymin.pl/" />';	
		}
?>