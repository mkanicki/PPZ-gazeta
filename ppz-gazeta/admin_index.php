<?php
    require_once 'classes/Init.php';
    
    $init = new Init();
    $smarty = $init->getSmarty();
    
    $smarty->assign('obiekt' , $smarty->fetch("layout_admin_index.tpl"));

    $smarty->display('layout_admin.tpl');
?>


