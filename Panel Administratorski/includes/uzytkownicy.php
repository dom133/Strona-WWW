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
	
$strona = '
<form action="" id="uzytkownicy" method="post">
		<div id="nick_gracza_select">
			<select id="nick_gracza" onchange="dane(this);" name="nick_gracza">
			</select>
			<select name="poziom">
			<option value="0">Ranga: Gracz</option>
			<option value="1">Ranga: Moderator</option>
			<option value="2">Ranga: Administrator</option>
			</select>
			<select name="aktywne">
			<option value="tak">Aktywne: Tak</option>
			<option value="nie">Aktywne: Nie</option>
			</select>		
			<input type="submit" name="dodaj" value="Dodaj" />
			<input type="submit" name="usun" value="Usuń" />
			<input type="submit" name="odswierz" value="Odśwież" />
			<input type="submit" name="wroc" value="Wróć" />
		</div>	
</form>';

$session_id = $_COOKIE['session_id'];
$zapytanie = "SELECT * FROM `autoryzacja` WHERE `Session_id` = '$session_id'";
$wynik = mysqli_query($conn,$zapytanie);	
$row = mysqli_fetch_row($wynik);
$login = $row[1];
$poziom = $row[2];

$zapytanie = "SELECT * FROM `autoryzacja`";
$wynik = mysqli_query($conn,$zapytanie);

	if(isset($_COOKIE['session_id'])) 
	{	
	  if($poziom==2) 
	  {
				  
		echo "<p>";
		echo "<table boder=\"1\"><tr>";
		echo "<td><strong>Gracz</strong></td>";
		echo "<td><strong>Ranga</strong></td>";
		echo "<td><strong>Aktywne</strong></td>";
		echo "</tr>";
					
		while ( $row = mysqli_fetch_row($wynik) ) {
			echo "</tr>";
			echo "<td>" . $row[1] . "</td>";
			$nr = $row[2];
			switch($nr)
			{
				case 0: echo "<td>Gracz</td>"; break;
				case 1: echo "<td>Moderator</td>"; break;
				case 2: echo "<td>Administrator</td>"; break;	
			}
			echo '<td>'.$row[4].'</td>';
			
			echo "</tr>";
		}
		echo "</table>";
	
	
	  if(!empty($_POST['wroc']))
	  {
		echo '<meta http-equiv="Refresh" content="0; url=index.php?panel=wybor" />';	  
	  }
	  else
	  {
		if(!empty($_POST['dodaj']))
		{
			$nick = $_POST['nick_gracza'];	
			$poziom = $_POST['poziom'];
			$aktywne = $_POST['aktywne'];
			
			if($nick == "Nick gracza")
			{
				?>
				<div id="dialog-message" title="Użytkownicy">
				<p>
				 Podaj nick</p>
				 </div>
				 <?	
				 echo $strona;		
			}
			else
			{
				$zapytanie = mysqli_query($conn,"SELECT * FROM `autoryzacja` WHERE `User` = '$nick';"); 
				while ($zapytanie && $rekord = mysqli_fetch_assoc($zapytanie)) { 
					  $userzbazy = $rekord['User']; 
				}
				
					if($userzbazy==$nick)
					{
						mysqli_query($conn,"UPDATE `autoryzacja` SET `Poziom`='$poziom' WHERE `User`='$nick'");	
						mysqli_query($conn,"UPDATE `autoryzacja` SET `Aktywne`='$aktywne' WHERE `User`='$nick'");	
						
						$nick_logi = $login;
						$gdzie_logi = "Strona uzytkownicy";
						$co_logi = "Wlasnie zmienil $nick range na $poziom i aktywne na $aktywne";				
						include('/home/skymin/public_html/panel/includes/logi.php');
						?>
						<div id="dialog-message" title="Użytkownicy">
						<p>
						 Poprawnie zmieniono range użytkownikowi <b><? echo $nick; ?></b></p>
						 </div>
						 <?						 										
						echo $strona;	
					}
					else
					{
						$klucz = GenRandom(50);
						$id = GenRandom(30);
						
						mysqli_query($conn,"INSERT INTO autoryzacja (Session_id, User, Poziom, Klucz_a, Aktywne)
										VALUES ('$id','$nick', '$poziom', '$klucz', '$aktywne')");
										
						$nick_logi = $login;
						$gdzie_logi = "Strona uzytkownicy";
						$co_logi = "Wlasnie dodal $nick range $poziom i aktywne $aktywne";					
						include('/home/skymin/public_html/panel/includes/logi.php');	
						?>
						<div id="dialog-message" title="Użytkownicy">
						<p>
						 Użytkownik dodany</p>
						 </div>
						 <?																			
						echo $strona;
						
				}
			}
													
		}
		else if(!empty($_POST['usun']))
		{
			$nick = $_POST['nick_gracza'];	
			mysqli_query($conn,"DELETE FROM autoryzacja WHERE User='$nick'");	
			$nick_logi = $login;
			$gdzie_logi = "Strona uzytkownicy";
			$co_logi = "Wlasnie usunął $nick ";					
			include('/home/skymin/public_html/panel/includes/logi.php');	
			?>
				<div id="dialog-message" title="Użytkownicy">
				<p>
				Użytkownik o nicku <b><? echo $nick; ?></b> został usunięty</p>
				</div>
			<?																			
			echo $strona;					
		}		
		else
		{	
			echo $strona;
		}
	  }
	  
	  }
	  else
	  {
		echo'<h1>Nie jestes administratorem</h1>'; 
		echo '<meta http-equiv="Refresh" content="2; url=http://skymin.pl/" />'; 
	  }
	}
	else
	{
		echo'<h1>Nie jestes zalogowany</h1>';
		echo '<meta http-equiv="Refresh" content="2; url=http://skymin.pl/" />';	
	}
	 
?>
<script type="text/javascript">
<?
$zapytanie = "SELECT * FROM `autoryzacja`";

$wynik = mysqli_query($conn,$zapytanie);
while ( $row = mysqli_fetch_row($wynik) ) {
	echo 'var thisValue = "'.$row[1].'";';
	echo 'var thisText = "Gracz: '.$row[1].'";';
	echo 'var thisOpt = document.createElement(\'option\');';
	echo 'thisOpt.value = thisValue;';
	echo 'thisOpt.appendChild(document.createTextNode(thisText));';
	echo '$("#nick_gracza").append(thisOpt);';
}

?>
	var thisValue = "Inny";
	var thisText = "Inny gracz";
	var thisOpt = document.createElement('option');
	thisOpt.value = thisValue;
	thisOpt.appendChild(document.createTextNode(thisText));
	$("#nick_gracza").append(thisOpt);

function dane(obj)
{
	if(obj.value == "Inny")
	{
		document.getElementById("nick_gracza_select").innerHTML = "<input type=\"text\" name=\"nick_gracza\" value=\"Nick gracza\" /><select name=\"poziom\"><option value=\"0\">Ranga: Gracz</option><option value=\"1\">Ranga: Moderator</option><option value=\"2\">Ranga: Administrator</option></select><select name=\"aktywne\"><option value=\"tak\">Aktywne: Tak</option><option value=\"nie\">Aktywne: Nie</option></select><input type=\"submit\" name=\"dodaj\" value=\"Dodaj\" /><input type=\"submit\" name=\"usun\" value=\"Usuń\" /><input type=\"submit\" name=\"odswierz\" value=\"Odśwież\" /><input type=\"submit\" name=\"wroc\" value=\"Wróć\" />";
	}
}
	
</script>