<?php
    require_once 'classes/Init.php';
    require_once 'classes/Uzytkownicy.php';
    
    $init = new Init();
    $smarty = $init->getSmarty();
    $uzytkownicy = new Uzytkownicy();

    if($uzytkownicy->czyZalogowany()){
        $smarty->assign('user', $_SESSION['id_uzytkownika']);
        $smarty->assign('role', $_SESSION['id_roli']);
		$smarty->assign('firstname', $_SESSION['imie']);
		$smarty->assign('lastname', $_SESSION['nazwisko']);
    }
    else{
        $smarty->assign('user', 0);
        $smarty->assign('role', 0);
    }
    
    $smarty->assign('obiekt2' , $smarty->fetch("layout_homepage.tpl"));

    $smarty->display('layout_main.tpl');
?>

