<?php
    require_once 'classes/Init.php';
    require_once 'classes/Uzytkownicy.php';
    require_once 'classes/Wydanie.php';
    require_once "classes/Koszyk.php";
    
    $init = new Init();
    $smarty = $init->getSmarty();
    $uzytkownicy = new Uzytkownicy();
     $view = new Wydanie();
     $koszyk = new Koszyk();
     $_SESSION['platnosc']="";

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
    
    if(isset($_POST['change'])){
        header("Location: index.php");
    }
    
    
    $smarty->assign('pokaz_mini_wydania' , $view->Pokaz_Wydania());
    $smarty->assign('liczba_elem_koszyk' , $koszyk->Zlicz_elementy());
    
    $smarty->assign('obiekt2' , $smarty->fetch("layout_profile.tpl"));
    $smarty->assign('obiekt1' , $smarty->fetch("layout_lista.tpl"));
    $smarty->display('layout_main.tpl');
?>