<?php
$get = addslashes($_GET['strona']);
 
switch($get) {
		case '':
			include('includes/glowna.php');
		?>
		<script type="text/javascript">
			zmien_title("Strona Główna | SkyMin - Strona Serwera Minecraft", "title");
		</script>
		<?
		break;
			
	case 'launcher':
		include('includes/launcher.php');
	?>
    <script type="text/javascript">
		zmien_title("Strona Launchera | SkyMin - Strona Serwera Minecraft", "title");
	</script>
    <?		
	break;	
	
	case 'forum':
		include('includes/forum.php');
	?>
    <script type="text/javascript">
		zmien_title("Strona Forum | SkyMin - Strona Serwera Minecraft", "title");
	</script>
    <?
	break;	
		
	case 'statystyki':
		include('includes/statystyki.php');
	?>
    <script type="text/javascript">
		zmien_title("Statystyki Graczy | SkyMin - Strona Serwera Minecraft", "title");
	</script>
    <?
	break;
		
	case 'rejestracja':
		include('includes/rejestracja.php');
	?>
    <script type="text/javascript">
		zmien_title("Strona Rejestracji | SkyMin - Strona Serwera Minecraft", "title");
	</script>
    <?
	break;	
	
	case 'aktywacja':
		include('includes/aktywacja.php');
	?>
    <script type="text/javascript">
		zmien_title("Strona Aktywacji Konta | SkyMin - Strona Serwera Minecraft", "title");
	</script>
    <?
	break;	
	
	case 'steam':
		include('includes/steam_login.php');
	?>
    <script type="text/javascript">
		zmien_title("Logowanie Steam | SkyMin - Strona Serwera Minecraft", "title");
	</script>
    <?
	break;		
	
	case 'logowanie';
		include('includes/logowanie.php');
	?>
    <script type="text/javascript">
		zmien_title("Strona Główna | SkyMin - Strona Serwera Minecraft", "title");
	</script>
    <?
	break;
	
	case 'wyloguj';
		include('includes/wyloguj.php');
	?>
    <script type="text/javascript">
		zmien_title("Strona Główna | SkyMin - Strona Serwera Minecraft", "title");
	</script>
    <?
	break;	
	
	case 're-kod_aktywacyjny';
		include('includes/re-kod_aktywacyjny.php');
	?>
    <script type="text/javascript">
		zmien_title("Ponowna Aktywacja Konta | SkyMin - Strona Serwera Minecraft", "title");
	</script>
    <?
	break;
	
	case 'profil';
		include('includes/profil.php');
	?>
    <script type="text/javascript">
		zmien_title("Podgląd profilu | SkyMin - Strona Serwera Minecraft", "title");
	</script>
    <?
	break;
	
	case 'avatar';
		include('includes/avatars.php');
	?>
    <script type="text/javascript">
		zmien_title("Upload Avatarów | SkyMin - Strona Serwera Minecraft", "title");
	</script>
    <?
	break;
	
	case 'edycja';
		include('includes/edycja.php');
	?>
    <script type="text/javascript">
		zmien_title("Edycja Danych | SkyMin - Strona Serwera Minecraft", "title");
	</script>
    <?
	break;
}
?>