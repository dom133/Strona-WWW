<html lang="pl_PL">
    <head>
        <meta charset="utf-8">
        <title>Strona apikacji i Romu dla LG L65</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
        <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
        
        <script src="/js/main.js"></script>
        <style>
            .demo-layout-transparent {
              background: url('/img/tlo.png');
            }
            .demo-layout-transparent .mdl-layout__header,
            .demo-layout-transparent .mdl-layout__drawer-button {
              color: black;
            }
        </style>
        <script> //Google Analytics
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-49399540-4', 'auto');
          ga('send', 'pageview');

        </script>
    </head>
    
    <body>
        <?php 
            include 'mysql.php';
        
        
            $navbar = '<div class="demo-layout-transparent mdl-layout mdl-js-layout">
                          <header class="mdl-layout__header mdl-layout__header--transparent mdl-layout__header--scroll">
                            <div class="mdl-layout__header-row">
                              <span class="mdl-layout-title">Strona apikacji i Romu dla LG L65</span>
                              <div class="mdl-layout-spacer"></div>
                            </div>
                          </header>
                          <div class="mdl-layout__drawer">
                            <nav class="mdl-navigation">
                                <a class="mdl-navigation__link active" href="/">Strona Główna</a>
                                <a class="mdl-navigation__link" href="bledy">Lista Błędów</a>
                                <a class="mdl-navigation__link" href="dodaj">Dodaj błąd lub propozycję</a>
                                <li class="mdl-navigation__link">Pobierz ROM
                                    <ul class="mdl-navigation__link">
                                        <li><a style="color: #757575;" href="/pobierz/cm13">CM13</a></li>
                                        <li><a style="color: #757575;" href="/pobierz/lineageos_14.1">Lineage OS</a></li>
                                    </ul>
                                </li>
                                <a class="mdl-navigation__link" href="https://github.com/dom133/Updater-Android">Github</a>
                                <a class="mdl-navigation__link" href="http://app-updater.pl:8080">Jenkins</a>
                            </nav>
                          </div>
                          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button><h4 class="modal-title" id="ModalTitle"></h4></div><div class="modal-body" id="ModalContent"><p></p></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button></div></div></div></div>
                          <main class="mdl-layout__content"> <div id="message" style="margin-top:10px; margin-left:30px; margin-right:30px;"></div>';
            
            if($conn) {
                echo $navbar;
                
                if(!isset($_COOKIE['cookie'])) {
                    echo '<script type="text/javascript">alerts("message", "Nasza strona internetowa używa plików cookies (tzw. ciasteczka) w celach statystycznych, reklamowych oraz funkcjonalnych. Dzięki nim możemy indywidualnie dostosować stronę do twoich potrzeb. Każdy może zaakceptować pliki cookies albo ma możliwość wyłączenia ich w przeglądarce, dzięki czemu nie będą zbierane żadne informacje. <a href=\"http://ciasteczka.eu/#jak-wylaczyc-ciasteczka\">Dowiedz się więcej</a>", "info"); setCookie("cookie", "true", "365");</script>'; 
                }

                $action = isset($_GET['action']) ? $_GET['action'] : NULL;
                switch($action) {
                    case '': {
                        include 'includes/glowna.php';
                        break;
                    }

                    case 'dodaj': {
                        include 'includes/dodaj.php';
                        break;
                    }

                    case 'edit': {
                        include 'includes/edycja.php';
                        break;
                    } 

                    case 'download': {
                        include 'includes/download.php';
                        break;
                    } 
                        
                    case 'bledy': {
                        include 'includes/lista_bledow.php';
                        break;
                    } 

                    default: {
                        include 'includes/glowna.php';
                        break;
                    }
                }
                echo '</main></div>';
            } else {
                echo '<h3 style="text-align:center; padding: 70px 0;"><b>Nie można połączyć się z bazą danych. Jeśli problem będzie się powtarzał skontaktuj się z administratorem</b></h3>';
            }          
        ?> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    </body>
</html>