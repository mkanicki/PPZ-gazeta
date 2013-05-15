<?php
    require_once 'classes/Init.php';
    require_once 'classes/Uzytkownicy.php';
    require_once 'classes/Wydanie.php';
    
    $init = new Init();
    $init->sprawdzAdmin(); // sprawdza, czy nie czytelnik
    $smarty = $init->getSmarty();
    
    $view = new Wydanie();
    
    $smarty->assign('wydania', $view->pokazWszystko());
    $smarty->assign('obiekt' , $smarty->fetch("layout_editor_index.tpl"));

    $smarty->display('layout_editor.tpl');
?>


