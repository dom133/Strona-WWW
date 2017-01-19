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
	
	$formularz = '
<form action="?login=rejestracja" method="post">
	<b>Login: </b>
	<input type="text" name="login" class="loginbox" placeholder="Login" />
	<br />
	<b>Hasło: </b>
	<input type="password" name="haslo" class="loginbox" placeholdere="Haslo" />
	<br />
	<b>Powtórz hasło: </b>
	<input type="password" name="haslo-p" class="loginbox" placeholder="Powtorz Haslo" />
	<br />
	<b>Email: </b>
	<input type="text" name="email" class="loginbox" placeholder="Email" />
	<br />
	<input type="submit" name="dodaj" class="button" value="Zarejestruj" />
</form>';
	if(!isset($_COOKIE['session_id']))
	{
		if(!empty($_POST['dodaj']))
		{
			$nick = addslashes(htmlspecialchars($_POST['login']));
			$haslo = addslashes(htmlspecialchars($_POST['haslo']));
			$haslo2 = addslashes(htmlspecialchars($_POST['haslo-p']));
			$email = addslashes(htmlspecialchars($_POST['email']));
			
			if($nick=="Login" || empty($nick))
			{
				?>
					<div id="dialog-message" title="Rejestracja">
					<p>
					Podaj login</p>
					</div>
				<?	
				echo $formularz;						
			}
			elseif($haslo=="haslo" || empty($haslo))
			{
				?>
					<div id="dialog-message" title="Rejestracja">
					<p>
					Podaj hasło</p>
					</div>
				<?					
				echo $formularz;	
			}
			elseif($haslo2=="haslo" || empty($haslo2))
			{
				?>
					<div id="dialog-message" title="Rejestracja">
					<p>
					Podaj powtórzone hasło</p>
					</div>
				<?	
				echo $formularz;				
			}
			elseif($haslo!=$haslo2)
			{
				?>
					<div id="dialog-message" title="Rejestracja">
					<p>
					Hasła nie są identyczne</p>
					</div>
				<?	
				echo $formularz;				
			}
			elseif($email=="Email" || empty($email))
			{
				?>
					<div id="dialog-message" title="Rejestracja">
					<p>
					Podaj email</p>
					</div>
				<?	
				echo $formularz;				
			}
			else
			{
				$zapytajka_user = mysql_query("SELECT * FROM authme WHERE `username` = '$nick';");
				if(mysql_num_rows($zapytajka_user)>=1)
				{
					?>
						<div id="dialog-message" title="Rejestracja">
						<p>
						Podany użytkownik już istnieje</p>
						</div>
					<?	
					echo $formularz;			
				}
				else
				{
					$zapytajka_email = mysql_query("SELECT * FROM authme WHERE `email` = '$email';");
					if(mysql_num_rows($zapytajka_email)>=1)
					{
						?>
							<div id="dialog-message" title="Rejestracja">
							<p>
							Podany email został już użyty przez innego użytkownika</p>
							</div>
						<?
						echo $formularz;						
					}
					else
					{	
						echo $formularz;
						echo'<p>Dziękuje za rejestracje, konto zostało utworzone a na email podany przy rejestracji został wysłany klucz aktywacyjny</p>';
						
						$haslo_zakodowane = sha1($haslo);
						$zapytanie = mysql_query("INSERT INTO authme (username, password, email)
						VALUES ('$nick', '$haslo_zakodowane', '$email')");
						
						$klucz = GenRandom(50);
						
						mysql_query("INSERT INTO autoryzacja (user, Poziom, Klucz_a, Aktywne)
						VALUES ('$nick', '0', '$klucz', 'nie')");
							
						$tytul = "Rejestracja na SkyMin";
						$wiadomosc = "Witaj $nick,
Dziekujemy ze sie zarejstrowales/as, aby aktywowac konto wejdz na http://www.skymin.xaa.pl/logowanie/index.php?strona=aktywacja&kod=$klucz";
						// uzycie funkcji mail
						mail($email, $tytul, $wiadomosc);														
				}
			}
		}
	}
	else
	{
		echo $formularz;	
	}
	}
	else
	{
		echo'<p>Posiadasz już konto</p>';	
	}

?>