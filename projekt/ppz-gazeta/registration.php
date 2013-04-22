<?php
    require_once 'classes/Init.php';
    require_once 'classes/Uzytkownicy.php';
    
    $init = new Init();
    $smarty = $init->getSmarty();
    $uzytkownicy = new Uzytkownicy();
    
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
    
    $smarty->assign('obiekt2' , $smarty->fetch("layout_register.tpl"));
    $smarty->display('layout_main.tpl');
?>



