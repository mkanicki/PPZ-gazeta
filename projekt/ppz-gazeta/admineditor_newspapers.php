<?php
    require_once 'classes/Init.php';
    require_once 'classes/Uzytkownicy.php';
    require_once 'classes/Wydanie.php';

    
    
    $init = new Init();
    $init->sprawdzAdmin(); // sprawdza, czy nie czytelnik
    $smarty = $init->getSmarty();
    
    $view = new Wydanie();
    
    //var_dump($view->pokazWszystko());
    $smarty->assign('wydania', $view->Pokaz_Wydania());
    $smarty->assign('artykul', $view->pokazWszystko());
    $smarty->assign('obiekt' , $smarty->fetch("layout_admineditor_newspapers.tpl"));

    $smarty->display('layout_admin.tpl');
?>
