<?php
	$conn = mysqli_connect ("localhost", "skymin_strona", "Pawelek1") or
	die ("Blad podczas polaczenia z MySQL. Jesli mozesz to poinformuj o tym administracje. Sprobuj takze odswiezyc strone.");
	mysqli_select_db ($conn, "skymin_strona") or
	die ("Blad podczas wybierania bazy. Jesli mozesz to poinformuj o tym administracje. Sprobuj takze odswiezyc strone.");
?>
