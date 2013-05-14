<?php
    require_once 'classes/Init.php';
    require_once 'classes/Uzytkownicy.php';
    
    $init = new Init();
    $init->sprawdzAdmin(); // sprawdza, czy admin
    $smarty = $init->getSmarty();
    $uzytkownicy = new Uzytkownicy();
    
    if(isset($_POST['edit'])){
        $wynik = $uzytkownicy->zapisz($_POST,$_GET['id']);
        
        if($wynik === true) {
            header("Location: admin_index.php");
        } else {
            // bledy
            $smarty->assign('bledy', $wynik);
        }
        $smarty->assign('uzytkownik', $_POST);
        
    } else if (!isset($_GET['id'])) {
        header("Location: admin_index.php");
    } else {
        $user = $uzytkownicy->pobierz($_GET['id']);
        $smarty->assign('uzytkownik', $user);
    }
    $smarty->assign('obiekt' , $smarty->fetch("layout_addedit.tpl"));
    $smarty->display('layout_admin.tpl');
    
    
?>
