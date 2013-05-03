<?php
    require_once 'classes/Init.php';
    require_once 'classes/Uzytkownicy.php';
    require_once 'classes/Wydanie.php';
    
    $init = new Init();
    $smarty = $init->getSmarty();
    $uzytkownicy = new Uzytkownicy();
    $view = new Wydanie();
    
	if(isset($_POST['register'])){
        $wynik = $uzytkownicy->zapisz($_POST);
        
        if($wynik === true) {
            header("Location: index.php?msg=1");
        } else {
            // bledy
            $smarty->assign('bledy', $wynik);
        }
        $smarty->assign('uzytkownik', $_POST);
        
    }    
    
    $smarty->assign('pokaz_mini_wydania' , $view->Pokaz_Wydania());
    $smarty->assign('obiekt2' , $smarty->fetch("layout_register.tpl"));
    $smarty->assign('obiekt1' , $smarty->fetch("layout_lista.tpl"));
    $smarty->display('layout_main.tpl');
?>



