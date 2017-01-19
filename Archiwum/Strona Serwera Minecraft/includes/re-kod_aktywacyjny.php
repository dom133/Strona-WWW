<?php
	$session_id = $_COOKIE['session_id'];
	$zapytanie = "SELECT * FROM `autoryzacja` WHERE `Session_id` = '$session_id'";
	$wynik = mysqli_query($conn,$zapytanie);	
	$row = mysqli_fetch_row($wynik);
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
		$zapytajka_email = mysqli_query($conn,"SELECT * FROM authme WHERE `username` = '$login';");
		$email = mysqli_fetch_row($zapytajka_email);	
		$zapytajka_akt = mysqli_query($conn,"SELECT * FROM autoryzacja WHERE `User` = '$login';");
		$akt = mysqli_fetch_row($zapytajka_akt);
		
		if($akt[3]!="tak")
		{
			$klucz = GenRandom(50);
			
			mysqli_query($conn,"UPDATE `autoryzacja` SET `Klucz_a`='$klucz' WHERE `User`='$login'");				
			
			$tytul = "Kod aktywacyjny do konta SkyMin";
			$wiadomosc = "Witaj $login,
Nowy kod aktywacyjny to  http://www.skymin.pl/index.php?strona=aktywacja&kod=$klucz";	
			mail($email[9], $tytul, $wiadomosc);		
			?>
                <script type="text/javascript">
				show_msg('<p class=ok>Email z kodem aktywacyjnym został wysłany!</p>', '#informacja .msg', '#informacja .msg .ok', 15000);
				</script>
            <?
			include('includes/glowna.php');			
		}
		else
		{
			?>
                <script type="text/javascript">
				show_msg('<p class=ok>Konto jest już aktywne!</p>', '#informacja .msg', '#informacja .msg .ok', 15000);
				</script>
            <?
			include('includes/glowna.php');	
		}	
		
	}
	else
	{
			?>
                <script type="text/javascript">
				show_msg('<p class=ok>Nie jestes zalogowany!</p>', '#informacja .msg', '#informacja .msg .ok', 15000);
				zmien_title("Strona Główna | SkyMin - Strona Serwera Minecraft", "title");
				</script>
            <?
			include('includes/glowna.php');	
	}
?>
