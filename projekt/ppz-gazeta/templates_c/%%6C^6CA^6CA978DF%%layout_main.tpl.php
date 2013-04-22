<?php /* Smarty version 2.6.26, created on 2013-04-22 21:09:45
         compiled from layout_main.tpl */ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
        
        <title>Internetowe wydanie gazety</title>
        <link href="css/styl.css" type="text/css" rel="stylesheet" />
        <link href="css/smoothness/jquery-ui-1.8.6.custom.css" type="text/css" rel="stylesheet" />
        <link href="css/jquery.lightbox-0.5.css" type="text/css" rel="stylesheet" />
        
        <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
        <script type="text/javascript" src="js/jquery.lightbox-0.5.min.js"></script>
    </head>
    
    <body>
        <div id="all">
            <div id="header">
                <a class="header" href="index.php"><img src="images/logo.png"/></a>
            </div> 
            
            <div id="toolbar">
                <ul class="buttons">
                    <?php if ($this->_tpl_vars['user'] != 0): ?>
                    <li class="horizontal"><a href="logout.php">Wyloguj</a></li>
                    <li class="horizontal"><a href="profile.php">M�j profil</a></li>
                    <li class="horizontal"><a href="basket.php">Koszyk(0)</a></li>
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
                </ul>
            </div>
                
           <div id="list">
               Lista zdj��
               <?php echo $this->_tpl_vars['obiekt1']; ?>

           </div>
           <div id="main-panel">
               <?php echo $this->_tpl_vars['obiekt2']; ?>

           </div>
        </div>
        
    </body>
</html>