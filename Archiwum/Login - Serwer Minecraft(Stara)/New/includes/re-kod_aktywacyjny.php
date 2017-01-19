<?php
	$session_id = $_COOKIE['session_id'];
	$zapytanie = "SELECT * FROM `autoryzacja` WHERE `Session_id` = '$session_id'";
	$wynik = mysql_query($zapytanie);	
	$row = mysql_fetch_row($wynik);
	$login = $row[1];
	
	function GenRandom($howlong) 
	{ 
	$chars = "abcdefghijklmnoprstuwxyzq"; 
	$chars .= "ABCDEFGHIJKLMNOPRSTUWZYXQ"; 
	$chars .= "1234567890"; 
	$pass = ""; 
	$len = strlen($chars) - 1; 
	for($i =0; $i < $howlong; $i++) 
	  { 
	   $random = rand(0, $len); 
	
		   $output .=  $chars[$random]; 
	   } 
	return $output; 
	}; 
	
	if(isset($_COOKIE['session_id']))
	{
		$zapytajka_email = mysql_query("SELECT * FROM authme WHERE `username` = '$login';");
		$email = mysql_fetch_row($zapytajka_email);	
		$zapytajka_akt = mysql_query("SELECT * FROM autoryzacja WHERE `User` = '$login';");
		$akt = mysql_fetch_row($zapytajka_akt);
		
		if($akt[3]!="tak")
		{
			$klucz = GenRandom(50);
			
			mysql_query("UPDATE `autoryzacja` SET `Klucz_a`='$klucz' WHERE `User`='$login'");				
			
			$tytul = "Kod aktywacyjny do kont SkyMin";
			$wiadomosc = "Witaj $login,
Nowy kod aktywacyjny to  http://www.skymin.xaa.pl/logowanie/index.php?strona=aktywacja&kod=$klucz";	
			mail($email[9], $tytul, $wiadomosc);	
			echo '<p>Email z kodem aktywacyjnym został wysłany</p>';			
		}
		else
		{
			echo '<p>Konto jest już aktywne</p>';
		}	
		
	}
	else
	{
		echo '<p>Nie jesteś zalogowany</p>';
	}
?>
