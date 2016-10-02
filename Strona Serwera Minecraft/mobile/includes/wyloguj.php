<?php
if(isset($_COOKIE['session_id'])) {
	echo'<br />';
	
	$session_id = $_COOKIE['session_id'];
	$zapytanie = "SELECT * FROM `autoryzacja` WHERE `Session_id` = '$session_id'";
	$wynik = mysqli_query($conn,$zapytanie);	
	$row = mysqli_fetch_row($wynik);
	$login = $row[1];
										
	echo '<script type="text/javascript">';
?>
	function del_cookie(name) {
    document.cookie = name +
    '=; expires=Thu, 01-Jan-70 00:00:01 GMT; path=/; domain=.skymin.pl;';
    }	
    del_cookie("session_id");   
    del_cookie("poziom");
    del_cookie("akt_komunikat");
    del_cookie("email_komunikat");
<?php
	echo '</script>';
	
	echo '<meta http-equiv="Refresh" content="0; url=index.php" />';
}
else
{
	echo'<br />';	
	echo'Jestes juz wylogowany/a';
}

?>