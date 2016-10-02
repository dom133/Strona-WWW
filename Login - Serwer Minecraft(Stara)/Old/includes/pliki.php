<?php
if(isset($_SESSION['login'])) {
	
echo '<h3>Download:</h3>';

$folder = dir('/home/w235/domains/skymin.fibercraft.pl/public_html/login/includes/pliki');

while($plik = $folder->read()) {

if (($plik != '.') AND ($plik != '..')) {

 $nazwa = pathinfo($plik);
 $pliki[$nazwa['basename']] = $nazwa['extension'];

 $dodaj = true;
 for($i=0;$i<count($typ);$i++)
  if ($typ[$i] == $nazwa['extension']) $dodaj = false;
 
 if ($dodaj == true) $typ[] = $nazwa['extension'];
 }

}

$folder->close();

for($i=0;$i<count($typ);$i++) {
 echo '<ul>';
 foreach($pliki as $klucz => $wartosc)
  if ($wartosc == $typ[$i]) echo '<li><a href="includes/pliki/' .$klucz. '">' .$klucz. '</a></li>';
 echo '</ul>';
}

} else {
	echo'Aby miec dostep do tej strony musisz byc <a href="?strona=glowna">zalogowany</a>';
}

?>