<?php
$get = addslashes($_GET['login']);
 
switch($get) {
	case '':
		include('includes/logowanie.php');
	break;
	
	case 'logowanie':
		include('includes/logowanie.php');
	break;
	
	case 'rejestracja':
		include('includes/rejestracja.php');
	break;
	
	case 'skin':
		include('includes/skin.php');
	break;
	
	case 'edycja_danych':
		include('includes/edycja_danych.php');
	break;
	
	case 'mapa':
		include('includes/mapa.php');
	break;
	
	case 'wylogowanie':
		include('includes/wylogowanie.php');
	break;
}
?>