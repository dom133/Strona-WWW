<?php
include 'includes/mail.php';
$wiadomosc = '<html><head><meta charset="utf-8"></head><body><p><b>Witaj $nick,
Dziekujemy ze sie zarejstrowales/as, aby aktywowac konto wejdz na </b></p><a href="http://www.skymin.pl/index.php?strona=aktywacja&kod=$klucz">http://www.skymin.pl/index.php?strona=aktywacja&kod=$klucz</a>
</body></html>';			
echo sendMail("dom133_pl@protonmail.com", "Rejestracja na SkyMin", $wiadomosc);
?>