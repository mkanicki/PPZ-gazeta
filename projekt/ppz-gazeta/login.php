<?php
    require_once 'classes/Init.php';
    require_once 'classes/Uzytkownicy.php';
    require_once 'classes/Wydanie.php';
    
    $init = new Init();
    $smarty = $init->getSmarty();
    $view = new Wydanie();
    
    if(isset($_POST['login'])){
        $uzytkownicy = new Uzytkownicy();
        if($uzytkownicy->zaloguj($_POST['username'], $_POST['password'])){
			header("Location: index.php?msg=2");
        }
        else{
            $smarty->assign('usertext', $_POST['username']);
            $smarty->assign('msg', "Wprowadzono z³y login i/lub has³o!");
        }
    }
    
    $smarty->assign('pokaz_mini_wydania' , $view->Pokaz_Wydania());
    
    
    $smarty->assign('obiekt2' , $smarty->fetch("layout_login.tpl"));
    $smarty->assign('obiekt1' , $smarty->fetch("layout_lista.tpl"));
    $smarty->display('layout_main.tpl');
?>



