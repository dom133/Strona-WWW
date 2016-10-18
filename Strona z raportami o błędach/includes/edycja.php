<script type="text/javascript">document.getElementById("add").classList.remove("active");document.getElementById("home").classList.remove("active")</script>
<?php

$key = $_GET['key'];

$formularz = '<form action="?action=edit&key='.$key.'" class="form-horizontal container" method="post">
    <div class="form-group">
        <label for="type" class="col-sm-2 control-label">Typ zgłoszenia: </label>
        <div class="col-sm-10">
            <select id="type" name="type" class="form-control">
                <option value="0">Błąd</option>
                <option value="1">Propozycja</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="version" class="col-sm-2 control-label">Wersja aplikacji: </label>
        <div class="col-sm-10">
            <select id="version" name="version" class="form-control">
                <option value="1.1">1.1</option>
                <option value="1.2.0">1.2.0</option>
                <option value="1.2.1">1.2.1</option>
                <option value="1.2.2">1.2.2</option>
                <option value="1.2.3">1.2.3</option>
                <option value="1.2.4">1.2.4</option>
                <option value="1.2.5">1.2.5</option>
                <option value="1.2.6">1.2.6</option>
                <option value="1.2.7">1.2.7</option>
                <option value="1.2.8">1.2.8</option>
                <option value="1.2.9">1.2.9</option>
                <option value="1.2.10">1.2.10</option>
                <option value="1.2.11">1.2.11</option>
                <option value="1.2.12">1.2.12</option>
                <option value="1.2.13">1.2.13</option>
                <option value="1.2.14">1.2.14</option>
                <option value="1.2.15">1.2.15</option>
                <option value="1.2.16">1.2.16</option>
                <option value="1.2.17">1.2.17</option>
                <option value="1.2.18">1.2.18</option>
                <option value="1.2.19">1.2.19</option>
                <option value="1.2.20">1.2.20</option>
                <option value="1.2.21">1.2.21</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="os" class="col-sm-2 control-label">Wersja systemu: </label>
        <div class="col-sm-10">
            <select id="os" name="os" class="form-control">
                <option value="CM13">CM13</option>
                <option value="CM14">CM14</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="title" class="col-sm-2 control-label">Tytuł: </label>
        <div id="title_div" class="col-sm-10">
            <input type="text" class="form-control" id="title" name="title" placeholder="Tytuł">
        </div>
    </div>
    <div class="form-group">
        <label for="contents" class="col-sm-2 control-label">Treść: </label>
        <div id="contents_div" class="col-sm-10">
            <textarea id="contents" class="form-control" name="contents" rows="4"></textarea>
        </div>
    </div>
    
    <input type="submit" name="edycja" value="Edytuj" class="btn btn-success btn-lg btn-block">
    <input type="submit" name="usun" value="Usuń" class="btn btn-danger btn-lg btn-block">
</form>';   

if(!empty($_POST['edycja'])) {           
    $title = addslashes(htmlspecialchars($_POST['title']));
    $contents = addslashes(htmlspecialchars($_POST['contents']));
    $type = addslashes(htmlspecialchars($_POST['type']));

    if(empty($title)) {
        echo $formularz;
        echo '<script type="text/javascript">add_error("title_div");alerts("message", "Pole tytuł nie może być puste!!!", "danger")</script>';
    } else if(empty($contents)) {
        echo $formularz;
        echo '<script type="text/javascript">add_error("contents_div");alerts("message", "Pole treść nie może być puste!!!", "danger")</script>';
    } else {
        $date = date('d.m.Y');
        $time = date('H:i');
        $version = $_POST['version'];
        $os = $_POST['os'];

        $result = mysqli_query($conn ,"UPDATE `raporty` SET `type` = '$type', `title` = '$title', `contents` = '$contents', `version` = '$version', `os` = '$os', `date` = '$date', `time` = '$time' WHERE `authKey` = '$key'"); 

        if($result) {
            echo '<script type="text/javascript">alerts("message", "Poprawnie edytowano zgłoszenie", "success");</script>'; 
        } else {
            echo '<script type="text/javascript">alerts("message", "Wystąpił błąd podczas edytowania zgłoszenia, spróbuj ponownie", "danger");</script>';
        }
        include 'includes/glowna.php';
    }
} else if(!empty($_POST['usun'])) {
    $result = mysqli_query($conn, "DELETE FROM `raporty` WHERE `authKey` = '$key'");
    if($result) {
        echo '<script type="text/javascript">alerts("message", "Poprawnie usunięto zgłoszenie", "success");</script>'; 
    } else {
            echo '<script type="text/javascript">alerts("message", "Wystąpił błąd podczas usuwania zgłoszenia, spróbuj ponownie", "danger")</script>';
    }
    include 'includes/glowna.php';
} else {
    if(!empty($_GET['key'])) {
        $zapytanie = mysqli_query($conn, "SELECT * FROM `raporty` WHERE `authKey` = '$key'");
        $row = mysqli_fetch_row($zapytanie);
        if(mysqli_num_rows($zapytanie)!=0) {
            echo $formularz;
            echo '<script type="text/javascript">changeValue("type", "'.$row[1].'");changeValue("version", "'.$row[8].'");changeValue("os", "'.$row[9].'");changeValue("title", "'.$row[4].'");changeValue("contents", "'.$row[5].'");</script>';
        } else {echo '<script type="text/javascript">alerts("message", "Nie prawidłowy klucz!!!", "danger")</script>';include 'includes/glowna.php';}
    } else {echo '<script type="text/javascript">alerts("message", "Nie prawidłowy adres url!!!", "danger")</script>';include 'includes/glowna.php';}
}
?>