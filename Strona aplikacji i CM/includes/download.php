<script type="text/javascript">document.getElementById("cm").classList.add("active");document.getElementById("add").classList.remove("active");document.getElementById("home").classList.remove("active");</script> 
<?php
function showDownload($cm) {
    echo '<div class="table-responsive"><table class="table table-hover table-bordered"><tbody>';
    $i = 0; 
    $date = null;
    $cm_file = null; 
                    
    $file = fopen("/var/www/html/includes/links.txt", "r")or exit("Unable to open file!");
    while(!feof($file)){
        $line = preg_replace('/\s+/', '', fgets($file));
        switch($i) {
            case 0: {$i++;break;}
            case 1: {$date_org = $line; $i++; break;}
            case 2: {$cm_file = $line; $i++; break;}
            case 3: {    
                if($cm_file==$cm) {
                    $date = substr_replace($date_org, '-', 4, 0); $date = substr_replace($date, '-', 7, 0);
                    if($cm=="cm13"){$cm_org="cm-13.0";} else if($cm=="cm14"){$cm_org="cm-14.1";}
                    echo '<tr class="warning"><td><b>Data kompilacji: '.$date.'</b></td><td></td></tr><tr class="success"><td><b><i>'.$cm_org.'-'.$date_org.'-NIGHTLY-w55n.zip</i></b></td><td><a href="'.$line.'">'.$line.'</a></td></tr>'; 
                }
                $i++; 
                break;
            }
            case 4: {
                if($cm_file==$cm) {
                    if($cm=="cm13"){$cm_org="cm-13.0";} else if($cm=="cm14"){$cm_org="cm-14.1";}
                    echo '<tr class="success"><td><b><i>'.$cm_org.'-'.$date_org.'-NIGHTLY-w55n.zip.md5</i></b></td><td><a href="'.$line.'">'.$line.'</a></td></tr>'; 
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
    echo '<script type="text/javascript">alerts("message", "Nightlies dla CM13 zostały wyłączone z powodu przeniesienia się na CM14.1", "info");</script>'; 
    showDownload('cm13');
} else {
    shwoDownload('cm14');   
}
?>