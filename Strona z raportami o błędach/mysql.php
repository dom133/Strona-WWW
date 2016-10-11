<?php
	$conn = mysqli_connect ("", "", "") or
	die ("Nie można połączyć się z bazą danych");
	mysqli_select_db ($conn, "") or
	die ("Nie można połączyć się z bazą danych");
?>