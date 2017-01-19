<!DOCTYPE html>
<html lang="pl_PL">
  <head>
  	<link rel="Shortcut icon" href="http://www.skymin.xaa.pl/img/favicon.ico" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <div id="title"><title>Strona Główna | SkyMin - Strona Serwera Minecraft</title></div>
    <meta name="description" content="Serwer minecraft z modami SkyMine">
    <meta name="keywords" content="minecraft, serwer, mody, skymine, nopremium, premum">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>     
    <script src="js/main.js"></script>
    <script src="js/boostrap-functions.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/style.css" type="text/css" /> 
    <style type="text/css">
	body{
		padding-top: 70px;
		padding-bottom: 70px;
		background-image: url("img/background-light.png"); //from http://subtlepatterns.com
	}
	</style>
  </head>
  <body> 
	<nav id="navbar-top" class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-up">
                <span class="sr-only">Rozwiń nawigację</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
           </div>
           
           <div class="collapse navbar-collapse" id="navbar-up">
                <ul class="nav navbar-nav">
                    <li id="glowna" class="active"><a href="index.php">Strona Główna</a></li>
                    <li id="forum" class><a href="forum">Forum</a></li>
                    <li id="launcher" class><a href="launcher">Launcher</a></li>
                    <li id="statystyki" class><a href="statystyki">Statystyki</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                   <div id="login_form">
                   </div>
               </ul>
           </div>
    	</div>
    </nav> 
    
	<div id="alert" style="margin-top:10px; margin-left:30px; margin-right:30px;"></div>  
      
    <nav id="navbar-bottom" class="navbar navbar-default navbar-fixed-bottom" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-down">
            <span class="sr-only">Rozwiń nawigację</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
     
        <div class="collapse navbar-collapse" id="navbar-down">
          <ul class="nav navbar-nav navbar-left">
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Zmien Styl <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a onclick="style_change('dark');">Ciemna strona</a></li>
                <li><a onclick="style_change('light');">Jasna strona</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <?php
		include 'mysql-polaczenie.php';
		
		if(isset($_COOKIE['session_id']))
		{
			$session_id = $_COOKIE['session_id'];
			$zapytanie = "SELECT * FROM `users` WHERE `Session_id` = '$session_id'";
			$wynik = mysqli_query($conn, $zapytanie);	
			$row = mysqli_fetch_row($wynik);
			if($row[2]>=1)
			{
				if($row[5]!="")
				{
                	?><script type="text/javascript">change_login_form("login_form", "<?php echo $row[1]; ?>", "true", "login", "<?php echo $row[5]; ?>");</script><?php
				}
				else
				{
					?><script type="text/javascript">change_login_form("login_form", "<?php echo $row[1]; ?>", "true", "login", "https://mcapi.ca/avatar/2d/<?php echo $row[1]; ?>");</script><?php
				}
			}
			else
			{
				if($row[5]!="")
				{
                	?><script type="text/javascript">change_login_form("login_form", "<?php echo $row[1]; ?>", "false", "login", "<?php echo $row[5]; ?>");</script><?php
				}
				else
				{
					?><script type="text/javascript">change_login_form("login_form", "<?php echo $row[1]; ?>", "false", "login", "https://mcapi.ca/avatar/2d/<?php echo $row[1]; ?>");</script><?php
				}
			}
		}
		else
		{
			?><script type="text/javascript">change_login_form("login_form", "nick", "false", "nologin", "none");</script><?php			
		}
		
		include 'silnik.php';
		
		echo '<script type="text/javascript">if(getCookie("style")=="dark"){style_change("dark");}</script>';
	?>
  </body>
</html>