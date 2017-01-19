<?php
$get = addslashes($_GET['strona']);
 
switch($get) {
	
	case 'rejestracja':
		include('includes/rejestracja.php');
	break;	
	
	case 'aktywacja':
		include('includes/aktywacja.php');
	break;	
	
	case 'steam':
		include('includes/steam_login.php');
	break;		
	
	case 'logowanie';
		include('includes/logowanie.php');
	break;
	
	case 'wyloguj';
		include('includes/wyloguj.php');
	break;	
	
	case 're-kod_aktywacyjny';
		include('includes/re-kod_aktywacyjny.php');
	break;
	
	case 'profil';
		include('includes/profil.php');
	break;
	
	case 'avatar';
		include('includes/avatars.php');
	break;
}
?>