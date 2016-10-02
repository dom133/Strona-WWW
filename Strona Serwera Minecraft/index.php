<? include('includes/mobilna_przekierowywanie.php'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
	<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="/scripts/pace.js"></script>
  		<link href="/style/pace-theme.css" rel="stylesheet" />
        <script src="scripts/scripts.js"></script>  
		<meta charset="UTF-8">
        <link rel="Shortcut icon" href="http://www.skymin.xaa.pl/img/favicon.ico" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
		<div id="title"><title></title></div>
        <script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
		  ga('create', 'UA-49399540-2', 'auto');
		  ga('send', 'pageview');
		
		</script>
    	<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    	<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>   
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>        	
		<script type="text/javascript" src="http://ciasteczka.eu/cookiesEU-latest.min.js"></script>         
        <body background="http://www.skymin.xaa.pl/img/minecraft.png"></body>
		<link rel="stylesheet" href="style/style.css" type="text/css" />  
         
		<script type="text/javascript">	  
			$.noConflict();
			$(function() {
				$( "#dialog-message" ).dialog({
					modal: true,
					buttons: {
						Ok: function() {
							$( this ).dialog( "close" );
						}
					}
				});
			});
					
			jQuery(document).ready(function(){
				jQuery.fn.cookiesEU(
				{
					text: '<p style="font-family:arial; font-size:15px;">Nasza strona internetowa używa plików cookies (tzw. ciasteczka) w celach statystycznych, reklamowych oraz funkcjonalnych. Dzięki nim możemy indywidualnie dostosować stronę do twoich potrzeb. Każdy może zaakceptować pliki cookies albo ma możliwość wyłączenia ich w przeglądarce, dzięki czemu nie będą zbierane żadne informacje. <a href="http://ciasteczka.eu/#jak-wylaczyc-ciasteczka" title="" onclick="window.open(this.href); return false;">Dowiedz się więcej jak je wyłączyć.</a></p>',
				});
			});	
						
			function show_msg(msg, appendto, remove, time) {
				jQuery(msg).appendTo(appendto).fadeIn('slow');
						setTimeout(function() {
							jQuery(remove).fadeOut('slow', function() {
							jQuery(remove).remove();
						}
					);
				}, time);
			}
			
			function readCookie(name) {
				var nameEQ = name + "=";
				var ca = document.cookie.split(';');
				for(var i=0;i < ca.length;i++) {
					var c = ca[i];
					while (c.charAt(0)==' ') c = c.substring(1,c.length);
					if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
				}
				return null;
			}			  							
        </script>                                
	</head>
	<body>
	<div class="head-bar">
		<div class="wrapper">
			<ul class="menu">
                	<li><a href="index.php">Strona Główna</a></li>
                    <li><a href="?strona=launcher">Launcher - Download</a></li>
                    <li><a href="?strona=forum">Forum</a></li>
					<li><a href="?strona=statystyki">Statystyki</a></li>
			</ul>
           <div class="right">
            	<div class="right-menu">
                <?
				include('/home/skymin/public_html/mysql-polaczenie.php');
				$session_id = $_COOKIE['session_id'];
				$zapytanie = "SELECT * FROM `autoryzacja` WHERE `Session_id` = '$session_id'";
				$wynik = mysqli_query($conn, $zapytanie);	
				$row = mysqli_fetch_row($wynik);
				$login = $row[1];
				$poziom = $row[2];
								
                $panel_zal = '<form id="panel-login" method="post" action="?strona=logowanie" class="right-panel">
					<a href="?strona=steam&auth"><img src="http://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_small.png" /></a>
                	<input type="text" name="login" class="loginbox" placeholder="Login"  />
                    <input type="password" name="haslo" class="loginbox" placeholder="Haslo" />
                    <input type="submit" name="zaloguj" class="button" value="Zaloguj" /> 
                    <a href="index.php?strona=rejestracja" class="button">Zarejestruj</a>
                </form>';
				
				$panel_wyl = '
				<form id="panel-action" method="post" action="" class="right-panel">
					<p>Witaj <a href="index.php?strona=profil">'.$login.'</a>
					<a href="index.php?strona=edycja" class="button">Edycja Profilu</a>
					<a href="index.php?strona=wyloguj" class="button">Wyloguj</a></p>
				</form>';
				
				$panel_wyl_admin = '
				<form id="panel-action" method="post" action="" class="right-panel">
					<p>Witaj <a href="index.php?strona=profil">'.$login.'</a>
					<a href="index.php?strona=edycja" class="button">Edycja Profilu</a>
					<a href="http://www.panel.skymin.pl/?panel=wybor" class="button">Panel Administratorski</a>
					<a href="index.php?strona=wyloguj" class="button">Wyloguj</a></p>
				</form>';
				
				if(isset($session_id))
				{
					if($poziom>=1)
					{
						echo $panel_wyl_admin;	
					}
					else
					{
						echo $panel_wyl;	
					}
				}
				else
				{
					echo $panel_zal;	
				}
				?>
				</div>
           </div>
		</div>
	</div> 
    <div id="main">
    	<center>
        <div id="slidebar">
           		<div id="status">
                <? include('includes/status.php'); ?>
                </div>
        </div>
        </center>  
	<center>  
	<?php	

	$strona = 'glowna';		
	include('/home/skymin/public_html/mysql-polaczenie.php');
	include('/home/skymin/public_html/includes/aktywator_strony.php');
	
	$session_id = $_COOKIE['session_id'];
	$zapytanie = "SELECT * FROM `autoryzacja` WHERE `Session_id` = '$session_id'";
	$wynik = mysqli_query($conn,$zapytanie);	
	$row = mysqli_fetch_row($wynik);
	$login = $row[1];
	$akt = $row[4];
	
	$zapytanie = "SELECT * FROM `authme` WHERE `username` = '$login'";
	$wynik = mysqli_query($conn,$zapytanie);	
	$row = mysqli_fetch_row($wynik);	
	$email = $row[9];
	
	if($wlaczona==1)
	{
		if($email=="your@email.com" | $email=="")
		{
		?>
                <div id="informacja">
                    <div class="msg">
                      <script type="text/javascript">
					  	if(readCookie("email_komunikat")=="false")
						{
							show_msg('<p class=ok>Podany email jest błędny, aby móc w pełni aktywować konto wejdz w ustawienia konta i zaktualizuj dane</p>', '#informacja .msg', '#informacja .msg .ok', 15000);
							document.cookie = "email_komunikat=true; path=/; domain=.skymin.pl";
						}
					  </script>
                    </div>
                </div>	
        <?					
		}
		else if($akt=="nie")
		{
		?>
                <div id="informacja">
                    <div class="msg">
                      <script type="text/javascript">
					  	if(readCookie("akt_komunikat")=="false")
						{
							show_msg('<p class=ok>Konto nie zostało aktywowane, jeżeli nie przyszedł email z kodem aktywacyjnym kliknij w <a href="index.php?strona=re-kod_aktywacyjny" style="color:#000000">ten link</a></p>', '#informacja .msg', '#informacja .msg .ok', 15000);
							document.cookie = "akt_komunikat=true; path=/; domain=.skymin.pl";
						}
					  </script>
                    </div>
                </div>	
        <?					
		}		
		include('silnik.php'); 
	}
	else
	{
		if($_COOKIE['poziom']>=1)
		{
			if($email=="your@email.com" | $email=="")
			{
			?>
                <div id="informacja">
                    <div class="msg">
                      <script type="text/javascript">
					  	if(readCookie("email_komunikat")=="false")
						{
							show_msg('<p class=ok>Podany email jest błędny, aby muc w pełni aktywować konto wejdz w ustawienia konta i zaktualizuj dane</p>', '#informacja .msg', '#informacja .msg .ok', 15000);
							document.cookie = "email_komunikat=true; path=/";
						}
					  </script>
                    </div>
                </div>	
            <?					
			}
			else if($akt=="nie")
			{
			?>
                <div id="informacja">
                    <div class="msg">
                      <script type="text/javascript">
					  	if(readCookie("akt_komunikat")=="false")
						{
							show_msg('<p class=ok>Konto nie zostało aktywowane, jeżeli nie przyszedł email z kodem aktywacyjnym kliknij w <a href="index?strona=re-kod_aktywacyjny" style="color:#000000">ten link</a></p>', '#informacja .msg', '#informacja .msg .ok', 15000);
							document.cookie = "akt_komunikat=true; path=/";
						}
					  </script>
                    </div>
                </div>	
            <?					
			}
			include('silnik.php'); 
		}
		else
		{
			echo'<p style="font-size: xx-large;">Strona została wyłączona, wróć póżniej</p>';	
		}
	}
		?>		
        </center> 
        </div>
	</body>
</html>