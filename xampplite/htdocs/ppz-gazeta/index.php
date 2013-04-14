<?php
    require_once 'classes/Init.php';
    
    $init = new Init();
    $smarty = $init->getSmarty();
    
    $smarty->assign('obiekt2' , $smarty->fetch("layout_homepage.tpl"));

    $smarty->display('layout_main.tpl');
?>

