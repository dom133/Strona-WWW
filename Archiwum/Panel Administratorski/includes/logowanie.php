<?php
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

			    if ($_SERVER['HTTP_X_FORWARDED_FOR']) {
   				 $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
				} else {
 					 $ip = $_SERVER['REMOTE_ADDR'];
			    } 
 
$login = addslashes(htmlspecialchars($_POST['login'])); //nadajemy zmiennej login wartosc z POST
$haslo = sha1(addslashes(htmlspecialchars($_POST['haslo']))); //nadajemy zmiennej haslo wartosc z POST
 
if(!empty($_POST['zaloguj'])) { //jesli klikniemy przycisk wykonuje sie skrypt
   if(empty($login)) { //jesli nie wpisalismy loginu
	?>
		<div id="dialog-message" title="Logowanie">
		<p>
		Podaj login</b></p>
		</div>
	<?
	  echo $formularz; 
   }
   elseif(empty($haslo)) { //jesli nie wpisalismy hasla
	?>
		<div id="dialog-message" title="Logowanie">
		<p>
		Podaj haslo</b></p>
		</div>
	<?	
	 echo $formularz; 
   }
   else { //jesli sa wpisane login i haslo
	  $zapytanie = mysqli_query($conn,"SELECT * FROM `authme` WHERE `username` = '$login' AND `password` = '$haslo';"); //zapytujemy baze danych  
	   while ($zapytanie && $rekord = mysqli_fetch_assoc($zapytanie)) { //petla, aby pobrac wyniki
		  $loginzbazy = $rekord['username']; //zapisujemy login z bazy do zmiennej
		  $haslozbazy = $rekord['password']; //zapisujemy haslo z bazy do zmiennej
	   }
	  	  	   
	   if($login != $loginzbazy || $haslo != $haslozbazy) { //jesli login lub/i haslo bedzie inne niz to z bazy
		 echo'<br />';
			?>
				<div id="dialog-message" title="Logowanie">
				<p>
				Nie poprawny login lub/i hasło</b></p>
				</div>
			<?
			echo $formularz;	
	   } elseif($login == $loginzbazy && $haslo == $haslozbazy) { //jesli dane sie zgadzaja			
				$session_id = GenRandom(30);	
				   
				echo '<script type="text/javascript">';
				echo 'document.cookie = "session_id='.$session_id.'; path=/; domain=.skymin.pl";';
				echo 'document.cookie = "akt_komunikat=false; path=/; domain=.skymin.pl";';
				echo 'document.cookie = "email_komunikat=false; path=/; domain=.skymin.pl";';			
				echo '</script>';
				
				mysqli_query($conn,"UPDATE `authme` SET `ip`='$ip' WHERE `username`='$loginzbazy'");
				mysqli_query($conn,"UPDATE `autoryzacja` SET `Zalogowany`='tak' WHERE `User`='$loginzbazy'");
				mysqli_query($conn,"UPDATE `autoryzacja` SET `Session_id`='$session_id' WHERE `User`='$loginzbazy'");
				
				$nick_logi = $loginzbazy;
				$gdzie_logi = "Strona logowania";
				$co_logi = "Wlasnie sie zalogowal";
				
				include('/home/skymin/public_html/panel/includes/logi.php');
				echo'<br />';
				echo '<meta http-equiv="Refresh" content="0; url=index.php?panel=wybor" />'; 					
	   } else { 
	   		echo'<br />';
			?>
				<div id="dialog-message" title="Logowanie">
				<p>
				Wystapil nieoczekiwany blad. Sprobuj ponownie.</b></p>
				</div>
			<?
			echo $formularz;				
	   }
   }
   } else { 
   if(isset($_COOKIE['session_id']))
   {
	echo '<meta http-equiv="Refresh" content="0; url=index.php?panel=wybor" />';    
   }
}
?>
