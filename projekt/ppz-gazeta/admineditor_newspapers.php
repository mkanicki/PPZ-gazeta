<?php
    require_once 'classes/Init.php';
    
    $init = new Init();
    $smarty = $init->getSmarty();
    
    $smarty->assign('obiekt' , $smarty->fetch("layout_admineditor_newspapers.tpl"));

    $smarty->display('layout_editor.tpl');
?>


