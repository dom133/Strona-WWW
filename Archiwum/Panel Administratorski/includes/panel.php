<?php  	   
	$formularz = '	
<form action="?panel=panel" method="post">
  <table>	
 	<td width="120">
			<b>Strona Główna On/Of:</b> 
				</td>
		<td>
			<select id="glowna" name="glowna">
				<option value="1">On</option>
				<option value="0">Off</option>
			</select>
		</td>
	</tr>
	 	<td width="130">
			<b>Strona Launcher On/Of:</b> 
				</td>
		<td>
			<select id="launcher" name="launcher">
				<option value="1">On</option>
				<option value="0">Off</option>
			</select>
		</td>
	</tr>		
	 	<td width="120">
			<b>Strona Forum On/Of:</b> 
				</td>
		<td>
			<select id="forum" name="forum">
				<option value="1">On</option>
				<option value="0">Off</option>
			</select>
		</td>
	</tr>
	 	<td width="130">
			<b>Strona Statystyki On/Of:</b> 
				</td>
		<td>
			<select id="statystyki" name="statystyki">
				<option value="1">On</option>
				<option value="0">Off</option>
			</select>
		</td>
	</tr>
	</table>
	
	<input type="submit" name="wyslij" value="Wyślij" />
	<input type="submit" name="wroc" value="Wróć" />
	</form>	
';

$session_id = $_COOKIE['session_id'];
$zapytanie = "SELECT * FROM `autoryzacja` WHERE `Session_id` = '$session_id'";
$wynik = mysqli_query($conn,$zapytanie);	
$row = mysqli_fetch_row($wynik);
$login = $row[1];
$poziom = $row[2];

	if(isset($_COOKIE['session_id'])) {
		if($poziom==2) {
			if(!empty($_POST['wroc']))
			{
				echo '<meta http-equiv="Refresh" content="0; url=index.php?panel=wybor" />'; 	
			}
			else
			{
				$nazwa_tabela[0] = "glowna";
				$status_tabela[0] = $_POST['glowna'];
								
				$nazwa_tabela[2] = "launcher";
				$status_tabela[2] = $_POST['launcher'];
								
				$nazwa_tabela[3] = "forum";
				$status_tabela[3] = $_POST['forum'];				
				
				$nazwa_tabela[5] = "statystyki";
				$status_tabela[5] = $_POST['statystyki'];
															
				if(!empty($_POST['wyslij']))
				{
					for($i=0; $i<=5; $i++)
					{
						$status = $status_tabela[$i];
						$nazwa = $nazwa_tabela[$i];
						mysqli_query($conn,"UPDATE `strona` SET `wlaczona`='$status' WHERE `nazwa_strony`='$nazwa'");	
					}
					
					$nick_logi = $login;
					$gdzie_logi = "Strona panel";
					$co_logi = "Wlaczyl/wylaczyl strony";
					
					include('/home/skymin/public_html/panel/includes/logi.php');
			
					?>
							<div id="dialog-message" title="Panel">
							<p>
							Podane strony zostały wł/wył</p>
							</div>
						<?
					echo $formularz;
				}
				else
				{
					echo $formularz;
				}
			}
		}
		else
		{
			echo'<h1>Nie jestes administratorem</h1>';	
			echo '<meta http-equiv="Refresh" content="2; url=http://skymin.pl/" />';
		}
	}else{
		echo'<h1>Nie jestes zalogowany</h1>';
		echo '<meta http-equiv="Refresh" content="2; url=http://skymin.pl/" />';
	}
?>
<script type="text/javascript">
<?
$zapytanie = "SELECT * FROM `strona`";

$wynik = mysqli_query($conn,$zapytanie);
while ( $row = mysqli_fetch_row($wynik) ) {
	if($row[0]=="glowna")
		echo 'document.getElementById("glowna").value = '.$row[1].' ;';
	elseif($row[0]=="forum")
		echo 'document.getElementById("forum").value = '.$row[1].' ;';	
	elseif($row[0]=="statystyki")
		echo 'document.getElementById("statystyki").value = '.$row[1].' ;';	
	elseif($row[0]=="launcher")
		echo 'document.getElementById("launcher").value = '.$row[1].' ;';	
}

?>
</script>