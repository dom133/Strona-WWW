<?php session_start(); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
	<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="UTF-8">
        <link rel="Shortcut icon" href="http://www.skymin.xaa.pl/img/favicon.ico" />
		<title>
			SkyMin - Logowanie/Rejestracja
		</title>
        <body background="http://www.skymin.xaa.pl/img/minecraft.png"></body>
		<link rel="stylesheet" href="strona/style.css" type="text/css" />
	</head>
	<body>
	<div class="head-bar">
		<div class="wrapper">
			<div class="left">
				<ul class="menu">
				<center>
					<li><a href="http://www.skymin.xaa.pl/">Strona Główna</a></li>
                    <li><a href="http://www.skymin.xaa.pl/logowanie">Strona Serwera</a></li>
                    <li><a href="http://www.skymin.xaa.pl/index.php?skymin=launcher">Launcher - Download</a></li>
                    <li><a href="http://www.skymin.xaa.pl/index.php?skymin=forum">Forum</a></li>
                    <li><a href="http://www.skymin.xaa.pl/index.php?skymin=faq">Faq</a></li>
					<li><a href="http://www.skymin.xaa.pl/index.php?skymin=statystyki">Statystyki</a></li>
				</ul>
			</div>
		</div>
	</div>
	<center>     
	<?	
	include('/home/skymin/public_html/mysql-polaczenie.php');
	include('/home/skymin/public_html/includes/aktywator_strony.php');
	
	$_SESSION['strona'] = "logowanie";	
			
	if($_SESSION['logowanie']==1)
	{
		include('strona/top.php');
		include('silnik.php'); 
		include('strona/bottom.php');
	}
	else
	{
		if($_SESSION['poziom']>=1)
		{
			include('strona/top.php');
			include('silnik.php'); 
			include('strona/bottom.php');
		}
		else
		{
		?>
        <style type="text/css">
		p {
			font-size: xx-large;
		}
		
		</style>	
        <?php
			echo'<p>Strona została wyłączona, wróć póżniej</p>';	
		}
	}
		?>		
        </center> 
	</body>
</html>