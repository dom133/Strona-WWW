<?php	
	$strona_wyswietlana = '<p style="font-size: xx-large;">Strona w budowie</p>';

	$strona = 'statystyki';
	include('/home/skymin/public_html/includes/aktywator_strony.php');
		
	if($wlaczona==1)
	{
		echo $strona_wyswietlana;
	}
	else
	{
		if($_COOKIE['poziom']>=1)
		{
			echo $strona_wyswietlana;
		}
		else
		{
			echo'<p style="font-size: xx-large;">Strona została wyłączona, wróć póżniej</p>';	
		}
	}
?>