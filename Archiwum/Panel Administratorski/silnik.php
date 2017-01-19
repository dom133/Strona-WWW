<?php
$get = addslashes($_GET['panel']);

if(!$poziom>=1)
{
	$tresc = "<p>Strona dostępna tylko dla zalogowanych administratorów/moderatorów</p>";	
}
else
{
	$tresc = '<meta http-equiv="Refresh" content="0; url=index.php?panel=wybor" />';	
}

switch($get) {
	case '':
		echo $tresc;
	break;

	case 'login':
		include('includes/logowanie.php');
	break;	
	
	case 'panel':
		include('includes/panel.php');
	break;	
		
	case 'consola':
		include('includes/consola.php');
	break;
	
	case 'serwer';
		include('includes/serwer.php');
	break;		
	
	case 'wybor':
		include('includes/wybor.php');
	break;	
	
	case 'uzytkownicy':
		include('includes/uzytkownicy.php');
	break;
	
	case 'news';
		include('includes/news.php');
	break;
		
	case 'wyloguj':
		include('includes/wyloguj.php');
	break;	
	
	case 'logi';
		include('includes/lista_logow.php');
	break;	
		
	case 'msg';
		include('includes/msg.php');
	break;
	
	case 'msg_przeczytane';
		include('includes/msg_przeczytane.php');
	break;	
			
	case 'ogloszenie';
		include('includes/ogloszenie.php');
	break;	
			
	case 'steam':
		include('includes/steam_login.php');
	break;					
}
?>