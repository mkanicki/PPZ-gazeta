<?php
    require_once 'classes/Init.php';
    require_once 'classes/Uzytkownicy.php';
    
    $init = new Init();
    $init->sprawdzAdmin(); // sprawdza, czy admin
    
    $smarty = $init->getSmarty();
    $uzytkownicy = new Uzytkownicy();
    
    $smarty->assign('uzytkownicy', $uzytkownicy->pobierzListe());
    $smarty->assign('iduzytkownika', $_SESSION['id_uzytkownika']);
    $smarty->assign('obiekt' , $smarty->fetch("layout_admin_index.tpl"));

    $smarty->display('layout_admin.tpl');
?>


