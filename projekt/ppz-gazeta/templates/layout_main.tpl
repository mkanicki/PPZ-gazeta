<!DOCTYPE html>
<html>
    <head>
        
        
        
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
        
        <title>Internetowe wydanie gazety</title>
        <link href="css/styl.css" type="text/css" rel="stylesheet" />
        <link href="css/styl3.css" type="text/css" rel="stylesheet" />
        <link href="flow_engine/engine1/style4.css" type="text/css" rel="stylesheet" />
        <link href="css/smoothness/jquery-ui-1.8.6.custom.css" type="text/css" rel="stylesheet" />
        <link href="css/jquery.lightbox-0.5.css" type="text/css" rel="stylesheet" />
        
        <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
        <script type="text/javascript" src="js/jquery.lightbox-0.5.min.js"></script>
        <script type="text/javascript" src="js/mainpage_script.js"></script> 
        <script type="text/javascript" src="flow_engine/engine1/jquery.js"></script>
        
    </head>
    
    <body>
        <div id="all">
            <div id="header">
                <a class="header" href="index.php"><img id="logo" width="100%" height=" 100%" src="images/logo.png"/></a>
            </div> 
            
            <div id="toolbar">
                <ul class="buttons">
                    {if $user != 0}
                    <li class="horizontal"><a href="logout.php">Wyloguj</a></li>
                    <li class="horizontal"><a href="profile.php">Mój profil</a></li>
                    <li class="horizontal"><a href="basket.php">Koszyk(<span id="basket_label">{$liczba_elem_koszyk}</span>)</a></li>
                    {/if}
                    {if $user == 0}
                    <li class="horizontal"><a href="login.php">Logowanie</a></li>
                    <li class="horizontal"><a href="registration.php">Rejestracja</a></li>
                    {/if}
                    {if $role == 3}
                    <li class="horizontal"><a href="admin_index.php">Admin</a></li>
                    {/if}
                    {if $role == 2}
                    <li class="horizontal"><a href="editor_index.php">Redaktor</a></li>
                    {/if}
                    {if $user != 0}
                    <li class="horizontal"><a href="index.php">Witaj {$firstname} {$lastname} !</a></li>
                    {/if}
                    
                    {if $smarty.get.msg == '1'}
                            <li class="horizontal"><b>Rejestracja pomyslna. </b></li>
                    {/if}
                    {if $smarty.get.msg == '2'}
                            <li class="horizontal"><b>Logowanie pomyslne. </b></li>
                    {/if}
                </ul>
            </div>
                
           <div id="list">
               <br/>
               {$obiekt1}
           </div>
           <div id="main-panel">
               
               {$obiekt2}
           </div>
        </div>
        
    </body>
</html>
