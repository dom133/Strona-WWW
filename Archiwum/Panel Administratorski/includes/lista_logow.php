<style type="text/css">
td { font-size: large;}
</style>
<?php

$strona = '
<form action="" method="post">
	<input type="submit" name="odswierz" value="Odśwież" />
	<input type="submit" name="wroc" value="Wróć" />	
</form>';

$session_id = $_COOKIE['session_id'];
$zapytanie = "SELECT * FROM `autoryzacja` WHERE `Session_id` = '$session_id'";
$wynik = mysqli_query($conn,$zapytanie);	
$row = mysqli_fetch_row($wynik);
$login = $row[1];
$poziom = $row[2];

$zapytanie = "SELECT * FROM `logi`";

$wynik = mysqli_query($conn,$zapytanie);

	if(isset($_COOKIE['session_id'])) 
	{	
	  if($poziom>=1) 
	  {
		if(empty($_POST['wroc']))
	  	{
			?>
            <div style="overflow: scroll; width: 1000px; height: 550px; ">
            <?
			echo "<p>";
			echo "<table boder=\"1\"><tr>";
			echo "<td><strong>Data</strong></td>";
			echo "<td><strong>Godzina</strong></td>";
			echo "<td><strong>Nick</strong></td>";
			echo "<td><strong>Strona</strong></td>";
			echo "<td><strong>Akcja</strong></td>";
			echo "</tr>";
									
			while ( $row = mysqli_fetch_row($wynik) ) {
				echo "</tr>";
				echo "<td><b>" . $row[1] . "</b></td>";
				echo "<td><b>" . $row[2] . "</b></td>";
				echo "<td><b>" . $row[3] . "</b></td>";
				echo "<td><b>" . $row[4] . "</b></td>";
				echo "<td><b>" . $row[5] . "</b></td>";
				echo "</tr>";
			}
			echo "</table>"; 
			echo "</div>";
			$nick_logi = $login;
			$gdzie_logi = "Strona logi";
			$co_logi = "Przeglada logi strony";
					
			include('/home/skymin/public_html/panel/includes/logi.php');
			
			echo $strona;
		}
		else
		{
			echo '<meta http-equiv="Refresh" content="0; url=index.php?panel=wybor" />';
		}
	  }
	  else
	  {
		echo'<h1>Nie jestes administratorem</h1>';  
		echo '<meta http-equiv="Refresh" content="2; url=http://skymin.pl/" />';
	  }
	}
	else
	{
		echo'<h1>Nie jestes zalogowany</h1>';	
		echo '<meta http-equiv="Refresh" content="2; url=http://skymin.pl/" />';
	}
	 
?>