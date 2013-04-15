<?php
    require_once 'classes/Init.php';
    
    $init = new Init();
    $smarty = $init->getSmarty();
    
    if(isset($_POST['login'])){
        header("Location: index.php");
    }
    
    
    $smarty->assign('obiekt2' , $smarty->fetch("layout_login.tpl"));
    $smarty->display('layout_main.tpl');
?>



