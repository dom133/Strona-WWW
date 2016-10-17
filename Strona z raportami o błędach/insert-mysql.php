<?php
date_default_timezone_set("Europe\Warsaw");
$response = array();

include 'mail.php'

$wiadomosc = '<html><head><meta charset="utf-8"></head><body><p><b>Witaj,
Dziekujemy ze zgloszenie, aby edytowac zgloszenie wejdz na <a href="http://app-updater.pl/?action=edit&key="></b></p>
</body></html>';    
    
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

if (isset($_POST['type']) && isset($_POST['nick']) && isset($_POST['email']) && isset($_POST['title']) && isset($_POST['contents']) && isset($_POST['version'])) {
 
    $type = addslashes(htmlspecialchars($_POST['type']));
    $nick = addslashes(htmlspecialchars($_POST['nick']));
    $email = addslashes(htmlspecialchars($_POST['email']));
    $title = addslashes(htmlspecialchars($_POST['title']));
    $contents = addslashes(htmlspecialchars($_POST['contents']));
    $date = date('d.m.Y');
    $time = date('H:i');
    $version = $_POST['version'];
    $authKey = GenRandom(50);
 
    include 'mysql.php';
    $result = mysqli_query($conn ,"INSERT INTO raporty(type, nick, email, title, contents, date, time, version, enabled, source, authKey) VALUES('$type', '$nick', '$email', '$title', '$contents', '$date', '$time', '$version', 'true', 'app', '$authKey')");
    
    $wiadomosc = '<html><head><meta charset="utf-8"></head><body><p><b>Witaj,
Dziekujemy ze zgloszenie, aby edytowac zgloszenie wejdz na <a href="http://app-updater.pl/?action=edit&key='.$authKey.'">http://app-updater.pl/?action=edit&key='.$authKey.'</a></b></p>
</body></html>';    
    
    
    if ($result) {
        $response["success"] = 1;
        $response["message"] = "Poprawnie przyjeto zgloszenie!!!";
        $error = sendMail($email, "Zgłoszenie na App-updater", $wiadomosc)
        echo json_encode($response);
    } else {
        $response["success"] = 0;
        $response["message"] = "Wystapil blad!!!";
        echo json_encode($response);
    }
} else {
    $response["success"] = 0;
    $response["message"] = "Brakuje potrzebnych parametrow!!!";
    echo json_encode($response);
}
?>