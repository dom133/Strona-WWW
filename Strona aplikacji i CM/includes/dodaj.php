<script type="text/javascript">document.getElementById("add").classList.add("active");document.getElementById("home").classList.remove("active");document.getElementById("cm").classList.remove("active");</script>
<?php
date_default_timezone_set("Europe/Warsaw");

include 'mail.php';

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
                <option value="Nie dotyczy">Nie dotyczy</option>
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
                <option value="1.2.22">1.2.22</option>
                <option value="1.2.23">1.2.23</option>
                <option value="1.2.24">1.2.24</option>
                <option value="1.2.25">1.2.25</option>
                <option value="1.2.26">1.2.26</option>
                <option value="1.2.27">1.2.27</option>
                <option value="1.2.28">1.2.28</option>
                <option value="1.3.0">1.3.0</option>
                <option value="1.3.1">1.3.1</option>
                <option value="1.3.2">1.3.2</option>
                <option value="1.3.3">1.3.3</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="os" class="col-sm-2 control-label">Wersja systemu: </label>
        <div class="col-sm-10">
            <select id="os" name="os" class="form-control">
                <option value="Nie dotyczy">Nie dotyczy</option>
                <option value="CM13">CM13</option>
                <option value="CM14.1">CM14.1</option>
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
        $os = $_POST['os'];
        $authKey = GenRandom(50);

        $result = mysqli_query($conn ,"INSERT INTO raporty(type, nick, email, title, contents, date, time, version, os, enabled, source, authKey) VALUES('$type', '$nick', '$email', '$title', '$contents', '$date', '$time', '$version', '$os', 'true', 'web', '$authKey')"); 
        
        $wiadomosc = '<html><head><meta charset="utf-8"></head><body><p><b>Witaj,
Dziekujemy ze zgloszenie, aby edytowac zgloszenie wejdz na <a href="http://app-updater.pl/?action=edit&key='.$authKey.'">http://app-updater.pl/?action=edit&key='.$authKey.'</a></b></p>
</body></html>';
        
        if($result) {
            $error = sendMail($email, "Zgłoszenie na App-updater", $wiadomosc);
            echo '<script type="text/javascript">alerts("message", "Poprawnie przyjęto zgłoszenie", "success");</script>'; 
        } else {
            echo '<script type="text/javascript">alerts("message", "Wystąpił błąd podczas dodawania zgłoszenia, spróbuj ponownie: '.mysqli_error($conn).' ", "danger");</script>';
        }
        echo $formularz;
        
    }
} else {echo $formularz;}
?>
