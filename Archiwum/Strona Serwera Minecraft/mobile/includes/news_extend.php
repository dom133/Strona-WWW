<?php
	$id1 = $_GET['id'];
	if($id1==NULL | empty($id1))
	{
		echo'<p><b>Podany id jest nieprawidłowy</b></p>';
	}
	else
	{
		$zapytanie = mysqli_query($conn,"SELECT * FROM `news` WHERE `id` = '$id1' "); 
		if(mysqli_num_rows($zapytanie)>=1)
		{  	
			while ( $row = mysqli_fetch_row($zapytanie) ) {
				echo'<p>'.$row[1].'</p>';
				echo'<p>Autor: '.$row[3].'</p>';
				echo'<p>Data Publikacji: '.$row[4].' '.$row[5].'</p>';
				$zapytanie1 = mysqli_query($conn,"SELECT * FROM `news` WHERE `id` = '$id1' AND `edytowany`='tak' "); 
				if(mysqli_num_rows($zapytanie1)>=1) echo '<p>News Edytowany Przez: '.$row[9].'<p>';
				echo'<b><p>'.$row[2].'</p></b>';
				?>
				<div id="disqus_thread"></div>
		<script type="text/javascript">
			/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
			var disqus_shortname = 'skymin1'; // required: replace example with your forum shortname
	
			/* * * DON'T EDIT BELOW THIS LINE * * */
			(function() {
				var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
				dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
				(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
			})();
		</script>
		<noscript>Please enable JavaScript to view the</noscript>    
				<?php
			}
		}
		else
		{
			echo'<p><b>Podany news nie istnieje</b></p>';	
		}
	}
		
?>