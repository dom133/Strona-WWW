<?php 
$ps = NULL;
if (array_key_exists('ps', $_GET)) {
	$ps = $_GET['ps'];
}
	$news_edit = '
		<form action="?panel=news&ps=edycja" method="post">
		<b>Nazwa newsa:</b> 
		<input type="text" onkeyup="Rozszerz(this);" onMouseUp="Rozszerz(this);"  value="Brak" id="nazwa" name="nazwa_news" />
		<br />
		<b>Treść newsa:</b>
		<input type="text" onkeyup="Rozszerz(this);" onMouseUp="Rozszerz(this);" value="Brak" id="tresc" name="tresc_news" />	
		<br />
		<input type="submit" name="edytuj" value="Edytuj" />
		<input type="submit" name="wroc_n" value="Wróć" />
		</form>	';
		
	$news_panel = '
		<form action="?panel=news" method="post">
		<b>Nazwa newsa:</b> 
		<input type="text" onkeyup="Rozszerz(this);" name="nazwa_news" />
		<br />
		<b>Treść newsa:</b>
		<input type="text" onkeyup="Rozszerz(this);" name="tresc_news" />	
		<br />
		<input type="submit" name="dodaj" value="Dodaj" />
		<input type="submit" name="list" value="Lista" />
		<input type="submit" name="wroc" value="Wróć" />
		</form>	';
	$news_list = '
		<form action="?panel=news" method="post">
		<input type="submit" name="wroc_news" value="Wróć" />
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
			if(isset($_POST['dodaj']))
			{
				if(!empty($_POST['nazwa_news']))
				{
					if(!empty($_POST['tresc_news']))
					{
						$nazwa_news = $_POST['nazwa_news'];
						$tresc_news = $_POST['tresc_news'];
						$autor = $login;
						$data=date("Y-m-d");
						$godzina=date("H:i");
						
						mysqli_query($conn,"INSERT INTO news (nazwa_news, tresc_news, autor, data, godzina, edytowany, data_edycji, godzina_edycji, kto_edytowal)
						VALUES ('$nazwa_news', '$tresc_news', '$autor', '$data', '$godzina', 'nie', 'Brak', 'Brak', 'Brak')");
						
						$nick_logi = $login;
						$gdzie_logi = "Strona newsow";
						$co_logi = "Dodal newsa o nazwie $nazwa_news";
						
						include('/home/skymin/public_html/panel/includes/logi.php');
						?>
                        <div id="dialog-message" title="News Dodany">
                              <p>
                                Właśnie dodałeś newsa</b></p>
                         </div>
                        <?
						echo $news_panel;	
					}
					else
					{	
						?>
                        <div id="dialog-message" title="News">
                              <p>
                              <b> Podaj treść newsa</b></p>
                         </div>
                        <?					
						echo $news_panel;			
					}
				}
				else
				{	
					 ?>
                     <div id="dialog-message" title="News">
                         <p>
                         Podaj tytuł newsa</b></p>
                     </div>
                     <?							
					echo $news_panel;	
				}
			}
			elseif(isset($_POST['list']))
			{
				echo '<div id="news_list">';
				if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `news`"))>=1)
				{
					echo "<p>";
					echo "<table boder=\"1\"><tr>";
					echo "<td><strong></strong></td>";
					echo "<td><strong>Nazwa Newsa</strong></td>";
					echo "<td><strong>Autor</strong></td>";
					echo "<td><strong>Data</strong></td>";
					echo "<td><strong>Godzina</strong></td>";
					if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `news` WHERE `edytowany` = 'tak'"))) echo "<td><strong>|Data Edycji|</strong></td>";
					if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `news` WHERE `edytowany` = 'tak'"))) echo "<td><strong>|Godzina Edycji|</strong></td>";
					if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `news` WHERE `edytowany` = 'tak'"))) echo "<td><strong>|Kto Edytowal|</strong></td>";
					echo "<td><strong></strong></td>";
					echo "</tr>";
					
					$wynik = mysqli_query($conn,"SELECT * FROM `news`");		
					while ( $row = mysqli_fetch_row($wynik) ) {
						echo "</tr>";
						echo '<td><button id="'.$row[0].'" name="edytuj_'.$row[0].'" onclick="edytuj('.$row[0].');" >Edycja</button></td>';
						echo "<td>" . $row[1] . "</td>";
						echo "<td>" . $row[3] . "</td>";
						echo "<td>" . $row[4] . "</td>";
						echo "<td>" . $row[5] . "</td>";
						if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `news` WHERE `edytowany` = 'tak'"))) echo "<td>" . $row[7] . "</td>";
						if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `news` WHERE `edytowany` = 'tak'"))) echo "<td>" . $row[8] . "</td>";
						if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `news` WHERE `edytowany` = 'tak'"))) echo "<td>" . $row[9] . "</td>";				
						$id_usun = $row[0]+1;
						echo'<td><button id="'.$id_usun.'" name="usun_'.$id_usun.'" onclick="usun('.$id_usun.');" >Usun</button></td>';
						echo "</tr>";
					}
					echo "</table>";	
					echo $news_list;				
					echo '</div>';
				}
				else
				{
					echo '<p><b>Brak Newsów</b><p>';
					echo $news_list;	
				}
						
			}
			elseif(isset($_POST['wroc']))
			{
				echo'<meta http-equiv="refresh" content="0; url=index.php?panel=wybor" />';	
			}
			elseif(isset($_POST['wroc_news']))
			{
				echo $news_panel;
			}
			elseif($_COOKIE['unt']=="yes")
			{
				?>
                <div id="dialog-message" title="News">
                <p>Podany news zostal usunięty</p>
                </div>  
                <script type="text/javascript">
					document.cookie = "id=NULL;";
					document.cookie = "unt=no";
				</script>            
            	<?	
				echo $news_panel;				
			}
			elseif($ps=="edycja")
			{
					$id_n = $_COOKIE['id'];
					if(isset($_POST['edytuj']))
					{
						if(!empty($_POST['nazwa_news']))
						{
							if(!empty($_POST['tresc_news']))
							{
								$nazwa_news = $_POST['nazwa_news'];
								$tresc_news = $_POST['tresc_news'];
								$data=date("Y-m-d");
								$godzina=date("H:i");
								
								mysqli_query($conn,"UPDATE `news` SET `nazwa_news`='$nazwa_news' WHERE `id`='$id_n'");	
								mysqli_query($conn,"UPDATE `news` SET `tresc_news`='$tresc_news' WHERE `id`='$id'");	
								mysqli_query($conn,"UPDATE `news` SET `edytowany`='tak' WHERE `id`='$id'");	
								mysqli_query($conn,"UPDATE `news` SET `data_edycji`='$data' WHERE `id`='$id'");	
								mysqli_query($conn,"UPDATE `news` SET `godzina_edycji`='$godzina' WHERE `id`='$id'");	
								mysqli_query($conn,"UPDATE `news` SET `kto_edytowal`='$login' WHERE `id`='$id'");	
													
								$nick_logi = $login;
								$gdzie_logi = "Strona newsow";
								$co_logi = "Z edytowal newsa o nazwie $nazwa_news";
								
								include('/home/skymin/public_html/panel/includes/logi.php');
								?>
								<div id="dialog-message" title="News Dodany">
									  <p>
										Właśnie z edytowałeś newsa</b></p>
								 </div>
                                 <script type="text/javascript">
								 	document.cookie = "id=NULL;";
								 </script>
								<?
								echo'<meta http-equiv="refresh" content="2; url=index.php?panel=news" />';	
							}
							else
							{	
								?>
								<div id="dialog-message" title="News">
									  <p>
									  <b> Podaj treść newsa</b></p>
								 </div>
								<?					
								echo $news_edit;			
							}
						}
						else
						{	
							 ?>
							 <div id="dialog-message" title="News">
								 <p>
								 Podaj tytuł newsa</b></p>
							 </div>
							 <?							
							echo $news_edit;	
						}				
					}
					elseif(isset($_POST['wroc_n']))
					{
						?>
                        <script type="text/javascript">
							document.cookie = "id=NULL;";
						</script>
						<?						
						echo'<meta http-equiv="refresh" content="0; url=index.php?panel=news" />';	
					}
					else
					{
						echo $news_edit;
						?>
						<script type="text/javascript">
						<?
							$zapytanie = "SELECT * FROM `news` WHERE `id` = '$id_n'";
							$wynik = mysqli_query($conn,$zapytanie);	
							$row = mysqli_fetch_row($wynik);
							$tytul = $row[1];
							$tresc = $row[2];
							?>
							document.getElementById("nazwa").value = "<? echo $tytul; ?>";
							document.getElementById("tresc").value = "<? echo $tresc; ?>";
						</script>
                        <?						
					}				
			}
			elseif($ps=="usun")
			{
				$id = $_COOKIE['id'];
				mysqli_query($conn,"DELETE FROM `news` WHERE `id`='$id'");	
				?>
				<script type="text/javascript">
					document.cookie = "unt=yes";
				</script>
				<?
				echo'<meta http-equiv="refresh" content="0; url=index.php?panel=news" />';		
			}
			else
			{
				echo $news_panel;	
			}
		}
		else
		{
			echo'<p><b>Nie jesteś moderatorem/administratorem</b></p>';	
			echo '<meta http-equiv="Refresh" content="2; url=http://skymin.pl/" />';
		}
	}
	else
	{
		echo'<p><b>Nie jesteś zalogowany</b></p>';	
		echo '<meta http-equiv="Refresh" content="2; url=http://skymin.pl/" />';
	}
			
?>
<script type="text/javascript">

function edytuj(id_news)
{
	document.cookie = "id="+id_news;
	window.location.replace("index.php?panel=news&ps=edycja");	
}


function usun(id_news)
{
	var r = confirm("Chczesz usunac ten news, jesli tak kliknij ok")
	if(r==true)
	{
		var id = id_news-1;
		document.cookie = "id="+id;
		document.cookie = "unt=no";
		window.location.replace("index.php?panel=news&ps=usun");
	}
}
</script>
