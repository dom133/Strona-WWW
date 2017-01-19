<?php
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
<div class=\"container\">
	<form class=\"form-horizontal\" role=\"form\" action=\"zaloguj\" method=\"post\">
	   <div class=\"panel panel-default\" style=\"color: black; margin:40px;\">
		  <div class=\"panel-heading\">
			<h3 class=\"panel-title\">Logowanie</h3>
		  </div>
		  <div class=\"panel-body\">
			   <div class=\"form-group\">
				<label for=\"inputEmail3\" class=\"col-sm-2 control-label\">Login</label>
				<div class=\"col-sm-10\">
				  <input type=\"text\" class=\"form-control\" name=\"login\" placeholder=\"Podaj login\">
				</div>
			  </div>
			  <div class=\"form-group\">
				<label for=\"haslo\" class=\"col-sm-2 control-label\">Hasło</label>
				<div class=\"col-sm-10\">
				  <input type=\"password\" class=\"form-control\" name=\"haslo\" placeholder=\"Podaj haslo\">
				</div>
			  </div>
			  <input type=\"submit\" name=\"zaloguj\" value=\"Zaloguj\" class=\"btn btn-success btn-lg btn-block\">
		  </div>
		</div>
	</form>
</div>";

if(!isset($_COOKIE['session_id']))
{
	if(!empty($_POST['login_button']) || !empty($_POST['zaloguj']))
	{
		if(empty($_POST['login']))
		{
?>
		<script type="text/javascript">
			alerts("alert", "Pole login jest puste!", "warning");
			zmien_title("Strona Logowania | SkyMin - Strona Serwera Minecraft", "title");
			var navbar_top = document.getElementById("glowna");
			navbar_top.classList.remove("active");
        </script>
<?php			
			echo $formularz;
		}
		else if(empty($_POST['haslo']))
		{
?>
		<script type="text/javascript">
			alerts("alert", "Pole haslo jest puste!", "warning");
			zmien_title("Strona Logowania | SkyMin - Strona Serwera Minecraft", "title");
			var navbar_top = document.getElementById("glowna");
			navbar_top.classList.remove("active");			
        </script>
<?php
			echo $formularz;
		}
		else
		{
			$loginzbazy = ""; 
			$haslozbazy = ""; 
			
			$login = addslashes(htmlspecialchars($_POST['login'])); 
			$haslo = hash("SHA512", addslashes(htmlspecialchars($_POST['haslo'])));
			
			$zapytanie = mysqli_query($conn,"SELECT * FROM `users` WHERE `User` = '$login';");
			$id = mysqli_fetch_row($zapytanie);
			$loginzbazy = $id[1];
			$zapytanie = mysqli_query($conn,"SELECT * FROM `authme` WHERE `id` = '$id[9]' AND `password` = '$haslo';");
		   while ($zapytanie && $rekord = mysqli_fetch_assoc($zapytanie)) { 
			  $haslozbazy = $rekord['password']; 
		   }
		   
		   if($login!=$loginzbazy | $haslo!=$haslozbazy)
		   {
			   	?>
					<script type="text/javascript">
						alerts("alert", "Login lub/i hasło jest nie prawidłowy!", "warning");
						zmien_title("Strona Logowania | SkyMin - Strona Serwera Minecraft", "title");
						var navbar_top = document.getElementById("glowna");
						navbar_top.classList.remove("active");	
					</script>
				<?php	
				echo $formularz;
				
		   } else if($login==$loginzbazy && $haslo==$haslozbazy) {		
				$session_id = GenRandom(30);			
				setcookie("session_id", $session_id);
				mysqli_query($conn, "UPDATE `users` SET `Session_id`='$session_id' WHERE `User`='$loginzbazy'");	
				$wynik = mysqli_query($conn, "SELECT * FROM `users` WHERE `Session_id` = '$session_id'");	
				$row = mysqli_fetch_row($wynik);
				if($row[2]>=1)
				{
					if($row[5]!="")
					{
						?><script type="text/javascript">change_login_form("login_form", "<?php echo $row[1]; ?>", "true", "login", "<?php echo $row[5]; ?>");</script><?php
					}
					else
					{
						?><script type="text/javascript">change_login_form("login_form", "<?php echo $row[1]; ?>", "true", "login", "https://mcapi.ca/avatar/2d/<?php echo $row[1]; ?>");</script><?php
					}
				}
				else
				{
					if($row[5]!="")
					{
						?><script type="text/javascript">change_login_form("login_form", "<?php echo $row[1]; ?>", "false", "login", "<?php echo $row[5]; ?>");</script><?php
					}
					else
					{
						?><script type="text/javascript">change_login_form("login_form", "<?php echo $row[1]; ?>", "false", "login", "https://mcapi.ca/avatar/2d/<?php echo $row[1]; ?>");</script><?php
					}
				}
				
				?>
				<script type="text/javascript">
                    zmien_title("Strona Główna | SkyMin - Strona Serwera Minecraft", "title");
					var navbar_top = document.getElementById("glowna");
					navbar_top.classList.add("active");
                </script>
            	<?php
				include('includes/glowna.php');				   
		   }
		   else
		   {
				?>
					<script type="text/javascript">
						alerts("alert", "Wysąpił nieoczekiwany błąd!", "warning");
						zmien_title("Strona Logowania | SkyMin - Strona Serwera Minecraft", "title");
						var navbar_top = document.getElementById("glowna");
						navbar_top.classList.remove("active");	
					</script>
				<?php	
				echo $formularz;		   
		   }
		}
	}
} else {
	?>
    	<script type="text/javascript">
			alerts("alert", "Jesteś już zalogowany!", "warning");
			zmien_title("Strona Główna | SkyMin - Strona Serwera Minecraft", "title");
        </script>
    <?php
	include('includes/glowna.php');
}
?>