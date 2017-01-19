<?php
	include('/home/skymin/public_html/mysql-polaczenie.php');
		
	$zapytanie = mysqli_query($conn,"SELECT * FROM `strona` WHERE `nazwa_strony` = '$strona';");
	$row = mysqli_fetch_row($zapytanie);
	
	$wlaczona = $row[1];
	   

	
?>