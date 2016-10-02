<div class="container">
<?php
$formularz = '
	<form class="form-horizontal" role="form" action="edycja_profilu" method="post">
		<div class="panel panel-default" style="color: black; margin:40px;">
		  <div class="panel-heading">
			<h3 class="panel-title">Konto WEB</h3>
		  </div>
		  <div class="panel-body">
		  	  <div id="nick-div" class="form-group">
				<label for="nick" class="col-sm-2 control-label">Nick</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="nick" placeholder="Podaj nowy nick">
				</div>
			  </div>
			  <div id="email-div" class="form-group">
				<label for="inputEmail" class="col-sm-2 control-label">Email</label>
				<div class="col-sm-10">
				  <input type="email" class="form-control" name="email" placeholder="Podaj nowy adres email">
				</div>
			  </div>
			  <div id="haslo-div" class="form-group">
				<label for="haslo" class="col-sm-2 control-label">Haslo</label>
				<div class="col-sm-10">
				  <input type="password" class="form-control" name="haslo" placeholder="Podaj nowe haslo">
				</div>
			  </div>
			  <div id="haslo2-div" class="form-group">
				<label for="haslo2" class="col-sm-2 control-label">Powtorz haslo</label>
				<div class="col-sm-10">
				  <input type="password" class="form-control" name="haslo2" placeholder="Powtorz haslo">
				</div>
			  </div>
			  <input type="submit" name="edytuj-web" value="Edytuj" class="btn btn-success btn-lg btn-block">
		  </div>
		</div>
		<div class="panel panel-default" style="color: black; margin:40px;">
		  <div class="panel-heading">
			<h3 class="panel-title">Konto Mojang</h3>
		  </div>
		  <div class="panel-body">
			  <div id="login-div" class="form-group">
				<label for="login" class="col-sm-2 control-label">Login</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="haslo" placeholder="Podaj login do konta mojang">
				</div>
			  </div>
			  <div id="haslo-mojang-div" class="form-group">
				<label for="haslo-mojang" class="col-sm-2 control-label">Hasło</label>
				<div class="col-sm-10">
				  <input type="password" class="form-control" name="haslo-mojang" placeholder="Podaj hasło">
				</div>
			  </div>
			  <div id="haslo-szyfrowanie-div" class="form-group">
				<label for="haslo-mojang" class="col-sm-2 control-label">Hasło do szyfrowania</label>
				<div class="col-sm-10">
				  <input type="password" class="form-control" name="haslo-szyfrowanie" placeholder="Podaj hasło do szyfrowania">
				</div>
			  </div>
			  <input type="submit" name="edytuj-minecraft" value="Edytuj" class="btn btn-success btn-lg btn-block">
		  </div>
		</div>
	</form>';
	
if(isset($_COOKIE['session_id']))
{	
	if(!empty($_POST['edytuj-web'])) {
		if(empty($_POST['email'])) {
			if(empty($_POST['haslo'])) {
				  echo $formularz;
			}
			else {
				if(empty($_POST['haslo2']))
				{
					?>
					<script type="text/javascript">
                        alerts("alert", "Pole powtórz hasło jest puste", "warning");
                    </script>
                	<?php	
					echo $formularz;
				} else {
					if($_POST['haslo']!=$_POST['haslo2'])
					{
						?>
						<script type="text/javascript">
                            alerts("alert", "Podane hasła się róźnią", "warning");
                        </script>
                    	<?php	
						echo $formularz;
					} else {
						$haslo = hash("SHA512", addslashes(htmlspecialchars($_POST['haslo'])));
						$cookie = $_COOKIE['session_id'];
						$zapytanie = mysqli_query($conn,"SELECT * FROM `users` WHERE `Session_id` = '$cookie';");
						$id = mysqli_fetch_row($zapytanie);
						mysqli_query($conn, "UPDATE `authme` SET `password`='$haslo' WHERE `id`='$id[9]';");
						
						?>
						<script type="text/javascript">
							alerts("alert", "Hasło zostało poprawnie edytowane", "success");
						</script>
					  	<?php	
					  	echo $formularz;
					}	
				}
			}
		}
		else {
			if(empty($_POST['haslo'])) {
					$email = $_POST['email'];
					$cookie = $_COOKIE['session_id'];
					$zapytanie = mysqli_query($conn,"SELECT * FROM `users` WHERE `Session_id` = '$cookie';");
					$id = mysqli_fetch_row($zapytanie);
				    mysqli_query($conn, "UPDATE `authme` SET `email`='$email' WHERE `id`='$id[9]';");
					
					?>
					<script type="text/javascript">
                        alerts("alert", "Adres email został poprawnie edytowany", "success");
                    </script>
               	  <?php	
				  echo $formularz;
			}
			else {
				if(empty($_POST['haslo2']))
				{
					?>
					<script type="text/javascript">
                        alerts("alert", "Pole powtórz hasło jest puste", "warning");
                    </script>
                	<?php	
					echo $formularz;
				} else {
					if($_POST['haslo']!=$_POST['haslo2'])
					{
						?>
						<script type="text/javascript">
                            alerts("alert", "Podane hasła się róźnią", "warning");
                        </script>
                    	<?php	
						echo $formularz;
					} else {
						$email = $_POST['email'];
						$haslo = hash("SHA512", addslashes(htmlspecialchars($_POST['haslo'])));
						$cookie = $_COOKIE['session_id'];
						$zapytanie = mysqli_query($conn,"SELECT * FROM `users` WHERE `Session_id` = '$cookie';");
						$id = mysqli_fetch_row($zapytanie);
						mysqli_query($conn, "UPDATE `authme` SET `email`='$email' WHERE `id`='$id[9]';");
						mysqli_query($conn, "UPDATE `authme` SET `password`='$haslo' WHERE `id`='$id[9]';");
						
						?>
						<script type="text/javascript">
							alerts("alert", "Adres email i hasło zostały poprawnie edytowane", "success");
						</script>
					  	<?php	
					  	echo $formularz;
					}	
				}
			}
		}
	}
	else { echo $formularz; }	
} else {
	?>
    	<script type="text/javascript">
			alerts("alert", "Nie jesteś zalogowany!!!", "warning");
			zmien_title("Strona Główna | SkyMin - Strona Serwera Minecraft", "title");
        </script>
    <?php
	include('includes/glowna.php');	
}
?>
</div>