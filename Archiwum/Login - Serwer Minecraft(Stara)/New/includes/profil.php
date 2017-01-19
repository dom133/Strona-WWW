</center>
<script type="text/javascript">
	function avatar(url, nick)
	{
		document.getElementById("avatar").innerHTML = "<img title="+nick+" src="+url+" />";	
	}
	
	function info(nick, steamid, email, czas_gry, auth)
	{
		if(email=="")email="Brak";
		if(czas_gry=="sec")czas_gry="0sec";
		
		if(steamid=="NULL")
		{
			if(auth=="tak")
			{
				document.getElementById("info").innerHTML = "<p>Nick: "+nick+"</p><p>Email: "+email+"</p><p>Czas gry: "+czas_gry+"</p><p>Steamid: <a href=\"index.php?login=steam&auth\"><img src=\"http://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_small.png\" title=\"Steam\" /></a></p><a href=\"index.php?strona=avatar\" class=\"button\" style=\"padding-left:10px; padding-right:10px; padding-top:5px; padding-bottom:5px;\">Wrzuć avatar</a>";	
			}
			else
			{
				document.getElementById("info").innerHTML = "<p>Nick: "+nick+"</p><p>Email: "+email+"</p><p>Czas gry: "+czas_gry+"</p><p>Steamid: <img src=\"http://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_small.png\" title=\"Steam\" /></p>";	
			}
		}
		else
		{
			if(auth=="tak")
			{
				document.getElementById("info").innerHTML = "<p>Nick: "+nick+"</p><p>Email: "+email+"</p><p>Czas gry: "+czas_gry+"</p><p>Steamid: "+steamid+"</p><a href=\"index.php?strona=avatar\" class=\"button\" style=\"padding-left:10px; padding-right:10px; padding-top:5px; padding-bottom:5px;\">Wrzuć avatar</a>";	
			}
			else
			{
				document.getElementById("info").innerHTML = "<p>Nick: "+nick+"</p><p>Email: "+email+"</p><p>Czas gry: "+czas_gry+"</p><p>Steamid: Niewidoczny</p>";	
			}	
		}
	}
	
	function userbody(nick)
	{
		document.getElementById("user-body").innerHTML = "<img src=\"https://minotar.net/body/"+nick+"/100.png\" title=\""+nick+"\" />";
	}
</script>

<?php

$session_id = $_COOKIE['session_id'];
$zapytanie = "SELECT * FROM `autoryzacja` WHERE `Session_id` = '$session_id'";
$wynik = mysql_query($zapytanie);	
$row = mysql_fetch_row($wynik);
$login = $row[1];
$steamid = $row[5];
$avatar_url = $row[6];

$zapytanie = "SELECT * FROM `authme` WHERE `username` = '$login'";
$wynik = mysql_query($zapytanie);	
$row = mysql_fetch_row($wynik);	
$email = $row[9];

$zapytanie = "SELECT * FROM `inqplayers` WHERE `name` = '$login'";
$wynik = mysql_query($zapytanie);	
$row = mysql_fetch_row($wynik);	
$czas_gry = $row[37];

if($czas_gry>=60) $czas_gry = round($czas_gry/60, 1)."min";
elseif($czas_gry<60) $czas_gry = $czas_gry."sec";
elseif($czas_gry>=3600) $czas_gry = round($czas_gry/3500, 1)."godz";

$strona = "
<div id=\"main\">
<div id=\"avatar\"></div>
<div id=\"info\"></div>
<div id=\"user-body\"></div>
</div>";

	$gracz = NULL;
	if (array_key_exists('gracz', $_GET)) {
		$login = $_GET['gracz'];
		echo $strona;
		
		$zapytanie = "SELECT * FROM `autoryzacja` WHERE `User` = '$login'";
		$wynik = mysql_query($zapytanie);	
		$row = mysql_fetch_row($wynik);
		$steamid = $row[5];
		$avatar_url = $row[6];
		
		$zapytanie = "SELECT * FROM `authme` WHERE `username` = '$login'";
		$wynik = mysql_query($zapytanie);	
		$row = mysql_fetch_row($wynik);	
		$email = $row[9];
		
		$zapytanie = "SELECT * FROM `inqplayers` WHERE `name` = '$login'";
		$wynik = mysql_query($zapytanie);	
		$row = mysql_fetch_row($wynik);	
		$czas_gry = $row[37];
		
		if($czas_gry>=60) $czas_gry = round($czas_gry/60, 1)."min";
		elseif($czas_gry<60) $czas_gry = $czas_gry."sec";
		elseif($czas_gry>=3600) $czas_gry = round($czas_gry/3500, 1)."godz";
				
		if($avatar_url=="")
		{
			$premium_user = file_get_contents('https://minecraft.net/haspaid.jsp?user='.$login);
			if($premium_user == "false")
			{
				?>
					<script type="text/javascript">
					avatar("https://minotar.net/avatar/char", "<? echo $login; ?>");
					userbody("<? echo $login; ?>");
					</script>
				<?
				if($steamid=="")
				{
					?>
					<script type="text/javascript">
						info("<? echo $login; ?>", "NULL", "<? echo $email; ?>", "<? echo $czas_gry ?>", "nie");
						userbody("<? echo $login; ?>");
					</script>
					<?
				}
				elseif(!$steamid=="")
				{
					?>
					<script type="text/javascript">
						info("<? echo $login; ?>", "<? echo $steamid;  ?>", "<? echo $email; ?>", "<? echo $czas_gry ?>", "nie");
					</script>
					<?
				}
			}
			else
			{
				?>
					<script type="text/javascript">
					avatar("https://minotar.net/avatar/<? echo $login; ?>", "<? echo $login; ?>");
					userbody("<? echo $login; ?>");
					</script>
				<?
				if($steamid=="")
				{
					?>
					<script type="text/javascript">
						info("<? echo $login; ?>", "NULL", "<? echo $email; ?>", "<? echo $czas_gry ?>", "nie");
					</script>
					<?
				}
				elseif(!$steamid=="")
				{
					?>
					<script type="text/javascript">
						info("<? echo $login; ?>", "<? echo $steamid;  ?>", "<? echo $email; ?>", "<? echo $czas_gry ?>", "nie");
					</script>
					<?
				}				
			}
		}
		elseif(!$avatar_url=="")
		{
			?>
            	<script type="text/javascript">
				avatar("<? echo $avatar_url; ?>", "<? echo $login;  ?>");
				userbody("<? echo $login; ?>");
				</script>           
			<?
				if($steamid=="")
				{
					?>
					<script type="text/javascript">
						info("<? echo $login; ?>", "NULL", "<? echo $email; ?>", "<? echo $czas_gry ?>", "nie");
					</script>
					<?
				}
				elseif(!$steamid=="")
				{
					?>
					<script type="text/javascript">
						info("<? echo $login; ?>", "<? echo $steamid;  ?>", "<? echo $email; ?>", "<? echo $czas_gry ?>", "nie");
					</script>
					<?
				}			
		}		
	}
	else
	{
		if(!empty($session_id))
		{
			echo $strona;
			if($avatar_url=="")
			{
				$premium_user = file_get_contents('https://minecraft.net/haspaid.jsp?user='.$login);
				if($premium_user == "false")
				{
					?>
						<script type="text/javascript">
						avatar("https://minotar.net/avatar/char", "<? echo $login; ?>");
						userbody("<? echo $login; ?>");
						</script>
					<?
					if($steamid=="")
					{
						?>
						<script type="text/javascript">
							info("<? echo $login; ?>", "NULL", "<? echo $email; ?>", "<? echo $czas_gry ?>", "tak");
						</script>
						<?
					}
					elseif(!$steamid=="")
					{
						?>
						<script type="text/javascript">
							info("<? echo $login; ?>", "<? echo $steamid;  ?>", "<? echo $email; ?>", "<? echo $czas_gry ?>", "tak");
						</script>
						<?
					}
				}
				else
				{
					?>
						<script type="text/javascript">
						avatar("https://minotar.net/avatar/<? echo $login; ?>", "<? echo $login; ?>");4
						userbody("<? echo $login; ?>");
						</script>
					<?
					if($steamid=="")
					{
						?>
						<script type="text/javascript">
							info("<? echo $login; ?>", "NULL", "<? echo $email; ?>", "<? echo $czas_gry ?>", "tak");
						</script>
						<?
					}
					elseif(!$steamid=="")
					{
						?>
						<script type="text/javascript">
							info("<? echo $login; ?>", "<? echo $steamid;  ?>", "<? echo $email; ?>", "<? echo $czas_gry ?>", "tak");
						</script>
						<?
					}				
				}
			}
			elseif(!$avatar_url=="")
			{
				?>
					<script type="text/javascript">
					avatar("<? echo $avatar_url; ?>", "<? echo $login;  ?>");
					userbody("<? echo $login; ?>");
					</script>           
				<?
					if($steamid=="")
					{
						?>
						<script type="text/javascript">
							info("<? echo $login; ?>", "NULL", "<? echo $email; ?>", "<? echo $czas_gry ?>", "tak");
						</script>
						<?
					}
					elseif(!$steamid=="")
					{
						?>
						<script type="text/javascript">
							info("<? echo $login; ?>", "<? echo $steamid;  ?>", "<? echo $email; ?>", "<? echo $czas_gry ?>", "tak");
						</script>
						<?
					}			
			}
		}
		else
		{
			echo '<center>';
			echo '<p style="font-size:25px;">Nie jesteś zalogowany</p>';	
			echo '</center>';
		}
	}
?>