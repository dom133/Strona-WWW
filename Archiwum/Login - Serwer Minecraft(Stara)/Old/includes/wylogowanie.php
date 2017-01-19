<?php
if(isset($_SESSION['login'])) {
	echo'<br />';
	echo'<p>Wylogowanie przebieglo pomyslnie <span><b>'.$_SESSION['login'].'</b></span></p>';
	session_destroy();
} else {
	echo'<br />';	
	echo'<p><b>Jestes juz wylogowany/a</b></p>';
}
?>