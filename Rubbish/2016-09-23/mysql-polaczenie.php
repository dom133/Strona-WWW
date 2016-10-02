<?php
	$conn = mysqli_connect ("192.168.0.100", "skymin_strona", "Dominik1") or
	die ("Blad podczas polaczenia z MySQL. Jesli mozesz to poinformuj o tym administracje. Sprobuj takze odswiezyc strone.");
	mysqli_select_db ($conn, "skymin_strona") or
	die ("Blad podczas wybierania bazy. Jesli mozesz to poinformuj o tym administracje. Sprobuj takze odswiezyc strone.");
?>