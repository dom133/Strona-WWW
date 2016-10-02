<?php		
	$strona = 'glowna';
		
	include('/home/skymin/public_html/includes/aktywator_strony.php'); 
	$zapytanie = mysqli_query($conn,"SELECT * FROM `news`"); 
		
	if($wlaczona==1)
	{
			if(mysqli_num_rows($zapytanie)>=1)	
			{	
					$ile = mysqli_num_rows($zapytanie);
					for($i=$ile; $i>=1; $i--)
					{
						$zapytanie1 = mysqli_query($conn,"SELECT * FROM `news` WHERE `id` = '$i'");
						$row = mysqli_fetch_row($zapytanie1);
						echo '<div class="news_top">';
						echo '<p class="news_txt">'.$row[1].'</p>';
						echo '<div class="news_down">';
						echo '<p class="news_txt_left">Autor: '.$row[3].'</p>';
						echo '<p class="news_txt_right">'.$row[4].' '.$row[5].'</p>';
						echo '</div>';
						echo '<div class="news_tresc">';
						echo '<p class="news_tresc_txt">'.$row[2].'</p>';
						echo '</div>';
						echo '</div>';
						echo'<br />';
					}
			}
	}
	else
	{
		if($_COOKIE['poziom']>=1)
		{ 
			if(mysqli_num_rows($zapytanie)>=1)	
			{	
					$ile = mysqli_num_rows($zapytanie);
					for($i=$ile; $i>=1; $i--)
					{
						$zapytanie1 = mysqli_query($conn,"SELECT * FROM `news` WHERE `id` = '.$i.'");
						$row = mysqli_fetch_row($zapytanie1);
						echo '<div class="news_top">';
						echo '<p class="news_txt">'.$row[1].'</p>';
						echo '<div class="news_down">';
						echo '<p class="news_txt_left">Autor: '.$row[3].'</p>';
						echo '<p class="news_txt_right">'.$row[4].' '.$row[5].'</p>';
						echo '</div>';
						echo '<div class="news_tresc">';
						echo '<p onmousemove="skroc_news(this,1)" class="news_tresc_txt">'.$row[2].'</p>';
						echo '</div>';
						echo '</div>';
						echo'<br />';
					}
			}
		}
		else
		{
			echo'<p style="font-size: xx-large;">Strona została wyłączona, wróć póżniej</p>';	
		}
	}
?>