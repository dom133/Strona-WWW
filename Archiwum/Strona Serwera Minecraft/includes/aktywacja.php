<?

	$kod = NULL;
	if (array_key_exists('kod', $_GET)) {
		$kod = $_GET['kod'];
	}
	
		$strona = '
		<form name="aktywacja" method="post" action="">
			<br />
			<input type="text" name="kod_name" class="loginbox" value="Podaj kod" />
			<input type="submit" name="kod_submit" class=\"button\" value="Aktywuj Konto" />
			<br />
		</form>';
		
	
	if($kod==NULL)
	{
		if(isset($_POST['kod_submit']))
		{
			echo '<meta http-equiv="Refresh" content="0; url=index.php?strona=aktywacja&kod='.$_POST['kod_name'].'" />';	
		}
		else
		{
			echo $strona;	
		}
	}
	else
	{
		$zapytanie = mysqli_query($conn,"SELECT * FROM `autoryzacja` WHERE `Klucz_a` = '$kod' ");
		if(mysqli_num_rows($zapytanie)==0)
		{
				?>
                <script type="text/javascript">
				show_msg('<p class=ok>Podany kod aktywacyjny jest błędny!</p>', '#informacja .msg', '#informacja .msg .ok', 15000);
				</script>
                <?
			include('includes/glowna.php');	
		}
		else
		{
			$row = mysqli_fetch_row($zapytanie);
			$nick = $row[1];
			$zapytanie1 = mysqli_query($conn,"SELECT * FROM `authme` WHERE `username` = '$nick' ");
			$row1 = mysqli_fetch_row($zapytanie1);
			$aktywne = $row[4]; 
			if($aktywne=="tak")
			{				
				?>
                <script type="text/javascript">
				show_msg('<p class=ok>Konto jest już aktywne</p>', '#informacja .msg', '#informacja .msg .ok', 15000);
				</script>
                <?
				include('includes/glowna.php');
			}
			else
			{
				mysqli_query($conn,"UPDATE `autoryzacja` SET `Aktywne`='tak' WHERE `Klucz_a`='$kod'");	
				
				$tytul = "Aktywacja konta na SkyMin";
				$wiadomosc = "Witaj $nick,
Konto zostalo aktywowane i mozesz sie zalogowac";
				// uzycie funkcji mail
				mail($row1[9], $tytul, $wiadomosc);	
							
				?>
                <script type="text/javascript">
				show_msg('<p class=ok>Konto zostało aktywowane, możesz się zalogować</p>', '#informacja .msg', '#informacja .msg .ok', 15000);
				</script>
                <?
				include('includes/glowna.php');
			}
		}
	}
?>