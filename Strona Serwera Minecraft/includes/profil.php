</center>
<?php

$session_id = $_COOKIE['session_id'];
$zapytanie = "SELECT * FROM `autoryzacja` WHERE `Session_id` = '$session_id'";
$wynik = mysqli_query($conn,$zapytanie);	
$row = mysqli_fetch_row($wynik);
$login = $row[1];
$steamid = $row[5];
$avatar_url = $row[6];

$zapytanie = "SELECT * FROM `authme` WHERE `username` = '$login'";
$wynik = mysqli_query($conn,$zapytanie);	
$row = mysqli_fetch_row($wynik);	
$email = $row[9];

$zapytanie = "SELECT * FROM `inqplayers` WHERE `name` = '$login'";
$wynik = mysqli_query($conn,$zapytanie);	
$row = mysqli_fetch_row($wynik);	
$czas_gry = $row[37];

if($czas_gry>=60) $czas_gry = round($czas_gry/60, 1)."min";
elseif($czas_gry<60) $czas_gry = $czas_gry."sec";
elseif($czas_gry>=3600) $czas_gry = round($czas_gry/3500, 1)."godz";

$strona = "
<div id=\"main_profil\">
<div id=\"avatar\"></div>
<div id=\"info_profil\"></div>
<div id=\"user-body\"></div>
</div>";

	$gracz = NULL;
	if (array_key_exists('gracz', $_GET)) {
		$login = $_GET['gracz'];
		echo $strona;
		
		$zapytanie = "SELECT * FROM `autoryzacja` WHERE `User` = '$login'";
		$wynik = mysqli_query($conn,$zapytanie);	
		$row = mysqli_fetch_row($wynik);
		$steamid = $row[5];
		$avatar_url = $row[6];
		
		$zapytanie = "SELECT * FROM `authme` WHERE `username` = '$login'";
		$wynik = mysqli_query($conn,$zapytanie);	
		$row = mysqli_fetch_row($wynik);	
		$email = $row[9];
		
		$zapytanie = "SELECT * FROM `inqplayers` WHERE `name` = '$login'";
		$wynik = mysqli_query($conn,$zapytanie);	
		$row = mysqli_fetch_row($wynik);	
		$czas_gry = $row[37];
		
		if($czas_gry>=60) $czas_gry = round($czas_gry/60, 1)."min";
		elseif($czas_gry<60) $czas_gry = $czas_gry."sec";
		elseif($czas_gry>=3600) $czas_gry = round($czas_gry/3500, 1)."godz";
				
		if($avatar_url=="")
		{
			?>
				<script type="text/javascript">
				avatar("https://mcapi.ca/avatar/2d/<? echo $login; ?>", "<? echo $login; ?>");
				userbody("<? echo $login; ?>");
				</script>
			<?
			if($steamid=="")
			{
				?>
				<script type="text/javascript">
					info_profil("<? echo $login; ?>", "NULL", "<? echo $email; ?>", "<? echo $czas_gry ?>", "nie");
				</script>
				<?
			}
			elseif(!$steamid=="")
			{
				?>
				<script type="text/javascript">
					info_profil("<? echo $login; ?>", "<? echo $steamid;  ?>", "<? echo $email; ?>", "<? echo $czas_gry ?>", "nie");
				</script>
				<?
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
						info_profil("<? echo $login; ?>", "NULL", "<? echo $email; ?>", "<? echo $czas_gry ?>", "nie");
					</script>
					<?
				}
				elseif(!$steamid=="")
				{
					?>
					<script type="text/javascript">
						info_profil("<? echo $login; ?>", "<? echo $steamid;  ?>", "<? echo $email; ?>", "<? echo $czas_gry ?>", "nie");
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
				?>
					<script type="text/javascript">
					avatar("https://mcapi.ca/avatar/2d/<? echo $login; ?>", "<? echo $login; ?>");4
					userbody("<? echo $login; ?>");
					</script>
				<?
				if($steamid=="")
				{
					?>
					<script type="text/javascript">
						info_profil("<? echo $login; ?>", "NULL", "<? echo $email; ?>", "<? echo $czas_gry ?>", "tak");
					</script>
					<?
				}
				elseif(!$steamid=="")
				{
					?>
					<script type="text/javascript">
						info_profil("<? echo $login; ?>", "<? echo $steamid;  ?>", "<? echo $email; ?>", "<? echo $czas_gry ?>", "tak");
					</script>
					<?
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
						info_profil("<? echo $login; ?>", "NULL", "<? echo $email; ?>", "<? echo $czas_gry ?>", "tak");
					</script>
					<?
				}
				elseif(!$steamid=="")
				{
					?>
					<script type="text/javascript">
						info_profil("<? echo $login; ?>", "<? echo $steamid;  ?>", "<? echo $email; ?>", "<? echo $czas_gry ?>", "tak");
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