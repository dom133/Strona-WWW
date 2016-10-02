<script type="text/javascript" src="/home/skymin/public_html/scripts/minecraftquery.js"></script>
<?
require_once '/home/skymin/public_html/mobile/includes/mcformat.php';

$hostname = 'skymin.maxcraft.pl';
$port = 26112;

if ($hostname) {
	$json = file_get_contents("https://mcapi.ca/query/".$hostname.":".$port."/info");
	$data = json_decode($json, true);
}
	
$hostname = htmlspecialchars($hostname);
if($hostname)
{
	if($data['status']==1)
	{
		echo'<p><tr><b><td class="motd">' . MC_parseMotdColors($data['motd']). '</tr></b> jest aktualnie <b>online</b>';
		?>
        <div id="status-progressBar" class="default" title="<? echo $data['players']['online']; ?>/<? echo $data['players']['max']; ?>"><div></div></div>
        <script type="text/javascript">
			status_progressBar("<? echo $data['players']['online']; ?>", "<? echo $data['players']['max']; ?>");
		</script>
        <?
		if($data['players']['online']!=0)
		{
			echo'<p> '.$data['players']['online'].'/'.$data['players']['max'].' <a href="?strona=gracze-online"><b>graczy</b></p></a>';
		}
		else
		{
			echo'<p> '.$data['players']['online'].'/'.$data['players']['max'].' <b>graczy</b></p>';	
		}
	} else {
		echo '<p>Serwer jest <b><font color="red">offline</font></b><p>';
	}
}
else
{
	echo '<p>Adres ip serwera nie jest podany</p>';	
}
?>