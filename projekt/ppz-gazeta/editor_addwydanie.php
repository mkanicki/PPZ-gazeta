<?php
    require_once 'classes/Init.php';
    require_once 'classes/Uzytkownicy.php';
    require_once 'classes/Wydanie.php';

    
    
    $init = new Init();
    $init->sprawdzAdmin(); // sprawdza, czy nie czytelnik
    $smarty = $init->getSmarty();
    
    $view = new Wydanie();
    
    
    if(isset($_POST['Dodaj'])){
        $_POST['data']=date("Y-m-d");
        $wynik = $view->dodajWydanie($_POST);
    }
    $smarty->assign('obiekt' , $smarty->fetch("layout_addwydanie.tpl"));
    $smarty->display('layout_editor.tpl');
?>


