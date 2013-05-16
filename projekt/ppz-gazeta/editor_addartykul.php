<?php
    require_once 'classes/Init.php';
    require_once 'classes/Uzytkownicy.php';
    require_once 'classes/Wydanie.php';

    
    
    $init = new Init();
    $init->sprawdzAdmin(); // sprawdza, czy nie czytelnik
    $smarty = $init->getSmarty();
    
    $view = new Wydanie();
    
    if(isset($_POST['Dodaj'])){
        //var_dump($_POST);
        //die();
        $_POST['data']=date("Y-m-d");
        $wynik = $view->dodajArtykul($_POST);
        if($wynik !== true) {
            // bledy
            $smarty->assign('bledy', $wynik);
        }
    }
    $smarty->assign('artykuly', $view->pokazWydania());
    $smarty->assign('obiekt' , $smarty->fetch("layout_addartykul.tpl"));
    $smarty->display('layout_editor.tpl');
?>


