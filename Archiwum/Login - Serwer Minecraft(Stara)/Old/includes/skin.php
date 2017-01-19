<?php
$strona = ' 
<form action="" method="post">
	<input type="submit" name="skin" value="Pobierz Skin" />
</form>';

if(isset($_SESSION['login'])) {
	echo'<center>';
	
	$login = $_SESSION['login'];
	
	if(empty($_POST['skin']))
	{
		echo '<br />';
		echo '<img src="https://s3.amazonaws.com/MinecraftSkins/'.$login.'.png" alt="Brak Skinu" width="150" height="100" />';
		echo $strona;
	}
	else
	{
		echo '<meta http-equiv="Refresh" content="0; url=https://minotar.net/download/'.$login.'" />'; 
		echo '<br />';
		echo '<img src="https://s3.amazonaws.com/MinecraftSkins/'.$login.'.png" alt="Brak Skinu" width="150" height="100" />';
		echo $strona;
		
	}
	echo'</center>';
} else {
	echo'<br />';
	echo'<p><b>Nie jesteś zalogowany</b></p>';
}
?>