<?php
if(isset($_COOKIE['session_id']))
{
	
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