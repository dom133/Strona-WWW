<?php	
include('/home/skymin/public_html/mysql-polaczenie.php');
error_reporting(E_ERROR | E_PARSE | E_WARNING);

$user = new user;
$user->apikey = "954B505E2F8D45E88587CA4613EDC96E"; // put your API key here
$user->domain = "panel.skymin.pl"; // put your domain	
class user
{
    public static $apikey;
    public static $domain;
	
	public function GenRandom($howlong) 
	{ 
		$chars = "abcdefghijklmnoprstuwxyzq"; 
		$chars .= "ABCDEFGHIJKLMNOPRSTUWZYXQ"; 
		$chars .= "1234567890"; 
		$pass = ""; 
		$len = strlen($chars) - 1; 
		for($i =0; $i < $howlong; $i++) 
		  { 
		   $random = rand(0, $len); 
		
			   $output .=  $chars[$random]; 
		   } 
		return $output; 
	}
	
    public function GetPlayerSummaries ($steamid)
    {
        $response = file_get_contents('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=' . $this->apikey . '&steamids=' . $steamid);
        $json = json_decode($response);
        return $json->response->players[0];
    }

    public function signIn ()
    {
		?>
		<script type="text/javascript">
        document.getElementById("formularz").innerHTML = "<p>Trwa pozyskiwanie potrzebnych danych</p>";
        </script>
        <?		
        require_once 'openid.php';
        $openid = new LightOpenID($this->domain);// put your domain
        if(!$openid->mode)
        {
            $openid->identity = 'http://steamcommunity.com/openid';
			echo '<meta http-equiv="Refresh" content="0; url='.$openid->authUrl().'" />';
        }
        elseif($openid->mode == 'cancel')
        {
            print ('Użytkownik anulował autoryzacje!');
        }
        else
        {
            if($openid->validate())
            {
                preg_match("/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/", $openid->identity, $matches); // steamID: $matches[1]
				$id = $matches[1];
				$zapytanie = mysqli_query($conn,"SELECT * FROM `autoryzacja` WHERE `steamID` = '$matches[1]'");
				if(mysqli_num_rows($zapytanie)>=1)
				{
					$zapytanie = mysqli_query($conn,"SELECT * FROM `autoryzacja` WHERE `steamID` = '$id';");
					$row = mysqli_fetch_row($zapytanie);			
					$session_id = $this->GenRandom(30);
					
					echo '<script type="text/javascript">';
					echo 'document.cookie = "session_id='.$session_id.'; path=/; domain=.skymin.pl";';
					echo 'document.cookie = "akt_komunikat=false; path=/; domain=.skymin.pl";';
					echo 'document.cookie = "email_komunikat=false; path=/; domain=.skymin.pl";';		
					echo '</script>';	
					
					mysqli_query($conn,"UPDATE `autoryzacja` SET `Session_id`='$session_id' WHERE `steamID`='$id'");
					
					?>
					<script type="text/javascript">
					document.getElementById("formularz").innerHTML = "<p></p>";
					</script>
					<?								
					echo '<meta http-equiv="Refresh" content="0; url=index.php" />';
                	exit;
				}
				else
				{	
					?>
					<script type="text/javascript">
					document.getElementById("formularz").innerHTML = "<p>Uzytkownik steam nie jest podpiety pod zadne konto gracza</p>";
					</script>
					<?
					echo '<meta http-equiv="Refresh" content="2; url=http://www.skymin.pl" />';
					exit;
						
				}
            }
            else
            {
                print ('fail');
            }
        }
    }
}
	
	if(isset($_GET['auth']))
	{
		echo '<div id="formularz"></div>'; 
		$user->signIn();
	}	

?>