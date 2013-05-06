<?php
    require_once 'classes/Init.php';
    require_once 'classes/Uzytkownicy.php';
    
    $init = new Init();
    $smarty = $init->getSmarty();
    
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
    
    
    $smarty->assign('obiekt2' , $smarty->fetch("layout_login.tpl"));
    $smarty->display('layout_main.tpl');
?>



