<script type="text/javascript">document.getElementById("cm").classList.add("active");document.getElementById("add").classList.remove("active");document.getElementById("home").classList.remove("active");</script> 
<?php
function showDownload($cm) {
    echo '<div class="table-responsive"><table class="table table-hover table-bordered"><thead><tr><th>Nazwa</th><th>URL</th></tr></thead><tbody>';
    $i = 0; 
    $date = null;
    $cm_file = null; 
                    
    $file = fopen("/var/www/html/includes/links.txt", "r")or exit("Unable to open file!");
    while(!feof($file)){
        $line = preg_replace('/\s+/', '', fgets($file));
        switch($i) {
            case 0: {$i++;break;}
            case 1: {$date = $line; $i++; break;}
            case 2: {$cm_file = $line; $i++; break;}
            case 3: {    
                if($cm_file==$cm) {
                    if($cm=="cm13"){$cm_org="cm-13.0";} else if($cm=="cm14"){$cm_org="cm-14.1";}
                    echo '<tr class="warning"><td><b>Data kompilacji: '.$date.'</b></td><td></td></tr><tr class="success"><td><b><i>'.$cm_org.'-'.$date.'-NIGHTLY-w55n.zip</i></b></td><td><a href="'.$line.'">'.$line.'</a></td></tr>'; 
                }
                $i++; 
                break;
            }
            case 4: {
                if($cm_file==$cm) {
                    if($cm=="cm13"){$cm_org="cm-13.0";} else if($cm=="cm14"){$cm_org="cm-14.1";}
                    echo '<tr class="success"><td><b><i>'.$cm_org.'-'.$date.'-NIGHTLY-w55n.zip.md5</i></b></td><td><a href="'.$line.'">'.$line.'</a></td></tr>'; 
                }
                $i=0; 
                break;
            }
        }
    }
    echo '</tbody></table></div>';
    fclose($file);
}

$type = $_GET['type'];
if($type=="cm13") {
    showDownload('cm13');
} else {
    echo '<script type="text/javascript">alerts("message", "CM14.1 jest w trakcie tworzenia i nightlies nie zostały jeszcze wypuszczone", "info");</script>';    
    include 'includes/glowna.php';
}
?>