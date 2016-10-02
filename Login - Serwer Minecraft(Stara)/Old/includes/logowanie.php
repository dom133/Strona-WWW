<?php
$formularz = '
<form action="" method="post">
	<input type="text" name="login" value="login" />
	<input type="password" name="password" value="pass" />
	<input type="submit" name="logowanie" value="Zaloguj" />
</form>
';

			    if ($_SERVER['HTTP_X_FORWARDED_FOR']) {
   				 $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
				} else {
 					 $ip = $_SERVER['REMOTE_ADDR'];
			    } 
 
$login = addslashes(htmlspecialchars($_POST['login'])); //nadajemy zmiennej login wartosc z POST
$haslo = sha1(addslashes(htmlspecialchars($_POST['password']))); //nadajemy zmiennej haslo wartosc z POST
 
if(!empty($_POST['logowanie'])) { //jesli klikniemy przycisk wykonuje sie skrypt
   if(empty($login)) { //jesli nie wpisalismy loginu
	  echo 'Podaj login!'; //echujemy wiadomosc
   }
   elseif(empty($haslo)) { //jesli nie wpisalismy hasla
	  echo 'Podaj haslo!'; //echujemy wiadomosc
   }
   else { //jesli sa wpisane login i haslo
	  $zapytanie = mysql_query("SELECT * FROM `authme` WHERE `username` = '$login' AND `password` = '$haslo';"); //zapytujemy baze danych  
	   while ($zapytanie && $rekord = mysql_fetch_assoc($zapytanie)) { //petla, aby pobrac wyniki
		  $loginzbazy = $rekord['username']; //zapisujemy login z bazy do zmiennej
		  $haslozbazy = $rekord['password']; //zapisujemy haslo z bazy do zmiennej
	   }
	   
	   
	   if($login != $loginzbazy || $haslo != $haslozbazy) { //jesli login lub/i haslo bedzie inne niz to z bazy
		 echo'<br />';
		  echo '<p>Niepoprawny login lub/i haslo!</p>'; //echujemy wiadomosc
		  echo $formularz;
	   } elseif($login == $loginzbazy && $haslo == $haslozbazy) { //jesli dane sie zgadzaja
		    $_SESSION['login'] = $loginzbazy; //zapisujemy login z bazy do sesji
		    $_SESSION['haslo'] = $haslozbazy; //zapisujemy haslo z bazy do sesji
			mysql_query("UPDATE `authme` SET `ip`='$ip' WHERE `username`='$loginzbazy'");
			echo'<br />';
		    echo '<p>Zostales/as poprawnie zalogowany <b>'.$_SESSION['login'].'</b>!</p>'; //echujemy wiadomosc
			        
					$email = "skyminepl@wp.pl";
					$tytul = "Logowanie $loginzbazy";
					$wiadomosc = "$loginzbazy właśnie się zalogował/a ";
					// uzycie funkcji mail
					mail($email, $tytul, $wiadomosc);
					
	   } else { //jesli wystapi nieoczekiwany blad
	   		echo'<br />';
		    echo '<p><b>Wystapil nieoczekiwany blad. Sprobuj ponownie.</b></p>'; //echujemy wiadomosc
			echo $formularz;
	   }
   }
   } else { //jesli nie klikniemy przycisku wyswietlamy formularz
   if(isset($_SESSION['login'])) { //jesli istnieje sesja z loginem
   	echo'<br />';
	  echo '<p>Jestes juz zalogowany jako<b> '.$_SESSION['login'].'</b>!</p>'; //echujemy wiadomosc
   } else { //jesli nie ma sesji z loginem
	  echo $formularz; //wyswietlamy formularz
	}
}
?>