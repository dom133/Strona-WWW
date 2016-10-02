<?php

$formularz = '	
<form action="?login=edycja_danych" method="post">
  <table>	
 	<td width="120">
			Haslo: 
				</td>
		<td>
			<input type="password" name="haslo" maxlength="29"   />
		</td>
	</tr>		
	<tr>
		<td>
			<input type="submit" name="edycja" value="Edytuj Dane" />
		</td>
	</tr>    
	
	</table>
	</form>	
';

if(isset($_SESSION['login'])) {
	if(isset($_POST['edycja'])) {
		$haslo1 = addslashes(htmlspecialchars($_POST['haslo']));
			if(empty($haslo1)) {
				echo'<br />';
				echo'<p><b>Pole hasło jest puste</b></p>';
				echo $formularz;
			} else {
				$login = addslashes($_SESSION['login']);
				$haslo = sha1($haslo1);				
				mysql_query("UPDATE `authme` SET `password`='$haslo' WHERE `username`='$login'");
				echo'<br />';
				session_destroy();	
				echo'<p><b>Dane zostaly zmodyfikowane pomyslnie, zaloguj się ponownie!</b></p>';
			}
		
	} else {
        echo $formularz;
	}
	  
 } else {
	echo'<br />';	 
	echo'<p><b>Nie Jesteś Zalogowany</b></p>';
 }
?>