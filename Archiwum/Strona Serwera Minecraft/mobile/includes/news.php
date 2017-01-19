<?php
	$zapytanie = mysqli_query($conn,"SELECT * FROM `news`");   
		
		if(mysqli_num_rows($zapytanie)>=1)	
			{		
				while ( $row = mysqli_fetch_row($zapytanie) ) {
					echo'<p>'.$row[1].'</p>';
					echo'<p>Autor: '.$row[3].'</p>';
					echo'<p>Data Publikacji: '.$row[4].' '.$row[5].'</p>';
					echo'<b><p>'.$row[2].' <a target="_parent"  href="?id='.$row[0].'#news"><button id="1">Komentarze</button></a></p></b>';
					if(mysqli_num_rows($zapytanie)>=2) echo'<br />';
				}
			}
		else
		{
			echo'<h1>Brak nowych newsów</h1>';	
		}
?>