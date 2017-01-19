<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>SkyMin - Strona odbioru kodu</title>
</head>

<body>
<center>
<?php
	$auth = "4d58sf2w7KkjwSi";
	$auth_get = NULL;
	if (array_key_exists('auth', $_GET)) {
		$auth_get = $_GET['auth'];
		if($auth==$auth_get)
		{
			echo '<meta http-equiv="Refresh" content="0; url=https://store.steampowered.com/account/ackgift/7FD2FD6F97A96E4E?redeemer=" />';	
		}
		else
		{
			echo '<p>Kod niepoprawny, spróbuj ponownie</p>';	
		}
	}
	else
	{
		echo '<p>Kod nie został podany</p>';	
	}
	
?>
</center>
</body>
</html>