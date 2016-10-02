<?php
$strona = '<div data-role="header">
	<h1>Logowanie</h1>
</div>
	<div data-role="content">	
		<center>
			<form action="?strona=logowanie" method="post">
				<input type="text" name="login" placeholder="Login" />
				<input type="password" name="haslo" placeholder="Haslo" />
				<input type="submit" name="zaloguj" value="Zaloguj" />
			</form>
			<a href="#" class="ui-btn" data-rel="back">Wróć</a>
		</center>    	
	</div>
<div data-role="footer">
	<h4>SkyMin© 2014</h4>
</div>			
';

if(!isset($_COOKIE['session_id']))
{
	echo $strona;
}
?>	


