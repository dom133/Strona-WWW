<?
$get = addslashes($_GET['strona']);
 
switch($get) {
	case '':
		include('includes/index.php');
	break;	
	
	case 'logowanie':
		include('includes/log.php');
	break;	
	
	case 'wyloguj':
		include('includes/wyloguj.php');
	break;					
}
?>