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
<form action="?strona=rejestracja" method="post">
	<b>Login: </b>
	<input type="text" name="login" class="loginbox" style="margin-top:5px;" placeholder="Login" />
	<br />
	<b>Hasło: </b>
	<input type="password" name="haslo" class="loginbox" style="margin-top:5px;" placeholdere="Haslo" />
	<br />
	<b>Powtórz hasło: </b>
	<input type="password" name="haslo-p" class="loginbox" style="margin-top:5px;" placeholder="Powtorz Haslo" />
	<br />
	<b>Email: </b>
	<input type="text" name="email" class="loginbox" style="margin-top:5px;" placeholder="Email" />
	<br />
	<b>Powtorz email: </b>
	<input type="text" name="email-p" class="loginbox" style="margin-top:5px;" placeholder="Powtorz email" />
	<br />
	<input type="submit" name="dodaj" class="button" style="margin-top:5px;" value="Zarejestruj" />
</form>';
	if(!isset($_COOKIE['session_id']))
	{
		if(!empty($_POST['dodaj']))
		{
			$nick = addslashes(htmlspecialchars($_POST['login']));
			$haslo = addslashes(htmlspecialchars($_POST['haslo']));
			$haslo2 = addslashes(htmlspecialchars($_POST['haslo-p']));
			$email = addslashes(htmlspecialchars($_POST['email']));
			$email2 = addslashes(htmlspecialchars($_POST['email-p']));
			
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
					Nie powtórzyłeś hasła!</p>
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
			elseif($email2=="email" | empty($email2))
			{
				?>
					<div id="dialog-message" title="Rejestracja">
					<p>
					Nie powtórzyłeś adresu email</p>
					</div>
				<?	
				echo $formularz;					
			}
			elseif($email!=$email2)
			{
				?>
					<div id="dialog-message" title="Rejestracja">
					<p>
					Adresy email nie są identyczne</p>
					</div>
				<?	
				echo $formularz;					
			}
			else
			{
				$zapytajka_user = mysqli_query($conn,"SELECT * FROM authme WHERE `username` = '$nick';");
				if(mysqli_num_rows($zapytajka_user)>=1)
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
					$zapytajka_email = mysqli_query($conn,"SELECT * FROM authme WHERE `email` = '$email';");
					if(mysqli_num_rows($zapytajka_email)>=1)
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
						?>
                        <div id="informacja">
                   			 <div class="msg">
                         		<script type="text/javascript">
                       				 show_msg('<p class=ok>Dziękuje za rejestracje, konto zostało utworzone, a na email podany przy rejestracji został wysłany link aktywacyjny</p>', '#informacja .msg', '#informacja .msg .ok', 15000);
								</script>
                             </div>>
                        </div>
                        <?
						$haslo_zakodowane = sha1($haslo);
						$zapytanie = mysqli_query($conn,"INSERT INTO authme (username, password, email)
						VALUES ('$nick', '$haslo_zakodowane', '$email')");
						
						$klucz = GenRandom(50);
						
						mysqli_query($conn,"INSERT INTO autoryzacja (user, Poziom, Klucz_a, Aktywne)
						VALUES ('$nick', '0', '$klucz', 'nie')");
							
						$tytul = "Rejestracja na SkyMin";
						$wiadomosc = "Witaj $nick,
Dziekujemy ze sie zarejstrowales/as, aby aktywowac konto wejdz na http://www.skymin.pl/index.php?strona=aktywacja&kod=$klucz";
						// uzycie funkcji mail
						mail($email, $tytul, $wiadomosc);		
						include('includes/glowna.php');	
						?>
						<script type="text/javascript">
							zmien_title("Strona Główna | SkyMin - Strona Serwera Minecraft", "title");
						</script>
						<?																		
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
	?>
                    <div id="informacja">
                   			 <div class="msg">
                         		<script type="text/javascript">
                       				 show_msg('<p class=ok>Posiadasz już konto!</p>', '#informacja .msg', '#informacja .msg .ok', 15000);
								</script>
                             </div>>
                        </div>
                        <?
		?>
		<script type="text/javascript">
			zmien_title("Strona Główna | SkyMin - Strona Serwera Minecraft", "title");
		</script>
		<?
		include('includes/glowna.php');	
	}

?>