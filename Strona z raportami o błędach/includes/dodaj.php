<script type="text/javascript">document.getElementById("add").classList.add("active");document.getElementById("home").classList.remove("active");</script>
<?php
date_default_timezone_set("Europe\Warsaw");

$formularz = '<form action="dodaj" class="form-horizontal container" method="post">
    <div class="form-group">
        <label for="type" class="col-sm-2 control-label">Typ zgłoszenia: </label>
        <div class="col-sm-10">
            <select name="type" class="form-control">
                <option value="0">Zgłoś błąd</option>
                <option value="1">Zgłoś propozycję</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="version" class="col-sm-2 control-label">Wersja aplikacji: </label>
        <div class="col-sm-10">
            <select name="version" class="form-control">
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
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email: </label>
        <div id="email_div" class="col-sm-10">
            <input type="email" class="form-control" name="email" placeholder="Email">
        </div>
    </div>
    <div class="form-group">
        <label for="nick" class="col-sm-2 control-label">Nick(Opcjonalne): </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="nick" placeholder="Nick(Opcjonalne)">
        </div>
    </div>
    <div class="form-group">
        <label for="title" class="col-sm-2 control-label">Tytuł: </label>
        <div id="title_div" class="col-sm-10">
            <input type="text" class="form-control" name="title" placeholder="Tytuł">
        </div>
    </div>
    <div class="form-group">
        <label for="contents" class="col-sm-2 control-label">Treść: </label>
        <div id="contents_div" class="col-sm-10">
            <textarea name="contents" class="form-control" rows="4"></textarea>
        </div>
    </div>
    <input type="submit" name="dodaj" value="Dodaj" class="btn btn-success btn-lg btn-block">
</form>';   
if(!empty($_POST['dodaj'])) {
    $nick = addslashes(htmlspecialchars($_POST['nick']));
    $email = addslashes(htmlspecialchars($_POST['email']));
    $title = addslashes(htmlspecialchars($_POST['title']));
    $contents = addslashes(htmlspecialchars($_POST['contents']));
    $type = addslashes(htmlspecialchars($_POST['type']));
    
    if(empty($email)) {
        echo $formularz;
        echo '<script type="text/javascript">add_error("email_div");alerts("message", "Pole email nie może być puste!!!", "danger")</script>';
    } else if(empty($title)) {
        echo $formularz;
        echo '<script type="text/javascript">add_error("title_div");alerts("message", "Pole tytuł nie może być puste!!!", "danger")</script>';
    } else if(empty($contents)) {
        echo $formularz;
        echo '<script type="text/javascript">add_error("contents_div");alerts("message", "Pole treść nie może być puste!!!", "danger")</script>';
    } else {
        $date = date('d.m.Y');
        $time = date('H:i');
        $version = $_POST['version'];

        $result = mysqli_query($conn ,"INSERT INTO raporty(type, nick, email, title, contents, date, time, version, enabled, source) VALUES('$type', '$nick', '$email', '$title', '$contents', '$date', '$time', '$version', 'true', 'web')"); 
        
        if($result) {
            echo '<script type="text/javascript">alerts("message", "Poprawnie przyjęto zgłoszenie", "success");</script>'; 
        } else {
            echo '<script type="text/javascript">alerts("message", "Wystąpił błąd podczas dodawania zgłoszenia, spróbuj ponownie", "danger");</script>';
        }
        echo $formularz;
        
    }
} else {echo $formularz;}
?>
