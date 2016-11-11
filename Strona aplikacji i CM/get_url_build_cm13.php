<?php
$searchfor = '/get/jenkins/';

function getCM($string) {
    $doc = new DOMDocument('1.0');
    $doc->loadHTML($string);
    foreach($doc->getElementsByTagName('a') AS $div) {
        $string = $div->getAttribute('href');
    }
    $name = explode("/",$string)[4];
    return explode("-", $name)[1];
}

function getJenkins($string) {
    $doc = new DOMDocument('1.0');
    $doc->loadHTML($string);
    foreach($doc->getElementsByTagName('a') AS $div) {
        $string = $div->getAttribute('href');
    }
    return explode("/",$string)[3];
}

function getCMDate($string) {
    $doc = new DOMDocument('1.0');
    $doc->loadHTML($string);
    foreach($doc->getElementsByTagName('a') AS $div) {
        $string = $div->getAttribute('href');
    }    
    $name = explode("/",$string)[4];
    return explode("-", $name)[2];
}

header('Content-Type: text/plain');
$contents = file_get_contents('https://download.cyanogenmod.org/?device=w5');
$pattern = preg_quote($searchfor, '/');
$pattern = "/^.*$pattern.*\$/m";

if(preg_match_all($pattern, $contents, $matches)){
   $str = implode("\n", $matches[0]);
}
$i = 0;
$lines = explode("\n", $str);
while(true) {
    if(getCM($lines[$i])=="13.0") {
        $jenkinsID = getJenkins($lines[$i]);
        $cm = getCm($lines[$i]);
        $date = getCMDate($lines[$i]);
        break;
    } else {$i++;}
}

echo "JenkinsID: ".$jenkinsID." CM: ".$cm." Date: ".$date;

shell_exec('echo '.$jenkinsID.' > /var/www/html/updates/txt/jenkins_id_cm13.txt');
shell_exec('echo '.$date.' > /var/www/html/updates/txt/date_cm13.txt');

?>