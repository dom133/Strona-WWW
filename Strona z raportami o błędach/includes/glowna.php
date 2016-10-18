<script type="text/javascript">document.getElementById("home").classList.add("active");document.getElementById("add").classList.remove("active");</script>
<!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button>
                <h4 class="modal-title" id="ModalTitle"></h4>
              </div>
              <div class="modal-body" id="ModalContent">
                <p></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
              </div>
            </div>
          </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Tytuł</th>
                        <th>Autor</th>
                        <th>Data dodania</th>
                        <th>Godzina dodania</th>
                        <th>Wersja</th>
                        <th>Wersja systemu</th>
                        <th>Źródło dodania</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $query = "SELECT * FROM `raporty` ORDER BY id DESC"; 
                    $result = mysqli_query($conn, $query); 

                    while($row = mysqli_fetch_row($result)) {
                        if($row[10]=="true"){echo "<tr class=\"danger\" data-toggle=\"modal\" data-target=\"#myModal\" onclick=\"show_modal('".$row[4]."', '".$row[5]."', '".$row[1]."')\">";}
                        else {echo "<tr class=\"success\" data-toggle=\"modal\" data-target=\"#myModal\" onclick=\"show_modal('".$row[4]."', '".$row[5]."', '".$row[1]."')\">";}
                        if($row[1]==0){echo '<td><b>[BUG]</b>'.$row[4].'</td>';}
                        else echo '<td><b>[PROPOZYCJA]</b>'.$row[4].'</td>';
                        if($row[3]==null | $row[3]=="null") {echo '<td><b>Nie podano</b></td>';}
                        else {echo '<td><b>'.$row[3].'</b></td>';}

                        echo '<td><b>'.$row[6].'</b></td>';
                        echo '<td><b>'.$row[7].'</b></td>';
                        echo '<td><b>'.$row[8].'</b></td>';
                        echo '<td><b>'.$row[9].'</b></td>';
                        echo '<td><b>'.$row[11].'</b></td>';
                        echo '</tr>';
                    }
                ?>
                </tbody>
            </table>
        </div>