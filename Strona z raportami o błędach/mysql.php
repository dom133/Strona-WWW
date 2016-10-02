<?php
	$conn = mysqli_connect ("localhost", "strona", "Pawelek1") or
	die ("Nie można połączyć się z bazą danych");
	mysqli_select_db ($conn, "strona") or
	die ("Nie można połączyć się z bazą danych");
?>