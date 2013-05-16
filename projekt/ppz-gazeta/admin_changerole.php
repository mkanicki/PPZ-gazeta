<?php
    require_once 'classes/Init.php';
    require_once 'classes/Uzytkownicy.php';
    
    $init = new Init();
    $init->sprawdzAdmin(); // sprawdza, czy admin
    
    $smarty = $init->getSmarty();
    $uzytkownicy = new Uzytkownicy();
    
    if(isset($_POST['edytuj'])){
        //var_dump($_POST['idRola']); die();
        $id = $_GET['id'];
        $wynik = $uzytkownicy->edycjaRoli($id, $_POST['idRola']);
        Header("Location: admin_index.php");
    }
    
    $smarty->assign('uzytkownik', $uzytkownicy->pobierz($_GET['id']));
    $smarty->assign('role', $uzytkownicy->pobierzRole());
    $smarty->assign('obiekt' , $smarty->fetch("layout_admin_changerole.tpl"));

    $smarty->display('layout_admin.tpl');
?>


