<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
    <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <script src="/scripts/pace.js"></script>
    <link href="/style/pace-theme.css" rel="stylesheet" />
    <script src="scripts/scripts.js"></script>  
    <link rel="stylesheet" href="style/style.css" type="text/css" /> 
    <title>Skymin - Panel Administratorski</title>   
    <link rel="Shortcut icon" href="http://www.skymin.xaa.pl/img/favicon.ico" />  
    <style type="text/css">
		body {
    		background-image: url("http://www.skymin.xaa.pl/img/minecraft.png"); //from http://subtlepatterns.com
		}
		
		{
			width:100%;
			box-sizing:border-box;
			-moz-box-sizing:border-box;
		}
	</style> 
	<script>
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
    </script>    
</head>

<body> 
	<div class="head-bar">
		<div class="wrapper">
			<ul class="menu">
                	<li><a href="http://www.skymin.pl/index.php">Strona Główna</a></li>
                    <li><a href="http://www.skymin.pl/?strona=launcher">Launcher - Download</a></li>
                    <li><a href="http://www.skymin.pl/?strona=forum">Forum</a></li>
					<li><a href="http://www.skymin.pl/?strona=statystyki">Statystyki</a></li>
			</ul>
           <div class="right">
            	<div class="right-menu">
                <?
				include('/home/skymin/public_html/mysql-polaczenie.php');
				$session_id = $_COOKIE['session_id'];
				$zapytanie = "SELECT * FROM `autoryzacja` WHERE `Session_id` = '$session_id'";
				$wynik = mysqli_query($conn,$zapytanie);	
				$row = mysqli_fetch_row($wynik);
				$login = $row[1];
				$poziom = $row[2];
								
                $panel_zal = '<form id="panel-login" method="post" action="?panel=login" class="right-panel">
					<a href="?panel=steam&auth"><img src="http://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_small.png" /></a>
                	<input type="text" name="login" class="loginbox" placeholder="Login"  />
                    <input type="password" name="haslo" class="loginbox" placeholder="Haslo" />
                    <input type="submit" name="zaloguj" class="button" value="Zaloguj" /> 
                    <a href="index.php?strona=rejestracja" class="button">Zarejestruj</a>
                </form>';
							
				$panel_wyl = '
				<form id="panel-action" method="post" action="" class="right-panel">
					<p>Witaj <a href="http://www.skymin.pl/?strona=profil">'.$login.'</a>
					<a href="index.php?panel=wyloguj" class="button">Wyloguj</a></p>
				</form>';
				
				if(isset($session_id))
				{
					echo $panel_wyl;	
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
            	<? include('/home/skymin/public_html/includes/status.php'); ?>
            </div>
        </div>
    </center>    
<center>
<?php
	include('/home/skymin/public_html/mysql-polaczenie.php');
	include('silnik.php'); 
?>	
</center>
</div>
</body>
</html>