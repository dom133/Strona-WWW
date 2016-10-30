<script type="text/javascript">document.getElementById("cm").classList.add("active");document.getElementById("add").classList.remove("active");document.getElementById("home").classList.remove("active");</script>        
    <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Nazwa</th>
                        <th>URL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 0; 
                        $date = null;
                        $cm = null; 
                    
                        $file = fopen("/var/www/html/includes/links.txt", "r")or exit("Unable to open file!");
                        while(!feof($file)){
                            $line = preg_replace('/\s+/', '', fgets($file));
                            switch($i) {
                                case 0: {$i++;break;}
                                case 1: {$date = $line; $i++; break;}
                                case 2: {$cm = $line; $i++; break;}
                                case 3: {    
                                    if($cm="cm13"){$cm="cm-13.0";}else if($cm="cm14"){$cm="cm-14.1";}
                                    echo '<tr class="warning"><td><b>Data kompilacji: '.$date.'</b></td><td></td></tr><tr class="success"><td><b><i>'.$cm.'-'.$date.'-NIGHTLY-w55n.zip</i></b></td><td><a href="'.$line.'">'.$line.'</a></td></tr>'; 
                                    $i++; 
                                    break;
                                }
                                case 4: {echo '<tr class="success"><td><b><i>'.$cm.'-'.$date.'-NIGHTLY-w55n.zip.md5</i></b></td><td><a href="'.$line.'">'.$line.'</a></td></tr>'; $i=0; break;}
                            }
                        }
                        
                        fclose($file);
                    ?>
                </tbody>
            </table>
        </div>