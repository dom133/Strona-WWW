<div class="container">
<script type="text/javascript">
var navbar_top = document.getElementById("glowna");
navbar_top.classList.remove("active");
</script>
<?php
include 'mail.php';

function GenRandom($howlong) 
{ 
	$chars = "abcdefghijklmnoprstuwxyzq"; 
	$chars .= "ABCDEFGHIJKLMNOPRSTUWZYXQ"; 
	$chars .= "1234567890"; 
	$pass = ""; 
	$len = strlen($chars) - 1; 
	$output = "";
	for($i =0; $i < $howlong; $i++) 
	{ 
		$random = rand(0, $len); 
		$output .=  $chars[$random]; 
	} 
	return $output; 
}; 

$formularz = "
<form class=\"form-horizontal\" role=\"form\" action=\"zarejestruj\" method=\"post\">
	<div class=\"panel panel-default\" style=\"color: black; margin:40px;\">
		<div class=\"panel-heading\">
			<h3 class=\"panel-title\">Rejestracja</h3>
		</div>
	<div class=\"panel-body\">
	   <div class=\"form-group\">
		<label for=\"inputEmail3\" class=\"col-sm-2 control-label\">Nick</label>
		<div class=\"col-sm-10\">
		  <input type=\"text\" class=\"form-control\" name=\"nick\" placeholder=\"Podaj nick\">
		</div>
	  </div>
	  <div class=\"form-group\">
		<label for=\"inputEmail3\" class=\"col-sm-2 control-label\">Email</label>
		<div class=\"col-sm-10\">
		  <input type=\"email\" class=\"form-control\" name=\"email\" placeholder=\"Podaj adres email\">
		</div>
	  </div>
	  <div class=\"form-group\">
		<label for=\"haslo\" class=\"col-sm-2 control-label\">Hasło</label>
		<div class=\"col-sm-10\">
		  <input type=\"password\" class=\"form-control\" name=\"haslo\" placeholder=\"Podaj haslo\">
		</div>
	  </div>
	  <div class=\"form-group\">
		<label for=\"haslo\" class=\"col-sm-2 control-label\">Powtórz hasło</label>
		<div class=\"col-sm-10\">
		  <input type=\"password\" class=\"form-control\" name=\"haslo_powtorz\" placeholder=\"Powtórz hasło\">
		</div>
	  </div>
	  <div class=\"form-group\">
		<div class=\"col-sm-offset-2 col-sm-10\">
		  <div class=\"checkbox\">
			<label>
			  <input type=\"checkbox\" name=\"regulamin\"> Akceptujesz regulamin
			</label>
		  </div>
		</div>
	  </div>
		  <input type=\"submit\" name=\"zarejestruj\" value=\"Zarejestruj\" class=\"btn btn-success btn-lg btn-block\">
	  </div>
	</div>
</form>
";
if(!isset($_COOKIE['session_id']))
{
	if(!empty($_POST['zarejestruj']))
	{
		$nick = addslashes(htmlspecialchars($_POST['nick']));
		$haslo = addslashes(htmlspecialchars($_POST['haslo']));
		$haslo2 = addslashes(htmlspecialchars($_POST['haslo_powtorz']));
		$email = addslashes(htmlspecialchars($_POST['email']));		
		if(empty($nick))
		{
			?>
			<script type="text/javascript">
				alerts("alert", "Nie podałeś/aś nicku!", "warning");
			</script>
			<?php	
		}
		else if(mysqli_fetch_row(mysqli_query($conn,"SELECT * FROM authme WHERE `username` = '$nick';"))>1)
		{
			?>
			<script type="text/javascript">
				alerts("alert", "Podany nick jest już zajęty!", "warning");
			</script>
			<?php
		}
		else if(empty($email))
		{
			?>
			<script type="text/javascript">
				alerts("alert", "Nie podałeś/aś adresu email!", "warning");
			</script>
			<?php	
		}
		else if(mysqli_fetch_row(mysqli_query($conn,"SELECT * FROM authme WHERE `email` = '$email';"))>1)
		{
			?>
			<script type="text/javascript">
				alerts("alert", "Podany adres email jest już zajęty!", "warning");
			</script>
			<?php				
		}
		else if(empty($haslo))
		{
			?>
			<script type="text/javascript">
				alerts("alert", "Nie podałeś hasła!", "warning");
			</script>
			<?php		
		}
		else if(empty($haslo2))
		{
			?>
			<script type="text/javascript">
				alerts("alert", "Nie powtórzyłeś hasła!", "warning");
			</script>
			<?php				
		}
		else if($haslo!=$haslo2)
		{
			?>
			<script type="text/javascript">
				alerts("alert", "Podane hasła są różne!", "warning");
			</script>
			<?php					
		}
		else if(!isset($_POST['regulamin']))
		{
			?>
			<script type="text/javascript">
				alerts("alert", "Aby kontynuować musisz zaakceptować regulamin!", "warning");
			</script>
			<?php				
		}
		else 
		{							
			$haslo_zakodowane = hash("SHA512", $haslo);										
			$klucz = GenRandom(50);	
			mysqli_query($conn,"INSERT INTO authme (username, password, email)
			VALUES ('$nick', '$haslo_zakodowane', '$email')");		
			$zapytanie = mysqli_query($conn,"SELECT * FROM `authme` WHERE `username` = '$nick';");	
			$id = mysqli_fetch_row($zapytanie);				
			mysqli_query($conn,"INSERT INTO users (user, Poziom, Klucz_a, Aktywne, id_account, nick)
			VALUES ('$nick', '0', '$klucz', 'nie', '$id[0]', '$nick')");
											
			$wiadomosc = '<html><head><meta charset="utf-8"></head><body><p><b>Witaj '.$nick.',
Dziekujemy ze sie zarejstrowales/as, aby aktywowac konto wejdz na </b></p><a href="http://www.skymin.pl/index.php?strona=aktywacja&kod='.$klucz.'">http://www.skymin.pl/index.php?strona=aktywacja&kod='.$klucz.'</a>
</body></html>';			
			$error = sendMail($email, "Rejestracja na SkyMin", $wiadomosc);
			
			if($error)
			{
				?>
				<script type="text/javascript">
					alerts("alert", "Konto zostało utworzone pomyślnie, na podany email został wysłany link aktywacyjny", "success");
				</script>
				<?php	
			} else {
				?>
				<script type="text/javascript">
					alerts("alert", "Wystąpił błąd podczas próby wysłania emailu, ale konto zostało utworzone: <?php echo $error; ?>", "warning");
				</script>
				<?php		
			}
		}
		echo $formularz;	
	}
	else
	{
		echo $formularz;
	}
}
else
{
	?>
    <script type="text/javascript">
		alerts("alert", "Posiadasz już konto!", "warning");
		var navbar_top = document.getElementById("glowna");
		navbar_top.classList.add("active");
</script>
    <?php
	include('includes/glowna.php');	
}
?>
</div>