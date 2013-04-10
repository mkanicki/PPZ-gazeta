<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
        
        <title>Internetowe wydanie gazety</title>
        <link href="css/styl2.css" type="text/css" rel="stylesheet" />
        <link href="css/smoothness/jquery-ui-1.8.6.custom.css" type="text/css" rel="stylesheet" />
        <link href="css/jquery.lightbox-0.5.css" type="text/css" rel="stylesheet" />
        
        <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
        <script type="text/javascript" src="js/jquery.lightbox-0.5.min.js"></script>
    </head>
    
    <body>
        <div id="all">
            <div id="toolbar">
                <ul class="buttons">
                    <li class="horizontal"><a href="admineditor_logout.php">Wyloguj</a></li>
                    <li class="horizontal"><a href="admineditor_newspapers.php">Wydania</a></li>
                    <li class="horizontal"><a href="index.php">Portal</a></li>
                </ul>
            </div>
                
           <div id="main-panel">
               {$obiekt}
           </div>
        </div>
        
    </body>
</html>
