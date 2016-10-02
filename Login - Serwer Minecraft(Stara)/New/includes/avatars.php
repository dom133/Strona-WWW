<?
$strona = "
<form action=\"?strona=avatar\" method=\"POST\" ENCTYPE=\"multipart/form-data\">
	<p style=\"font-size:15px;\"><b>Maksymalny rozmiar avatara to 1mb, dozwolone formaty to jpg i png.</b></p>
    <input type=\"file\" name=\"plik\"/><br/>
    <input type=\"submit\" name=\"wyslij\" class=\"button\" value=\"Wyślij plik\"/>
    <input type=\"submit\" name=\"wroc\" class=\"button\" value=\"Wróć\"/>
</form>";

$session_id = $_COOKIE['session_id'];
$zapytanie = "SELECT * FROM `autoryzacja` WHERE `Session_id` = '$session_id'";
$wynik = mysql_query($zapytanie);	
$row = mysql_fetch_row($wynik);
$login = $row[1];
if(isset($_COOKIE['session_id']))
{
	if(isset($_POST['wyslij']))
	{
		$max_rozmiar = 1024*1024;
		if (is_uploaded_file($_FILES['plik']['tmp_name'])) {
			if ($_FILES['plik']['size'] > $max_rozmiar) {
				echo $strona;
				?>
					<div id="dialog-message" title="Logowanie">
					<p style="font-size:15px;">
					Błąd! Plik jest za duży!</b></p>
					</div>
				<?				
			} elseif($_FILES['plik']['type']=="image/jpeg" | $_FILES['plik']['type']=="image/png") {
				echo $strona;
				?>
					<div id="dialog-message" title="Logowanie">
					<p style="font-size:15px;">
					Poprawnie zmieniono avatara</b></p>
					</div>
				<?	
				move_uploaded_file($_FILES['plik']['tmp_name'],
						$_SERVER['DOCUMENT_ROOT'].'/logowanie/avatars/'.$login.".jpg");
				$avatar = "http://www.skymin.pl/logowanie/avatars/".$login.".jpg";
				mysql_query("UPDATE `autoryzacja` SET `avatar`='$avatar' WHERE `User`='$login'");		
				
			} else {
				echo $strona;
				?>
					<div id="dialog-message" title="Logowanie">
					<p style="font-size:15px;">
					Błąd! Plik jest złego formatu</b></p>
					</div>
				<?	
			}
		} else {
		   	echo $strona;
			?>
			<div id="dialog-message" title="Logowanie">
			<p style="font-size:15px;">
			Błąd przy przesyłaniu avatara!</b></p>
			</div>
			<?
		}
	}
	elseif($_POST['wroc'])
	{
		echo '<meta http-equiv="Refresh" content="0; url=index.php?strona=profil" />'; 
	}
	else
	{
		echo $strona;	
	}
}
else
{
	echo '<center>';
	echo '<p style="font-size:25px;">Nie jesteś zalogowany</p>';	
	echo '</center>';
}

?>