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
<form action="?panel=msg" method="post">
	<input type="submit" name="msg_napisz" value="Napisz Wiadomość Prywatną" />
	<input type="submit" name="msg_zobacz" value="Zobacz Wiadomości Prywatne" />
	<input type="submit" name="wroc" value="Wróć" />
</form>';

$napisz = '	
<form action="?panel=msg" method="post">
  <table>	
 	<td width="120">
			<b>Tytuł:</b> 
	</td>
		<td>
			<input type="text" name="temat" onkeyup="Rozszerz(this);" value="Wpisz Tytuł"/>
		</td>
	</tr>
	 	<td width="120">
			<b>Treść:</b> 
		</td>
		<td>
			<input type="text" name="tresc" onkeyup="Rozszerz(this);" value="Wpisz Treść"/>
		</td>
	</tr>	
	 	<td width="120">
			<b>Do Kogo:</b> 
		</td>
		<td>
			<select id="adresat" name="adresat"></select>
		</td>
	</tr>	
	</table>
	
	<input type="submit" name="wyslij" value="Wyślij" />
	<input type="submit" name="wroc_zobacz" value="Wróć" />
	</form>	
';

$zobacz = '
<form action="?panel=msg" method="post">
	<input type="submit" name="pokaz_liste" value="Pokaż listę odebranych wiadomości" />
	<input type="submit" name="pokaz_wyslane" value="Pokaż wysłane wiadomości" />
	<input type="submit" name="wroc_zobacz" value="Wróć" />
</form>';
$zobacz_lista = '
<form action="?panel=msg" method="post">
	<input type="submit" name="msg_zobacz" value="Wróć" />
</form>';

	if(isset($_COOKIE['session_id']))
	{
		if($poziom>=1)
		{
			if(isset($_POST['msg_napisz']))
			{
				echo $napisz;	
			}
			elseif(isset($_POST['msg_zobacz']))
			{
				$zapytajka_nowe_wiadomosci = mysqli_query($conn,"SELECT * FROM msg WHERE `do` = '$login' AND `przeczytane` = 'Nie';");
				
				if(mysqli_num_rows($zapytajka_nowe_wiadomosci)>=1)
				{
					$nieprzeczytane = mysqli_num_rows($zapytajka_nowe_wiadomosci);
					if($nieprzeczytane==1)
					{
						echo'<p><b>Masz <span>'.$nieprzeczytane.'</span> nieprzeczytaną wiadomość</b><p>';
						echo $zobacz;
					}
					elseif($nieprzeczytane==2 | $nieprzeczytane==3 | $nieprzeczytane==4)
					{
						echo'<p><b>Masz <span>'.$nieprzeczytane.'</span> nieprzeczytane wiadomości</b><p>';
						echo $zobacz;
					}
					else
					{
						echo'<p><b>Masz <span>'.$nieprzeczytane.'</span> nieprzeczytanych wiadomości</b><p>';
						echo $zobacz;
					}
				}
				else
				{
					echo'<b>Nie masz nie przeczytanych wiadomości</b>';
					echo $zobacz;
				}							
			}
			elseif(isset($_POST['pokaz_liste']))
			{
				$zapytanie = "SELECT * FROM `msg` WHERE `do` = '$login';";
				$wynik = mysqli_query($conn,$zapytanie);
				
				if(mysqli_num_rows($wynik) >=1)
				{								
					echo "<p>";
					echo "<table boder=\"1\"><tr>";
					echo "<td><span style=\"font-size: 20px;\"><strong></strong></span></td>";
					echo "<td><span style=\"font-size: 20px;\"><strong>Tytuł</strong></span></td>";
					echo "<td><span style=\"font-size: 20px;\"><strong>Treść</strong></span></td>";
					echo "<td><span style=\"font-size: 20px;\"><strong>Od Kogo</strong></span></td>";
					echo "<td><span style=\"font-size: 20px;\"><strong>Data</strong></span></td>";
					echo "<td><span style=\"font-size: 20px;\"><strong>Godzina</strong></span></td>";
					echo "</tr>";
								
								while ( $row = mysqli_fetch_row($wynik) ) {
						echo "</tr>";
						echo '<td><button name="przeczytane_'.$row[0].'" onclick="przeczytane('.$row[0].');" >Przeczytane</button></td>';
						echo "<td><span style=\"font-size: 20px;\">" . $row[1] . "</span></td>";
						echo "<td><span style=\"font-size: 20px;\">" . $row[1] . "</span></td>";
						echo "<td><span style=\"font-size: 20px;\">" . $row[4] . "</span></td>";
						echo "<td><span style=\"font-size: 20px;\">" . $row[2] . "</span></td>";
						echo "<td><span style=\"font-size: 20px;\">" . $row[6] . "</span></td>";
						echo "<td><span style=\"font-size: 20px;\">" . $row[7] . "</span></td>";
						echo '<td><button name="odpowiedz_'.$row[0].'" onclick="odpowiedz('.$row[0].');" >Odpowiedz</button></td>';
						echo "</tr>";
					}
					echo "</table>";
					echo $zobacz_lista;	
				}
				else
				{
					echo '<b>Brak odebranych wiadomości</b>';
					echo $zobacz_lista;		
				}
			}			
			elseif(!empty($_POST['wyslij']))
			{
				$do = $_POST['adresat'];
				$od = $login;
				$temat = $_POST['temat'];
				$tresc = $_POST['tresc'];
				$data=date("Y-m-d");
				$godzina=date("H:i");
				
				$zapytajka_user = mysqli_query($conn,"SELECT * FROM authme WHERE `username` = '$do';");
					if(mysqli_num_rows($zapytajka_user) == 1) 
					{	
						if($do != $od)
						{				
							mysqli_query($conn,"INSERT INTO msg (tytul, od, do, tresc, przeczytane, data, godzina)
							VALUES ('$temat', '$od', '$do', '$tresc', 'Nie', '$data', '$godzina')");
							?>
							  <div id="dialog-message" title="Msg">
							   <p>
							   Wiadomość wysłana do <b><? echo $do; ?></b></p>
							  </div>
							<?	
							echo $napisz;
								
							$nick_logi = $login;
							$gdzie_logi = "Strona Wysylania MSG";
							$co_logi = "Wyslal wiadomosc prywatna do $do";
										
							include('/home/skymin/public_html/panel/includes/logi.php');						
						}
						else
						{
							?>
							  <div id="dialog-message" title="Msg">
							   <p>
							   Nie możesz wysłać wiadomości sam do siebie</p>
							  </div>
							<?	
							echo $napisz;	
						}
					}
					else
					{
						?>
						  <div id="dialog-message" title="Msg">
						   <p>
						   Podany użytkownik nie istnieje</p>
						  </div>
						<?							
						echo $napisz;
					}
			}
			elseif(isset($_POST['pokaz_wyslane']))
			{
				$zapytanie = "SELECT * FROM `msg` WHERE `od` = '$login';";
				$wynik = mysqli_query($conn,$zapytanie);
				
				if(mysqli_num_rows($wynik)>=1)
				{
					$wynik = mysqli_query($conn,$zapytanie);
					
					echo "<p>";
					echo "<table boder=\"1\"><tr>";
					echo "<td><span style=\"font-size: 20px;\"><strong>Tytuł</strong></span></td>";
					echo "<td><span style=\"font-size: 20px;\"><strong>Treść</strong></span></td>";
					echo "<td><span style=\"font-size: 20px;\"><strong>Do Kogo</strong></span></td>";
					echo "<td><span style=\"font-size: 20px;\"><strong>Data</strong></span></td>";
					echo "<td><span style=\"font-size: 20px;\"><strong>Godzina</strong></span></td>";
					echo "<td><span style=\"font-size: 20px;\"><strong>Przeczytane</strong></span></td>";
					echo "</tr>";
								
					while ( $row = mysqli_fetch_row($wynik) ) {
						echo "</tr>";
						echo "<td><span style=\"font-size: 20px;\">" . $row[1] . "</span></td>";
						echo "<td><span style=\"font-size: 20px;\">" . $row[4] . "</span></td>";
						echo "<td><span style=\"font-size: 20px;\">" . $row[3] . "</span></td>";
						echo "<td><span style=\"font-size: 20px;\">" . $row[6] . "</span></td>";
						echo "<td><span style=\"font-size: 20px;\">" . $row[7] . "</span></td>";
						echo "<td><span style=\"font-size: 20px;\">" . $row[5] . "</span></td>";
						echo "</tr>";
					}
					echo "</table>";
					echo $zobacz_lista;	
				}
				else
				{
					echo '<b>Brak wysłanych wiadomości</b>';
					echo $zobacz_lista;	
				}				
			}
			elseif($ps=="odebrane")
			{
				$zapytanie = "SELECT * FROM `msg` WHERE `do` = '$login';";
				$wynik = mysqli_query($conn,$zapytanie);
				
				if(mysqli_num_rows($wynik) >=1)
				{								
					echo "<p>";
					echo "<table boder=\"1\"><tr>";
					echo "<td><span style=\"font-size: 20px;\"><strong></strong></span></td>";
					echo "<td><span style=\"font-size: 20px;\"><strong>Tytuł</strong></span></td>";
					echo "<td><span style=\"font-size: 20px;\"><strong>Treść</strong></span></td>";
					echo "<td><span style=\"font-size: 20px;\"><strong>Od Kogo</strong></span></td>";
					echo "<td><span style=\"font-size: 20px;\"><strong>Data</strong></span></td>";
					echo "<td><span style=\"font-size: 20px;\"><strong>Godzina</strong></span></td>";
					echo "<td><span style=\"font-size: 20px;\"><strong></strong></span></td>";
					echo "</tr>";
								
					while ( $row = mysqli_fetch_row($wynik) ) {
						echo "</tr>";
						echo '<td><button name="przeczytane_'.$row[0].'" onclick="przeczytane('.$row[0].');" >Przeczytane</button></td>';
						echo "<td><span style=\"font-size: 20px;\">" . $row[1] . "</span></td>";
						echo "<td><span style=\"font-size: 20px;\">" . $row[1] . "</span></td>";
						echo "<td><span style=\"font-size: 20px;\">" . $row[4] . "</span></td>";
						echo "<td><span style=\"font-size: 20px;\">" . $row[2] . "</span></td>";
						echo "<td><span style=\"font-size: 20px;\">" . $row[6] . "</span></td>";
						echo "<td><span style=\"font-size: 20px;\">" . $row[7] . "</span></td>";
						echo '<td><button name="odpowiedz_'.$row[0].'" onclick="odpowiedz('.$row[0].');" >Odpowiedz</button></td>';
						echo "</tr>";
					}
					echo "</table>";
					
					if($_COOKIE['wiad']=="true")
					{
						?>
						<div id="dialog-message" title="Msg">
						<p>Podana wiadomość prywatna została oznaczona jako przeczytana</p>
						</div>   
                        <script type="text/javascript">
							document.cookie = "wiad=false";
						</script>              
						<?
					}
					echo $zobacz_lista;	
				}
				else
				{
					echo '<b>Brak odebranych wiadomości</b>';
					echo $zobacz_lista;		
				}
			}
			elseif($ps=="wyslane")
			{
				$zapytanie = "SELECT * FROM `msg` WHERE `od` = '$login';";
				$wynik = mysqli_query($conn,$zapytanie);
				
				if(mysqli_num_rows($wynik)>=1)
				{
					$wynik = mysqli_query($conn,$zapytanie);
					
					echo "<p>";
					echo "<table boder=\"1\"><tr>";
					echo "<td><span style=\"font-size: 20px;\"><strong>Tytuł</strong></span></td>";
					echo "<td><span style=\"font-size: 20px;\"><strong>Treść</strong></span></td>";
					echo "<td><span style=\"font-size: 20px;\"><strong>Do Kogo</strong></span></td>";
					echo "<td><span style=\"font-size: 20px;\"><strong>Data</strong></span></td>";
					echo "<td><span style=\"font-size: 20px;\"><strong>Godzina</strong></span></td>";
					echo "<td><span style=\"font-size: 20px;\"><strong>Przeczytane</strong></span></td>";
					echo "</tr>";
								
					while ( $row = mysqli_fetch_row($wynik) ) {
						echo "</tr>";
						echo "<td><span style=\"font-size: 20px;\">" . $row[1] . "</span></td>";
						echo "<td><span style=\"font-size: 20px;\">" . $row[4] . "</span></td>";
						echo "<td><span style=\"font-size: 20px;\">" . $row[3] . "</span></td>";
						echo "<td><span style=\"font-size: 20px;\">" . $row[6] . "</span></td>";
						echo "<td><span style=\"font-size: 20px;\">" . $row[7] . "</span></td>";
						echo "<td><span style=\"font-size: 20px;\">" . $row[5] . "</span></td>";
						echo "</tr>";
					}
					echo "</table>";
					echo $zobacz_lista;	
				}
				else
				{
					echo '<b>Brak wysłanych wiadomości</b>';
					echo $zobacz_lista;	
				}				
			}
			elseif(isset($_POST['wroc']))
			{
				echo '<meta http-equiv="Refresh" content="0; url=index.php?panel=wybor" />';		
			}
			elseif($_COOKIE['wiad']=="true")
			{
				?>
                <div id="dialog-message" title="News">
                <p>Podana wiadomość prywatna została oznaczona jako przeczytana</p>
                </div>                 
                <?
			}
			else
			{
				echo $wybor;	
			}
		}
		else
		{
			echo'<p style="font-size:25px;">Nie jesteś administratorem/moderatorem</p>';
			echo '<meta http-equiv="Refresh" content="2; url=http://skymin.pl/" />';	
		}
	}
	else
	{
		echo'<p style="font-size:25px;">Nie jesteś zalogowany</p>';	
		echo '<meta http-equiv="Refresh" content="2; url=http://skymin.pl/" />';
	}

?>
<script type="text/javascript">
<?
$zapytanie = "SELECT * FROM `authme`";

$wynik = mysqli_query($conn,$zapytanie);
while ( $row = mysqli_fetch_row($wynik) ) {
	if($row[1]!=$login)
	{
		echo 'var thisValue = "'.$row[1].'";';
		echo 'var thisText = "Gracz: '.$row[1].'";';
		echo 'var thisOpt = document.createElement(\'option\');';
		echo 'thisOpt.value = thisValue;';
		echo 'thisOpt.appendChild(document.createTextNode(thisText));';
		echo '$("#adresat").append(thisOpt);';
	}
}

?>
	var thisValue = "Wszyscy";
	var thisText = "Wszyscy";
	var thisOpt = document.createElement('option');
	thisOpt.value = thisValue;
	thisOpt.appendChild(document.createTextNode(thisText));
	$("#adresat").append(thisOpt);
	
	function przeczytane(id_wiad)
	{
		document.cookie = "id_wiad="+id_wiad;	
		window.location.replace("index.php?panel=msg_przeczytane");
	}
	
	function odpowiedz(id_wiad)
	{
		alert(id_wiad);	
	}
</script>	