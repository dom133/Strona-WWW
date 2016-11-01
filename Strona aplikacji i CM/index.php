<html lang="pl_PL">
    <head>
        <meta charset="utf-8">
        <title>Strona apikacji i CM dla LG L65</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <script src="/js/main.js"></script>
        <style type="text/css">
            body {
                background-image: url(/img/tlo.png); //from http://subtlepatterns.com
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
        <nav class="navbar navbar-default" role="navigation">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Rozwiń nawigację</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li class="active" id="home"><a href="/"><b>Strona Główna</b></a></li>
                    <li id="add"><a href="dodaj" ><b>Dodaj błąd lub propozycję</b></a></li>
                    <li id="cm" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Pobierz CM</b><span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/pobierz/cm13">CM13</a></li>
                            <li><a href="/pobierz/cm14">CM14.1</a></li>
                        </ul>
                    </li>
                    <li><a href="https://github.com/dom133/Updater-Android"><b>Github</b></a></li>
                    <li><a href="http://app-updater.pl:8080"><b>Jenkins</b></a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <div id="login_form">
                    </div>
                </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>   
        
        <div id="message" style="margin-top:10px; margin-left:30px; margin-right:30px;"></div>
        
        <?php
            include 'mysql.php';
            switch($_GET['action']) {
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
                    
                default: {
                    include 'includes/glowna.php';
                    break;
                }
            }
        

        ?> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    </body>

</html>