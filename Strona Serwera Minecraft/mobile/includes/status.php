<?php
require_once '/home/skymin/public_html/mobile/includes/mcstat.php';
require_once '/home/skymin/public_html/mobile/includes/mcformat.php';

$hostname = '37.187.24.145';
$port = 25586;

if ($hostname) {
	$m = new MinecraftStatus($hostname, $port);
	$status = $m->ping();
	
	
}
	
$hostname = htmlspecialchars($hostname);
	
if ($hostname) {
	if ($status) {
		?>
        <style type="text/css">
			#gracze_text
			{
			   color:#000000;
			   text-decoration:none;
			}
			#gracze_text:hover
			{
			   color:#000000;
			   text-decoration:underline;
			}
		</style>
        <?php
		echo '<div id="status">';
		echo'<p>Serwer <tr><td class="motd">' . MC_parseMotdColors($status['motd']). '</tr> jest aktualnie <font color="lime">online</font>. Na serwerze jest '.$status['player_count'].'/'.$status['player_max'].' <a onclick="gracze()" alt="" title="" id="gracze_text">graczy</a>. Ping wynosi '.$status['latency'].' ms.</p>';
		echo'</div>';
		echo '<div id="gracze"></div>';	
		?>
        <script type="text/javascript">
		document.cookie="roz=false";
						
		function gracze()
		{	
			function readCookie(name) {
				var nameEQ = name + "=";
				var ca = document.cookie.split(';');
				for(var i=0;i < ca.length;i++) {
					var c = ca[i];
					while (c.charAt(0)==' ') c = c.substring(1,c.length);
					if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
				}
				return null;
			}
			
			
			if(readCookie("roz")=="true")
			{
				document.cookie="roz=false";
				document.getElementById("gracze").innerHTML = "";
					
			}
			else 
			{
				document.cookie="roz=true";
				
				
				<?php
				if($status['player_count']==0)
				{
					echo 'document.getElementById("gracze").innerHTML = "<p><b>Brak graczy online</b></p>";';
				}
				else
				{
					 $zapytanie = mysqli_query($conn,"SELECT * FROM players WHERE `online` = '1';");
					 $tabela = '<table><tr><th>Nick</th><th>Czas gry</th><th></th></tr>';
					 while ( $row = mysqli_fetch_row($zapytanie) ) {
							if($row[12]>=60) $row[12] = round($row[12]/60, 1)."min";
							elseif($row[12]<60) $row[12] = $row[12]."sec";
							elseif($row[12]>=3600) $row[12] = round($row[12]/3500, 1)."godz";
							
							$tabela = $tabela.'<tr><td>'.$row[1].'</td><td>'.$row[12].'</td></tr>';
						}	
					 echo 'document.getElementById("gracze").innerHTML = "'.$tabela.'"';
					 	
				}
					
				?>		
			}
			
				
		}
			
        </script>
        <?php
			
	} else {
		echo 'Serwer jest <b><font color="red">offline</font></b>';
	}
}
?>