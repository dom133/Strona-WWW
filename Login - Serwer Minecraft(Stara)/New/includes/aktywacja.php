<?

	$kod = NULL;
	if (array_key_exists('kod', $_GET)) {
		$kod = $_GET['kod'];
	}
	
		$strona = '
		<form name="aktywacja" method="post" action="">
			<br />
			<input type="text" name="kod_name" class="loginbox" value="Podaj kod" />
			<input type="submit" name="kod_submit" class=\"button\" value="Aktywuj Konto" />
			<br />
		</form>';
		
	
	if($kod==NULL)
	{
		if(isset($_POST['kod_submit']))
		{
			echo '<meta http-equiv="Refresh" content="0; url=http://www.skymin.xaa.pl/logowanie/index.php?strona=aktywacja&kod='.$_POST['kod_name'].'" />';	
		}
		else
		{
			echo $strona;	
		}
	}
	else
	{
		$zapytanie = mysql_query("SELECT * FROM `autoryzacja` WHERE `Klucz_a` = '$kod' ");
		if(mysql_num_rows($zapytanie)==0)
		{
			echo'<p>Podany kod jest błędny</p>';	
		}
		else
		{
			$row = mysql_fetch_row($zapytanie);
			$nick = $row[1];
			$zapytanie1 = mysql_query("SELECT * FROM `authme` WHERE `username` = '$nick' ");
			$row1 = mysql_fetch_row($zapytanie1);
			$aktywne = $row[4]; 
			if($aktywne=="tak")
			{
				echo'<p>Konto jest już aktywne</p>';	
			}
			else
			{
				mysql_query("UPDATE `autoryzacja` SET `Aktywne`='tak' WHERE `Klucz_a`='$kod'");	
				
				$tytul = "Aktywacja konta na SkyMin";
				$wiadomosc = "Witaj $nick,
Konto zostalo aktywowane i mozesz sie zalogowac";
				// uzycie funkcji mail
				mail($row1[9], $tytul, $wiadomosc);	
							
				echo'<p>Konto zostało aktywowane, możesz się zalogować</p>';
			}
		}
	}
?>