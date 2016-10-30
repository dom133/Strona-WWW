<?php
$file = fopen("/var/www/html/includes/links.txt", "r")or exit("Unable to open file!");
$date = null;
$cm = null;
$i = 0;

while(!feof($file)){
    $line = preg_replace('/\s+/', '', fgets($file));
    switch($i) {
        case 0: {$i++;break;}
        case 1: {$date = $line; $i++; break;}
        case 2: {$cm = $line; $i++; break;}
        case 3: {  
            if($cm="cm13"){$cm="cm-13.0";}else if($cm="cm14"){$cm="cm-14.1";}
            shell_exec('wget '.$line.' -O /var/www/html/updates/zip/'.$cm.'-'.$date.'-NIGHTLY-w5.zip');
            $out = shell_exec('curl --upload-file /var/www/html/updates/zip/'.$cm.'-'.$date.'-NIGHTLY-w5.zip https://transfer.sh/'.$cm.'-'.$date.'-NIGHTLY-w5.zip');
            $out = preg_replace('/\s+/', '', $out);
            shell_exec('rm /var/www/html/updates/zip/'.$cm.'-'.$date.'-NIGHTLY-w5.zip');
            shell_exec('sed -i "s#'.$line.'#'.$out.'#g" /var/www/html/includes/links.txt');
            $i++;
            break;
        }
        case 4: {
            shell_exec('wget '.$line.' -O /var/www/html/updates/zip/'.$cm.'-'.$date.'-NIGHTLY-w5.zip.md5');
            $out = shell_exec('curl --upload-file /var/www/html/updates/zip/'.$cm.'-'.$date.'-NIGHTLY-w5.zip.md5 https://transfer.sh/'.$cm.'-'.$date.'-NIGHTLY-w5.zip.md5');
            $out = preg_replace('/\s+/', '', $out);
            shell_exec('rm /var/www/html/updates/zip/'.$cm.'-'.$date.'-NIGHTLY-w5.zip.md5');
            shell_exec('sed -i "s#'.$line.'#'.$out.'#g" /var/www/html/includes/links.txt');
            $i=0;break;
        }
    }
}

$link = shell_exec('cat /var/www/html/updates/txt/download_link-cm13.txt'); $link = preg_replace('/\s+/', '', $link);
shell_exec('wget '.$link.' -O /var/www/html/updates/zip/update-cm13.zip');
$out = shell_exec('curl --upload-file /var/www/html/updates/zip/update-cm13.zip https://transfer.sh/update-cm13.zip');
shell_exec('rm /var/www/html/updates/zip/update-cm13.zip');
$out = preg_replace('/\s+/', '', $out);
shell_exec('echo '.$out.' > /var/www/html/updates/txt/download_link-cm13.txt');

$link = shell_exec('cat /var/www/html/updates/txt/download_gapps-cm13.txt'); $link = preg_replace('/\s+/', '', $link);
shell_exec('wget '.$link.' -O /var/www/html/updates/zip/gapps.zip');
$out = shell_exec('curl --upload-file /var/www/html/updates/zip/gapps.zip https://transfer.sh/gapps.zip');
shell_exec('rm /var/www/html/updates/zip/gapps.zip');
$out = preg_replace('/\s+/', '', $out);
shell_exec('echo '.$out.' > /var/www/html/updates/txt/download_gapps-cm13.txt');
?>