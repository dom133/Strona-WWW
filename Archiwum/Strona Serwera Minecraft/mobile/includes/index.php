<div data-role="page" id="page">
	<div data-role="header">
		<h1>SkyMin - Strona Mobilna</h1>
	</div>
	<div data-role="content">	
		<ul data-role="listview">
			<li><a href="#news">News</a></li>
            <li><a href="#stats">Statystyki</a></li>
			<li><a href="#status">Status Serwera</a></li>
            <?
			if(!isset($_COOKIE['session_id']))
			{
            	echo '<li><a href="#login">Logowanie</a></li>';
			}
			else
			{
				echo '<li><a href="?strona=wyloguj">Wyloguj</a></li>';	
			}
			?>
		</ul>		
	</div>
	<div data-role="footer">
		<h4>SkyMin© 2014</h4>
	</div>
</div>

<div data-role="page" id="news">
	<div data-role="header">
		<h1>News</h1>
	</div>
	<div data-role="content">	
    	<center>	
		<?php	
			$id = NULL;
			if (array_key_exists('id', $_GET)) {
				$id = $_GET['id'];
			}
			
			if($id!=NULL)
			{
				include('includes/news_extend.php');		
			}
			else
			{
				include('includes/news.php');	
			}
		?>
        </center>
        <a href="#" class="ui-btn" data-rel="back">Wróć</a>	
	</div>
	<div data-role="footer">
		<h4>SkyMin© 2014</h4>
	</div>
</div>

<div data-role="page" id="stats">
	<div data-role="header">
		<h1>Statystyki</h1>
	</div>
	<div data-role="content">
    	<center>	
			<?php
				include('includes/statystyki.php');
			?>
        </center>	
        <a href="#" class="ui-btn" data-rel="back">Wróć</a>		
	</div>
	<div data-role="footer">
		<h4>SkyMin© 2014</h4>
	</div>
</div>

<div data-role="page" id="status">
	<div data-role="header">
		<h1>Status Serwera</h1>
	</div>
	<div data-role="content">	
    <center>
    <?php
		include 'includes/status.php';
	?>
    <a href="#" class="ui-btn" data-rel="back">Wróć</a>
    </center>    	
	</div>
	<div data-role="footer">
		<h4>SkyMin© 2014</h4>
	</div>
</div>

<div data-role="page" id="login">
    <?php
		include 'includes/logowanie.php';
	?>
</div>