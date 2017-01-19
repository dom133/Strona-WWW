<?php
$ps = NULL;
if (array_key_exists('ps', $_GET)) {
	$ps = $_GET['ps'];
}

$session_id = $_COOKIE['session_id'];
$zapytanie = "SELECT * FROM `autoryzacja` WHERE `Session_id` = '$session_id'";
$wynik = mysqli_query($conn,$zapytanie);	
$row = mysqli_fetch_row($wynik);
$login = $row[1];
$poziom = $row[2];

$wybor = '
<h4>Dokonaj wyboru: </h4>
<form action="?panel=serwer" method="post">
	<input type="submit" name="gracze" value="Lista Graczy Online" />
	<input type="submit" name="consola" value="Consola" />
	<input type="submit" name="wroc" value="Wroc" />
</form>';

$gracze = '
<form action="?panel=serwer" method="post">
	<input type="submit" name="wroc_gracze" value="Wroc" />
</form>';

if(isset($_COOKIE['session_id']))
{
	if($poziom>=1)
	{
		if(isset($_POST['gracze']))
		{
			$zapytanie = mysqli_query($conn,"SELECT * FROM inqplayers WHERE `online` = '1';");
			if(mysqli_num_rows($zapytanie)>=1)
			{
				echo "<p>";
				echo "<table boder=\"1\"><tr>";
				echo "<td><strong>Gracz</strong></td>";
				echo "<td><strong>Czas Gry(sec)</strong></td>";
				echo "<td><strong></strong></td>";
				echo "<td><strong></strong></td>";
				echo "<td><strong></strong></td>";
				echo "</tr>";
							
				while ( $row = mysqli_fetch_row($zapytanie) ) {
					echo "</tr>";
					echo "<td><b>" . $row[1] . "</b></td>";
					echo "<td><b>" . $row[12] . "</b></td>";
					echo '<td><button id="'.$row[0].'" name="kick_'.$row[0].'" onclick="kick("'.$row[1].'");" >Kick</button></td>';
					echo '<td><button id="'.$row[0].'" name="ban_'.$row[0].'" onclick="ban("'.$row[1].'");" >Ban</button></td>';
					echo "</tr>";
				}
				echo "</table>";
				echo $gracze;	
			}
			else
			{
				echo '<p>Brak graczy online</p>';	
				echo $gracze;
			}
		}
		elseif(isset($_POST['consola']))
		{
			echo '<meta http-equiv="Refresh" content="0; url=index.php?panel=consola" />';	
		}
		elseif(isset($_POST['wroc']))
		{
			echo '<meta http-equiv="Refresh" content="0; url=index.php?panel=wybor" />';		
		}
		elseif($ps=="consola")
		{
			echo '<meta http-equiv="Refresh" content="0; url=index.php?panel=consola" />';		
		}
		elseif($ps=="wybor")
		{
			echo $wybor;	
		}
		elseif($ps=="gracze")
		{
			$zapytanie = mysqli_query($conn,"SELECT * FROM inqplayers WHERE `online` = '1';");
			if(mysqli_num_rows($zapytanie)>=1)
			{
				echo "<p>";
				echo "<table boder=\"1\"><tr>";
				echo "<td><strong>Gracz</strong></td>";
				echo "<td><strong>Czas Gry(sec)</strong></td>";
				echo "<td><strong></strong></td>";
				echo "<td><strong></strong></td>";
				echo "</tr>";
							
				while ( $row = mysqli_fetch_row($zapytanie) ) {
					echo "</tr>";
					echo "<td><b>" . $row[1] . "</b></td>";
					echo "<td><b>" . $row[12] . "</b></td>";
					$kick = $row[0]+1;
					echo '<td><button id="'.$kick.'" name="kick_'.$row[0].'" onclick="kick("'.$row[1].'");" >Kick</button></td>';
					$ban = $row[0]+2;
					echo '<td><button id="'.$ban.'" name="ban_'.$row[0].'" onclick="ban("'.$row[1].'");" >Ban</button></td>';
					echo "</tr>";
				}
				echo "</table>";
				echo $gracze;	
			}
			else
			{
				echo '<p>Brak graczy online</p>';	
				echo $gracze;
			}			
		}
		elseif($ps=="kick")
		{
			echo 'kick';	
		}
		elseif($ps=="ban")
		{
			echo'ban';	
		}
		elseif($ps=="msg")
		{
			echo'pw';	
		}
		else
		{
			echo $wybor;	
		}
	}
	else
	{
		echo '<p style="font-size:25px;">Nie jesteś Moderatorem/Administratorem</p>';	
		echo '<meta http-equiv="Refresh" content="2; url=http://skymin.pl/" />';	
	}
}
else
{
	echo '<p style="font-size:25px;">Nie jesteś zalogowany</p>';
	echo '<meta http-equiv="Refresh" content="2; url=http://skymin.pl/" />';		
}


?>