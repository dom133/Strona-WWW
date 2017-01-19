<?php
if(isset($_SESSION['login'])) {
	echo'<br />';
	echo'<p><b>Posiadasz juz konto</b></p>';
} else {
/*Deklaracja zmiennej $formularz*/
$formularz ='
			<form action="?login=rejestracja" method="post">
				<table>
					<tr>
						<td width="120">
							Nick
						</td>
						<td>
							<input type="text" name="nick" maxlength="30" />
						</td>
					</tr>
					<tr>
						<td>
							Haslo
						</td>
						<td>
							<input type="password" name="haslo" />
						</td>
					</tr>
					<tr>
						<td>
							Powtorz haslo
						</td>
						<td>
							<input type="password" name="haslo2" />
						</td>
					</tr>	
					<tr>
						<td>
							E-mail
						</td>
						<td>
							<input type="text" name="email" maxlength="100" />
						</td>
					</tr>
					
					<tr>
						<td>
							Kliknij
						</td>
						<td>
							<input type="submit" name="rejestracja" value="Rejestruj" />
						</td>
					</tr>
				</table>
			</form>
	';
 
	if(isset($_POST['rejestracja'])) { //Jeœli zosta³ wciœniêty przycisk
		/*Filtracja zmiennych z tablicy $_POST*/
		$nick = addslashes(htmlspecialchars($_POST['nick']));
		$haslo = addslashes(htmlspecialchars($_POST['haslo']));
		$haslo2 = addslashes(htmlspecialchars($_POST['haslo2']));
		$email = addslashes(htmlspecialchars($_POST['email']));
 
		/*Sprawdzanie, czy wszystkie pola zosta³y uzupe³nione i czy s¹ poprawne*/
		if(empty($nick)) {
			echo'<br />';
			echo'<p>Uzupelnij pole <span>nick</span></p>';
		} elseif(strlen($nick) > 50 ) {
			echo'<br />';
			echo'<p>Nick moze skladac sie z maksymalnie 50 znakow</p>';
		} elseif(empty($haslo)) {
			echo'<br />';
			echo'<p>Uzupelnij pole <span>haslo</span></p>';
		} elseif(empty($haslo2)) {
			echo'<br />';
			echo'<p>Powtorz haslo</p>';
		} elseif($haslo != $haslo2) {
			echo'<br />';
			echo'<p>Podane hasla roznia sie</p>';
		} elseif(strlen($email) > 50 ) {
			echo'<br />';
			echo'<p>E-mail moze skladac sis z maksymalnie 50 znakow</p>';			
		} else { //Jeœli wszystkie pola siê zgadzaj¹ zapytujemy bazê danych
			/*Sprawdzanie, czy podany nick istnieje w bazie danych*/
			$zapytajka_user = mysql_query("SELECT * FROM authme WHERE `username` = '$nick';");
			if(mysql_num_rows($zapytajka_user) == 1) {
				echo'<br />';
				echo '<p>Przepraszam, taki login jest juz zajety - prosze wybrac inny nick.</p>';
			} else 
				$zapytajka_email = mysql_query("SELECT * FROM authme WHERE `email` = '$email';");
		     	if(mysql_num_rows($zapytajka_email) == 1) {
					echo'<br />';
		        	echo '<p>Przepraszam, taki <span>e-mail</span> jest juz zajety. Mozliwe, ze posiadasz juz konto w moim serwisie, badz ktos podal Twoj adres.';
				} else {
					echo'<br />';
					echo '<p>Dzieki za rejestracje <span>'.$nick.'</span>, mozesz sie teraz <a href="?login=logowanie">zalogowac</a>.</p>';
					$haslo_zakodowane = sha1($haslo);
			        $zapytanie = mysql_query("INSERT INTO authme (username, password, email)
			        VALUES ('$nick', '$haslo_zakodowane', '$email')");
					
					mysql_query("INSERT INTO autoryzacja (user, Poziom)
			        VALUES ('$nick', '0')");
					
					$tytul = "Rejestracja na SkyMin";
					$wiadomosc = "Witaj $nick,
Dziekujemy ze sie zarejstrowales/as, mozesz sie teraz zalogowac na http://login.skymin.fibercraft.pl/?strona=logowanie";
					// uzycie funkcji mail
					mail($email, $tytul, $wiadomosc);
					
					$email = "skyminepl@wp.pl";
					$tytul = "Rejsetracja $nick";
					$wiadomosc = "$nick wlasnie sie zarejestrowal/a ";
					// uzycie funkcji mail
					mail($email, $tytul, $wiadomosc);
				}
			}
		}
	else { 
		echo $formularz;
	}
}

?>