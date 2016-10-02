<?php
	include('/home/skymin/public_html/mysql-polaczenie.php');
	
	
	$data=date("Y-m-d");
	$godzina=date("H:i");
						
	mysqli_query($conn,"INSERT INTO logi (data, godzina, nick, gdzie, co)
	VALUES ('$data', '$godzina', '$nick_logi', '$gdzie_logi', '$co_logi')");
?>