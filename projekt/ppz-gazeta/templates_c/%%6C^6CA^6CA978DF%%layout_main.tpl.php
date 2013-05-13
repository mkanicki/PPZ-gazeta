<?php /* Smarty version 2.6.26, created on 2013-05-13 21:47:08
         compiled from layout_main.tpl */ ?>
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
                    <?php if ($this->_tpl_vars['user'] != 0): ?>
                    <li class="horizontal"><a href="logout.php">Wyloguj</a></li>
                    <li class="horizontal"><a href="profile.php">Mój profil</a></li>
                    <li class="horizontal"><a href="basket.php">Koszyk(<span id="basket_label"><?php echo $this->_tpl_vars['liczba_elem_koszyk']; ?>
</span>)</a></li>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['user'] == 0): ?>
                    <li class="horizontal"><a href="login.php">Logowanie</a></li>
                    <li class="horizontal"><a href="registration.php">Rejestracja</a></li>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['role'] == 3): ?>
                    <li class="horizontal"><a href="admin_index.php">Admin</a></li>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['role'] == 2): ?>
                    <li class="horizontal"><a href="editor_index.php">Redaktor</a></li>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['user'] != 0): ?>
                    <li class="horizontal"><a href="index.php">Witaj <?php echo $this->_tpl_vars['firstname']; ?>
 <?php echo $this->_tpl_vars['lastname']; ?>
 !</a></li>
                    <?php endif; ?>
                    
                    <?php if ($_GET['msg'] == '1'): ?>
                            <li class="horizontal"><b>Rejestracja pomyslna. </b></li>
                    <?php endif; ?>
                    <?php if ($_GET['msg'] == '2'): ?>
                            <li class="horizontal"><b>Logowanie pomyslne. </b></li>
                    <?php endif; ?>
                </ul>
            </div>
                
           <div id="list">
               <br/>
               <?php echo $this->_tpl_vars['obiekt1']; ?>

           </div>
           <div id="main-panel">
               
               <?php echo $this->_tpl_vars['obiekt2']; ?>

           </div>
        </div>
        
    </body>
</html>