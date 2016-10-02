<?php
$userid = 438;
$serviceid = 715;
	
class Sms
{	
	function getResponse($code)
	{
		$response = "http://microsms.pl/api/check_multi.php?userid="+$userid+"&code="+$code+"&serviceid="+$serviceid;
	}
}
?>