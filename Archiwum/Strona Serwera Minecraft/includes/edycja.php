<?
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

$strona = "
<div id=\"main_edycja\">
<div id=\"top_bar_edycja\"></div>
<div id=\"info_edycja\"></div>
</div>";

if($session_id!="")
{
	if($_POST['edytuj'])
	{

	}
	else
	{
		echo $strona;	
	}
}
else
{
	echo '<center>';
	echo '<p style="font-size:25px;">Nie jesteś zalogowany</p>';	
	echo '<meta http-equiv="Refresh" content="2; url=index.php" />'; 
	echo '</center>';	
}
?>