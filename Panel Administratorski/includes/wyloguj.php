<?php
if(isset($_COOKIE['session_id'])) {
	echo'<br />';
	
	$session_id = $_COOKIE['session_id'];
	$zapytanie = "SELECT * FROM `autoryzacja` WHERE `Session_id` = '$session_id'";
	$wynik = mysqli_query($conn,$zapytanie);	
	$row = mysqli_fetch_row($wynik);
	$login = $row[1];
		
	echo'<p>Wylogowanie przebieglo pomyslnie <span><b>'.$login.'</b></span></p>';
	
	$nick_logi = $login;
	$gdzie_logi = "Strona wylogowania";
	$co_logi = "Wlasnie sie wylogowal";
				
	include('/home/skymin/public_html/panel/includes/logi.php');
							
	echo '<script type="text/javascript">';
?>
	function del_cookie(name) {
    document.cookie = name +
    '=; expires=Thu, 01-Jan-70 00:00:01 GMT; path=/; domain=.skymin.pl;';
    }	
    del_cookie("session_id");   
    del_cookie("akt_komunikat");
    del_cookie("email_komunikat");
<?php
	echo '</script>';
	
	echo '<meta http-equiv="Refresh" content="2; url=http://skymin.pl/" />';
} else {
	echo'<br />';	
	echo'Jestes juz wylogowany/a';
	echo '<meta http-equiv="Refresh" content="2; url=http://skymin.pl/" />';
}
?>