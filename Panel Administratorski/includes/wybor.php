<?php
$przeczytane = 'Nie';

$strona = '	
<h4>Dokonaj wyboru: </h4>
<form action="" method="post">
	<input type="submit" name="panel" value="Panel" />
	<input type="submit" name="uzytkownicy" value="Uzytkowncy" />
	<input type="submit" name="serwer" value="Serwer" />	
	<input type="submit" name="logi" value="Zobacz Logi" />
	<input type="submit" name="ogloszenie" value="Stwórz ogłoszenie" />
	<input type="submit" name="news" value="Dodaj News" />
	<input type="submit" name="msg" value="Zobacz Msg" />
	<input type="submit" name="wyloguj" value="Wyloguj" />
</form>';

$session_id = $_COOKIE['session_id'];
$zapytanie = "SELECT * FROM `autoryzacja` WHERE `Session_id` = '$session_id'";
$wynik = mysqli_query($conn,$zapytanie);	
$row = mysqli_fetch_row($wynik);
$login = $row[1];
$poziom = $row[2];

	if(isset($_COOKIE['session_id'])) 
	{	
		if($poziom>=1) 
		{
			$zapytajka_nowe_wiadomosci = mysqli_query($conn,"SELECT * FROM msg WHERE `do` = '$login' AND `przeczytane` = '$przeczytane';");	
			if(mysqli_num_rows($zapytajka_nowe_wiadomosci)>=1)
			{
?>
                <div id="dialog-message" title="Nowa prywatna wiadomość">
                  <p>
                    Masz nieprzeczytana nowa wiadomość.
                  </p>
                  <p>
                    Aby ją odczytać kliknij <a href="?panel=msg&ps=odebrane">tutaj</a></b></p>
                </div>
<?php		
		}
			if(!empty($_POST['wyloguj']))
			{
				echo '<meta http-equiv="Refresh" content="0; url=index.php?panel=wyloguj" />';	
			}
			elseif(!empty($_POST['panel']))
			{
				echo '<meta http-equiv="Refresh" content="0; url=index.php?panel=panel" />';	
			}
			elseif(!empty($_POST['serwer']))
			{
				echo '<meta http-equiv="Refresh" content="0; url=index.php?panel=serwer" />';	
			}
			elseif(!empty($_POST['uzytkownicy']))
			{
				echo '<meta http-equiv="Refresh" content="0; url=index.php?panel=uzytkownicy" />';	
			}
			elseif(!empty($_POST['logi']))
			{
				echo '<meta http-equiv="Refresh" content="0; url=index.php?panel=logi" />';	
			}
			elseif(!empty($_POST['ogloszenie']))
			{
				echo '<meta http-equiv="Refresh" content="0; url=index.php?panel=ogloszenie" />';
			}
			elseif(!empty($_POST['news']))
			{
				echo '<meta http-equiv="Refresh" content="0; url=index.php?panel=news" />';	
			}
			elseif(!empty($_POST['msg']))
			{
				echo '<meta http-equiv="Refresh" content="0; url=index.php?panel=msg" />';	
			}
			else
			{
				$nick_logi = $login;
				$gdzie_logi = "Strona wyboru";
				$co_logi = "Dokonuje wyboru";
					
				include('/home/skymin/public_html/panel/includes/logi.php');
								
				echo $strona;	
			}
		}
		else
		{
			echo'<h1>Nie jestes Administratorem</h1>';
			echo '<meta http-equiv="Refresh" content="2; url=http://skymin.pl/" />';
		}
	}
	else
	{
		echo'<h1>Nie jestes zalogowany</h1>';
		echo '<meta http-equiv="Refresh" content="2; url=http://skymin.pl/" />';	
	}
?>