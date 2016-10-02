<?php
date_default_timezone_set("Europe\Warsaw");
$response = array();

if (isset($_POST['type']) && isset($_POST['nick']) && isset($_POST['email']) && isset($_POST['title']) && isset($_POST['contents']) && isset($_POST['version'])) {
 
    $type = addslashes(htmlspecialchars($_POST['type']));
    $nick = addslashes(htmlspecialchars($_POST['nick']));
    $email = addslashes(htmlspecialchars($_POST['email']));
    $title = addslashes(htmlspecialchars($_POST['title']));
    $contents = addslashes(htmlspecialchars($_POST['contents']));
    $date = date('d.m.Y');
    $time = date('H:i');
    $version = $_POST['version'];
 
    include 'mysql.php';
    $result = mysqli_query($conn ,"INSERT INTO raporty(type, nick, email, title, contents, date, time, version, enabled, source) VALUES('$type', '$nick', '$email', '$title', '$contents', '$date', '$time', '$version', 'true', 'app')");
 
    if ($result) {
        $response["success"] = 1;
        $response["message"] = "Poprawnie przyjeto zgloszenie!!!";
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